@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-2xl border border-[#e1f0e8] overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gradient-to-br from-green-600 to-teal-700 p-8 shadow-inner relative overflow-hidden">
        <!-- Decorative inner pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-extrabold text-white flex items-center drop-shadow">
                <span class="bg-white/20 text-white p-2.5 rounded-xl mr-4 backdrop-blur-md"><i class="fas fa-bullhorn"></i></span> Menu Pengumuman
            </h1>
            <p class="text-green-50 mt-2 ml-14 font-medium drop-shadow-sm">Kelola informasi dan pengumuman untuk seluruh pihak.</p>
        </div>
        <div class="mt-6 md:mt-0 relative z-10">
            <a href="{{ route('pengumuman.create') }}" class="inline-flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl hover:bg-green-50 font-bold text-sm shadow-lg transition-all hover:-translate-y-1">
                <i class="fas fa-plus"></i> Tambah Pengumuman
            </a>
        </div>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
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
    </div>
</div>
@endsection
