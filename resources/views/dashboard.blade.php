@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto space-y-8">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gradient-to-br from-green-600 to-teal-700 p-8 rounded-2xl shadow-lg relative overflow-hidden">
            <!-- Decorative inner pattern -->
            <div class="absolute inset-0 bg-white/5 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20 mix-blend-overlay"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl font-extrabold text-white flex items-center drop-shadow-md">
                    <span class="bg-white/20 text-white p-2.5 rounded-xl mr-4 backdrop-blur-sm"><i class="fas fa-chart-pie"></i></span> 
                    Dashboard Utama
                </h2>
                <p class="text-green-50 text-base mt-2 ml-14 font-medium drop-shadow">Ringkasan aktivitas dan informasi sekolah terkini.</p>
            </div>
            
            @if(Auth::user()->role == 'admin')
                <div class="mt-6 md:mt-0 relative z-10">
                    <a href="{{ route('pengumuman.index') }}" class="group flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:bg-green-50 font-bold text-sm transition-all hover:-translate-y-1">
                        <i class="fas fa-bullhorn group-hover:scale-110 transition-transform"></i>
                        <span>Buat Pengumuman</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white overflow-hidden rounded-2xl p-6 border border-[#e1f0e8] relative group hover:shadow-md transition-shadow">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-child text-6xl text-teal-600"></i>
                </div>
                <div class="text-green-500/80 text-xs font-bold tracking-widest uppercase mb-1">Total Siswa</div>
                <div class="text-4xl font-extrabold text-gray-800 flex items-baseline">
                    {{ $totalSiswa }} <span class="text-sm text-gray-400 font-medium ml-2">Anak</span>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden rounded-2xl p-6 border border-[#e1f0e8] relative group hover:shadow-md transition-shadow">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-chalkboard-teacher text-6xl text-green-600"></i>
                </div>
                <div class="text-green-500/80 text-xs font-bold tracking-widest uppercase mb-1">Total Guru</div>
                <div class="text-4xl font-extrabold text-gray-800 flex items-baseline">
                    {{ $totalGuru }} <span class="text-sm text-gray-400 font-medium ml-2">Pengajar</span>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden rounded-2xl p-6 border border-[#e1f0e8] relative group hover:shadow-md transition-shadow">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-door-open text-6xl text-emerald-600"></i>
                </div>
                <div class="text-green-500/80 text-xs font-bold tracking-widest uppercase mb-1">Total Kelas</div>
                <div class="text-4xl font-extrabold text-gray-800 flex items-baseline">
                    {{ $totalKelas }} <span class="text-sm text-gray-400 font-medium ml-2">Ruangan</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Papan Pengumuman -->
            <div class="lg:col-span-2">
                <div class="flex items-center mb-4 px-2">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center mr-3">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700">Info & Pengumuman</h3>
                </div>

                <div class="space-y-4 max-h-[500px] overflow-y-auto custom-scrollbar pr-2">
                    @forelse($pengumuman as $info)
                        <div class="bg-white rounded-2xl p-5 border border-l-4 border-[#e1f0e8] border-l-green-400 hover:border-l-green-500 transition-colors shadow-sm group">
                            <div class="flex justify-between items-start">
                                <div class="flex-1 pr-4">
                                    <h4 class="text-base font-bold text-gray-800 group-hover:text-green-700 transition-colors">{{ $info->judul }}</h4>
                                    <p class="text-gray-500 mt-2 text-sm leading-relaxed">{{ Str::limit($info->isi, 150) }}</p>
                                    
                                    <div class="mt-4 flex items-center gap-3">
                                        <div class="inline-flex items-center text-xs font-medium text-green-700 bg-green-50 px-2.5 py-1 rounded-md">
                                            <i class="far fa-calendar-alt mr-1.5 opacity-70"></i> 
                                            @if($info->tanggal_mulai)
                                                {{ \Carbon\Carbon::parse($info->tanggal_mulai)->format('d M y') }} 
                                                - 
                                                {{ \Carbon\Carbon::parse($info->tanggal_selesai)->format('d M y') }}
                                            @else
                                                Info Permanen
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-[10px] uppercase tracking-wider font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-md whitespace-nowrap">
                                    {{ $info->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white/50 border border-dashed border-gray-300 rounded-2xl p-10 text-center flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-100 text-gray-300 rounded-full flex items-center justify-center mb-3">
                                <i class="fas fa-inbox text-2xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada pengumuman aktif saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Siswa Terbaru -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-[#e1f0e8] overflow-hidden flex flex-col h-full">
                    <div class="px-6 py-5 border-b border-[#f2f8f5] flex items-center justify-between bg-green-50/30">
                        <h3 class="text-sm font-bold tracking-wider uppercase text-green-800 flex items-center">
                            <i class="fas fa-user-plus mr-2 text-green-500"></i> Siswa Baru
                        </h3>
                    </div>
                    
                    <div class="p-6 flex-1">
                        @if($siswaBaru->count() > 0)
                            <ul class="space-y-4">
                                @foreach($siswaBaru as $siswa)
                                <li class="flex items-center justify-between pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-100 to-teal-100 flex justify-center items-center text-green-700 font-bold text-sm shadow-sm border border-white">
                                            {{ substr($siswa->nama_siswa, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-bold text-gray-800">{{ $siswa->nama_siswa }}</p>
                                            <p class="text-xs text-gray-500">{{ $siswa->nis }}</p>
                                        </div>
                                    </div>
                                    <span class="w-2 h-2 rounded-full bg-green-400 cursor-help" title="Aktif"></span>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="h-full flex flex-col items-center justify-center text-center py-8">
                                <i class="fas fa-user-slash text-gray-300 text-3xl mb-2"></i>
                                <p class="text-sm text-gray-500">Belum ada siswa baru.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>
@endsection