@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">👨‍👩‍👧 Data Wali Murid</h1>
        <a href="{{ route('wali-murid.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
           + Tambah Wali Murid
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">#</th>
                <th class="p-2">Nama Wali Murid</th>
                <th class="p-2">Email</th>
                <th class="p-2">No HP</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($wali_murids as $i => $wali)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i + 1 }}</td>
                <td class="p-2">{{ $wali->nama_wali ?? '-' }}</td>
                <td class="p-2">{{ $wali->email ?? '-' }}</td>
                <td class="p-2">{{ $wali->no_hp ?? '-' }}</td>
                <td class="p-2">{{ $wali->alamat ?? '-' }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('wali-murid.edit', $wali->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('wali-murid.destroy', $wali->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 py-4">Belum ada data wali murid.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
