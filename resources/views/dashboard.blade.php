@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Pengumuman -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="font-bold text-gray-800 mb-3">📢 Pengumuman</h2>
        <p>{{ $pengumuman ?? 'Belum ada pengumuman.' }}</p>
    </div>

    <!-- Jadwal -->
    <div class="bg-white p-6 rounded-xl shadow">
        <div class="flex justify-between items-center mb-3">
            <h2 class="font-bold text-gray-800">📅 Jadwal</h2>
            <a href="#" class="text-sm text-red-500 hover:underline">See all</a>
        </div>
        <p>🔔 {{ $jadwal ?? 'Belum ada jadwal.' }}</p>
    </div>

    <!-- Aktivitas Peserta Didik -->
    <div class="bg-white p-6 rounded-xl shadow">
        <div class="flex justify-between items-center mb-3">
            <h2 class="font-bold text-gray-800">🧒 Aktivitas Peserta Didik</h2>
            <a href="#" class="text-sm text-red-500 hover:underline">See all</a>
        </div>
        <ul class="space-y-3">
            @forelse ($aktivitas as $a)
                <li class="flex items-center justify-between border-b pb-2">
                    <span>{{ $a['nama'] }}</span>
                    <span class="text-sm text-gray-500">{{ $a['waktu'] }}</span>
                </li>
            @empty
                <li>Belum ada aktivitas.</li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
