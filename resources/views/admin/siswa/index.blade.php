@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">👶 Data Peserta Didik</h1>
        <a href="{{ route('siswa.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Tambah Siswa</a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">No</th>
                <th class="p-2">Nama Siswa</th>
                <th class="p-2">L/P</th>
                <th class="p-2">TTL</th>
                <th class="p-2">Orang Tua (Wali)</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswas as $i => $siswa)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i + 1 }}</td>
                <td class="p-2 font-bold">{{ $siswa->nama_siswa }}</td>
                <td class="p-2">
                    <span class="badge {{ $siswa->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }} px-2 py-1 rounded text-xs">
                        {{ $siswa->jenis_kelamin }}
                    </span>
                </td>
                <td class="p-2 text-sm">
                    {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}
                </td>
                <td class="p-2">
                    {{-- Mengambil nama wali dari relasi --}}
                    {{ $siswa->wali->nama_wali ?? '⚠️ Data Wali Terhapus' }}
                </td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus siswa ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 py-4">Belum ada data siswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection