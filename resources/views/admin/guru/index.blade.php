@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Laporan Perkembangan Anak</h1>

    @if($perkembangans->isEmpty())
        <p>Tidak ada data perkembangan yang tersedia.</p>
    @else
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Nama Siswa</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Aspek</th>
                    <th class="border p-2">Deskripsi</th>
                    <th class="border p-2">Guru</th>
                </tr>
            </thead>
            <tbody>
                @foreach($perkembangans as $p)
                    <tr>
                        <td class="border p-2">{{ $p->siswa->nama ?? '-' }}</td>
                        <td class="border p-2">{{ $p->tanggal }}</td>
                        <td class="border p-2">{{ $p->aspek }}</td>
                        <td class="border p-2">{{ $p->deskripsi }}</td>
                        <td class="border p-2">{{ $p->guru->nama_guru ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
