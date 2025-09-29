@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">👨‍🏫 Data Guru</h1>
        <a href="{{ route('guru.create') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
           + Tambah Guru
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">#</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Bidang</th>
                <th class="p-2">Telepon</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guru as $i => $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i+1 }}</td>
                <td class="p-2">{{ $item->nama ?? '-' }}</td>
                <td class="p-2">{{ $item->bidang ?? '-' }}</td>
                <td class="p-2">{{ $item->telepon ?? '-' }}</td>
                <td class="p-2">{{ $item->alamat ?? '-' }}</td>
                <td class="p-2 flex gap-2">
                    <a href="{{ route('guru.edit', $item->id) }}"
                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                       Edit
                    </a>
                    <form action="{{ route('guru.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 p-4">Belum ada data guru</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
