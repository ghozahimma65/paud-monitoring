@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-2xl border border-[#e1f0e8] overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gradient-to-br from-green-600 to-teal-700 p-8 shadow-inner relative overflow-hidden">
        <!-- Decorative inner pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-extrabold text-white flex items-center drop-shadow">
                <span class="bg-white/20 text-white p-2.5 rounded-xl mr-4 backdrop-blur-md"><i class="fas fa-child"></i></span> Data Peserta Didik
            </h1>
            <p class="text-green-50 mt-2 ml-14 font-medium drop-shadow-sm">Manajemen data peserta didik PAUD.</p>
        </div>
        <div class="mt-6 md:mt-0 relative z-10">
            <a href="{{ route('siswa.create') }}" class="inline-flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl hover:bg-green-50 font-bold text-sm shadow-lg transition-all hover:-translate-y-1">
                <i class="fas fa-plus"></i> Tambah Siswa
            </a>
        </div>
    </div>

    <div class="p-6">

    @if(session('success'))
    <div class="bg-green-50/50 border border-green-200 text-green-700 p-4 mb-6 rounded-xl flex items-center shadow-sm" role="alert">
        <i class="fas fa-check-circle mr-3 text-xl text-green-500"></i>
        <p class="font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">No</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">NIS / NISN</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">Nama Siswa</th>
                    <th class="py-3 px-4 text-center uppercase font-semibold text-sm">L/P</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">TTL</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">Wali Murid / Alamat</th>
                    <th class="py-3 px-4 text-center uppercase font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($siswas as $index => $siswa)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    
                    <td class="py-3 px-4">
                        <div class="font-bold text-gray-700">{{ $siswa->nis ?? '-' }}</div>
                        <div class="text-xs text-gray-500">{{ $siswa->nisn ?? '-' }}</div>
                    </td>

                    <td class="py-3 px-4 font-medium">{{ $siswa->nama_siswa }}</td>
                    
                    <td class="py-3 px-4 text-center">
                        <span class="px-2 py-1 rounded text-xs font-bold {{ $siswa->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                            {{ $siswa->jenis_kelamin }}
                        </span>
                    </td>
                    
                    <td class="py-3 px-4 text-sm">
                        {{ $siswa->tempat_lahir }}, {{ date('d-m-Y', strtotime($siswa->tanggal_lahir)) }}
                    </td>

                    <td class="py-3 px-4">
                        @if($siswa->wali_murid)
                            <div class="text-sm font-semibold text-gray-800">{{ $siswa->wali_murid->nama_wali }}</div>
                            {{-- Tampilkan Alamat dari Wali Murid --}}
                            <div class="text-xs text-gray-500 mt-1">🏠 {{ Str::limit($siswa->wali_murid->alamat, 30) }}</div>
                            @if(!empty($siswa->wali_murid->no_hp) && $siswa->wali_murid->no_hp != '-')
                                <div class="text-xs text-gray-500">📞 {{ $siswa->wali_murid->no_hp }}</div>
                            @endif
                        @else
                            <span class="text-red-500 text-xs italic bg-red-100 px-2 py-1 rounded">⚠️ Belum diset</span>
                        @endif
                    </td>

                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-blue-500 hover:text-blue-700 hover:underline transition duration-150">
                                Edit
                            </a>
                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?');" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 hover:underline transition duration-150">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        Belum ada data siswa.
                    </td>
                </tr>
                @endforelse
            </tbody>
    </table>
    </div>
    </div>
</div>
@endsection