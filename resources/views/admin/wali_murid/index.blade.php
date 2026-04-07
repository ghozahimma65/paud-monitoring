@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-2xl border border-[#e1f0e8] overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gradient-to-br from-green-600 to-teal-700 p-8 shadow-inner relative overflow-hidden">
        <!-- Decorative inner pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-extrabold text-white flex items-center drop-shadow">
                <span class="bg-white/20 text-white p-2.5 rounded-xl mr-4 backdrop-blur-md"><i class="fas fa-users"></i></span> Data Wali Murid
            </h1>
            <p class="text-green-50 mt-2 ml-14 font-medium drop-shadow-sm">Kelola informasi orang tua / wali peserta didik.</p>
        </div>
        <div class="mt-6 md:mt-0 relative z-10">
            <a href="{{ route('wali.create') }}" class="inline-flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl hover:bg-green-50 font-bold text-sm shadow-lg transition-all hover:-translate-y-1">
                <i class="fas fa-plus"></i> Tambah Wali
            </a>
        </div>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
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
                    <a href="{{ route('wali.edit', $wali->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('wali.destroy', $wali->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?');">
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
    </div>
</div>
@endsection