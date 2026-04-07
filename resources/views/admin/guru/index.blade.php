@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-2xl border border-[#e1f0e8] overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gradient-to-br from-green-600 to-teal-700 p-8 shadow-inner relative overflow-hidden">
        <!-- Decorative inner pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-extrabold text-white flex items-center drop-shadow">
                <span class="bg-white/20 text-white p-2.5 rounded-xl mr-4 backdrop-blur-md"><i class="fas fa-chalkboard-teacher"></i></span> Data Guru
            </h1>
            <p class="text-green-50 mt-2 ml-14 font-medium drop-shadow-sm">Kelola informasi tenaga pengajar PAUD.</p>
        </div>
        <div class="mt-6 md:mt-0 relative z-10">
            <a href="{{ route('guru.create') }}" class="inline-flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl hover:bg-green-50 font-bold text-sm shadow-lg transition-all hover:-translate-y-1">
                <i class="fas fa-plus"></i> Tambah Guru
            </a>
        </div>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">#</th>
                <th class="p-2">Nama Guru</th>
                <th class="p-2">Email</th>
                <th class="p-2">No HP</th>
                <th class="p-2">Jenis Guru</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gurus as $i => $guru)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i + 1 }}</td>
                <td class="p-2 font-medium">{{ $guru->nama_guru ?? '-' }}</td>
                <td class="p-2">{{ $guru->email ?? '-' }}</td>
                <td class="p-2">{{ $guru->no_hp ?? '-' }}</td>
                <td class="p-2">
                    {{-- Logic tampilan badge --}}
                    @if($guru->jenis_guru == 'guru_kelas')
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Guru Kelas</span>
                    @elseif($guru->jenis_guru == 'shadow_abk')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Shadow ABK</span>
                    @else
                        -
                    @endif
                </td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('guru.edit', $guru->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 py-4">Belum ada data guru</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    </div>
</div>
@endsection