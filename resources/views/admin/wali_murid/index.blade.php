@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold flex items-center gap-2">
            👨‍👩‍👧 Data Wali Murid
        </h2>
        <a href="{{ route('wali-murid.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">+ Tambah Wali Murid</a>
    </div>
    <table class="w-full border-collapse">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="p-3 text-left">#</th>
                <th class="p-3 text-left">Nama Wali</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">No HP</th>
                <th class="p-3 text-left">Alamat</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wali_murids as $wali)
                <tr class="border-b hover:bg-gray-100">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $wali->nama_wali }}</td>
                    <td class="p-3">{{ $wali->email }}</td>
                    <td class="p-3">{{ $wali->no_hp }}</td>
                    <td class="p-3">{{ $wali->alamat }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('wali-murid.edit', $wali->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('wali-murid.destroy', $wali->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-3 text-center text-gray-500">Belum ada data wali murid.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
