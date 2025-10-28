@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">📊 Laporan Perkembangan Anak</h1>

    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama Anak</th>
                <th class="p-2 border">Guru</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Aspek</th>
                <th class="p-2 border">Deskripsi</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($perkembangans as $i => $item)
            <tr class="hover:bg-gray-50">
                <td class="p-2 border text-center">{{ $i+1 }}</td>
                <td class="p-2 border">{{ $item->siswa->nama ?? '-' }}</td>
                <td class="p-2 border">{{ $item->guru->nama_guru ?? '-' }}</td>
                <td class="p-2 border">{{ $item->tanggal }}</td>
                <td class="p-2 border">{{ $item->aspek }}</td>
                <td class="p-2 border">{{ Str::limit($item->deskripsi, 40) }}</td>
                <td class="p-2 border text-center">
                    <a href="{{ route('admin.perkembangan.show', $item->id) }}" 
                       class="text-blue-600 hover:underline">Lihat</a> |
                    <a href="{{ route('admin.perkembangan.print', $item->id) }}" 
                       class="text-green-600 hover:underline" target="_blank">Cetak</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center p-4 text-gray-500">Belum ada data perkembangan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
