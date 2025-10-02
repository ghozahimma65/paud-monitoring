@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold">📢 Pengumuman</h1>
        <a href="{{ route('pengumuman.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Tambah</a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-green-600 text-white">
                <th class="p-2">#</th>
                <th class="p-2">Judul</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengumuman as $i => $p)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i+1 }}</td>
                <td class="p-2 font-semibold">{{ $p->judul }}</td>
                <td class="p-2">
                    {{ $p->tanggal_mulai }} - {{ $p->tanggal_selesai }}
                </td>
                <td class="p-2">
                    <span class="px-2 py-1 rounded text-white {{ $p->status ? 'bg-green-500' : 'bg-gray-400' }}">
                        {{ $p->status ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="p-2 flex gap-2">
                    <a href="{{ route('pengumuman.edit', $p->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                    <form action="{{ route('pengumuman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
