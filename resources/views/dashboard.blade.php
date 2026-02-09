@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">📊 Dashboard Utama</h2>
                <p class="text-sm text-gray-500">Ringkasan aktivitas dan informasi sekolah.</p>
            </div>
            
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('pengumuman.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 text-sm font-bold flex items-center gap-2">
                    <span>📢</span> Buat Pengumuman
                </a>
            @endif
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-700 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                Papan Pengumuman
            </h3>

            @forelse($pengumuman as $info)
                <div class="bg-white border-l-4 border-indigo-500 shadow-sm rounded-r-lg p-4 mb-4 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">{{ $info->judul }}</h4>
                            <p class="text-gray-600 mt-1 text-sm">{{ Str::limit($info->isi, 150) }}</p>
                            
                            <div class="mt-2 text-xs text-gray-500 flex items-center bg-gray-100 w-fit px-2 py-1 rounded">
                                📅 
                                @if($info->tanggal_mulai)
                                    {{ \Carbon\Carbon::parse($info->tanggal_mulai)->format('d M Y') }} 
                                    s/d 
                                    {{ \Carbon\Carbon::parse($info->tanggal_selesai)->format('d M Y') }}
                                @else
                                    Permanen
                                @endif
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 italic">
                            {{ $info->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center text-gray-500">
                    Belum ada pengumuman aktif saat ini.
                </div>
            @endforelse
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg p-5 border-b-4 border-blue-500">
                <div class="text-gray-500 text-sm font-bold uppercase">Total Siswa</div>
                <div class="text-3xl font-bold text-gray-800">{{ $totalSiswa }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-5 border-b-4 border-green-500">
                <div class="text-gray-500 text-sm font-bold uppercase">Total Guru</div>
                <div class="text-3xl font-bold text-gray-800">{{ $totalGuru }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-5 border-b-4 border-purple-500">
                <div class="text-gray-500 text-sm font-bold uppercase">Total Kelas</div>
                <div class="text-3xl font-bold text-gray-800">{{ $totalKelas }}</div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 font-bold text-gray-700">
                Siswa Terbaru
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($siswaBaru as $siswa)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_siswa }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection