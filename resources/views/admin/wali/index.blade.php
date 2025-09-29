@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">👪 Data Wali Murid</h1>
        <a href="{{ route('wali.create') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
           + Tambah Wali Murid
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">#</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Lokasi (Lat, Lng)</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wali as $i => $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i+1 }}</td>
                <td class="p-2">{{ $item->nama ?? '-' }}</td>
                <td class="p-2">{{ $item->alamat ?? '-' }}</td>
                <td class="p-2">
                    {{ $item->lokasi_lat ?? '-' }}, {{ $item->lokasi_lng ?? '-' }}
                </td>
                <td class="p-2 flex gap-2">
                    <a href="{{ route('wali.edit', $item->id) }}"
                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                       Edit
                    </a>
                    <form action="{{ route('wali.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                <td colspan="5" class="text-center text-gray-500 p-4">Belum ada data wali murid</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
