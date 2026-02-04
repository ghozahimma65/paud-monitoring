@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">👪 Data Wali Murid</h1>
        <a href="{{ route('wali-murid.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Tambah Wali</a>
    </div>

    {{-- TAMBAHAN: Alert Merah untuk Error --}}
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    {{-- Alert Hijau untuk Sukses --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">No</th>
                <th class="p-2">Nama Wali</th>
                <th class="p-2">No HP</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($walis as $i => $wali)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i + 1 }}</td>
                <td class="p-2 font-medium">{{ $wali->nama_wali ?? '-' }}</td>
                <td class="p-2">{{ $wali->no_hp ?? '-' }}</td>
                <td class="p-2 text-sm text-gray-600">{{ $wali->alamat ?? '-' }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('wali-murid.edit', $wali->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('wali-murid.destroy', $wali->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data wali murid.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection