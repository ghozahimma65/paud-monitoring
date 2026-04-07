@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-2xl border border-[#e1f0e8] overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gradient-to-br from-green-600 to-teal-700 p-8 shadow-inner relative overflow-hidden">
        <!-- Decorative inner pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-extrabold text-white flex items-center drop-shadow">
                <span class="bg-white/20 text-white p-2.5 rounded-xl mr-4 backdrop-blur-md"><i class="fas fa-chart-line"></i></span> Laporan Perkembangan
            </h1>
            <p class="text-green-50 mt-2 ml-14 font-medium drop-shadow-sm">Pilih siswa untuk melihat Catatan Anekdot, Hasil Karya, dan Ceklis.</p>
        </div>
        <div class="mt-6 md:mt-0 relative z-10 flex items-center bg-white text-green-800 px-5 py-3 rounded-xl font-bold text-sm shadow-lg">
            <i class="fas fa-users mr-2 text-green-500"></i> Total Siswa: {{ $siswas->count() }}
        </div>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">No</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">NIS</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">Nama Siswa</th>
                    <th class="py-3 px-4 text-center uppercase font-semibold text-sm">Kelompok</th>
                    <th class="py-3 px-4 text-center uppercase font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($siswas as $index => $siswa)
                <tr class="hover:bg-gray-100 border-b transition duration-150">
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    
                    <td class="py-3 px-4">
                        <span class="bg-gray-100 text-gray-600 py-1 px-2 rounded text-xs font-mono">
                            {{ $siswa->nis ?? '-' }}
                        </span>
                    </td>
                    
                    <td class="py-3 px-4 font-medium text-gray-900">
                        {{ $siswa->nama_siswa }}
                    </td>
                    
                    <td class="py-3 px-4 text-center">
                        {{ $siswa->kelompok_id ?? '-' }}
                    </td>

                    <td class="py-3 px-4 text-center">
                        {{-- PERBAIKAN: Hapus 'admin.' jadi 'perkembangan.show' --}}
                        <a href="{{ route('perkembangan.show', $siswa->id) }}" class="inline-flex items-center gap-1 border border-green-600 text-green-600 bg-white hover:bg-green-50 px-4 py-1.5 rounded-md text-sm font-medium transition duration-200 shadow-sm">
                            📂 Buka Rapot
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-gray-500">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl mb-2">📭</span>
                            <p>Belum ada data siswa.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
        </tbody>
    </table>
    </div>
    </div>
    
    <div class="mt-4 pb-6 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} PAUD Aisyiyah Monitoring System
    </div>
</div>
@endsection