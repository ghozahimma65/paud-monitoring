@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Hai, Admin 👋</h1>

    <!-- Baris 1: Pengumuman (full width) -->
    <div class="mb-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold flex items-center mb-2">📢 Pengumuman Terbaru</h2>
            @if($pengumuman)
    <h4>{{ $pengumuman->judul }}</h4>
    <p>{{ $pengumuman->isi }}</p>
    <small>
        Periode: {{ $pengumuman->tanggal_mulai }} - {{ $pengumuman->tanggal_selesai }}
        @if(now()->between($pengumuman->tanggal_mulai, $pengumuman->tanggal_selesai))
            <span class="badge bg-success">Aktif</span>
        @else
            <span class="badge bg-secondary">Belum aktif</span>
        @endif
    </small>
@else
    <p>Belum ada pengumuman.</p>
@endif
        </div>
    </div>

    <!-- Baris 2: Jadwal & Aktivitas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Jadwal -->
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold flex items-center">📅 Jadwal</h2>
                <a href="#" class="text-red-500 text-sm">See all</a>
            </div>
            <p class="text-gray-400">Belum ada jadwal.</p>
        </div>

        <!-- Aktivitas -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold flex items-center mb-2">📌 Aktivitas Terbaru</h2>
            <ul class="space-y-1 text-gray-600 text-sm">
                @forelse($aktivitas as $item)
                    <li>• {{ $item->deskripsi }} 
                        <span class="text-gray-400"> - {{ $item->created_at->diffForHumans() }}</span>
                    </li>
                @empty
                    <li class="text-gray-400">Tidak ada aktivitas terbaru.</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection
