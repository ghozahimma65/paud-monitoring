@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-700">🚸 Monitoring Penjemputan</h1>
            <p class="text-sm text-gray-500">Data masuk secara real-time dari aplikasi mobile.</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white text-left">
                    <th class="p-3">Waktu</th>
                    <th class="p-3">Nama Siswa</th>
                    <th class="p-3">Penjemput</th>
                    <th class="p-3">Hubungan</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- Data ini nanti otomatis muncul saat Wali klik jemput di HP --}}
                @forelse ($logs as $log)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-bold">{{ \Carbon\Carbon::parse($log->waktu_jemput)->format('H:i') }}</td>
                    <td class="p-3">{{ $log->siswa->nama_siswa }}</td>
                    <td class="p-3">{{ $log->nama_penjemput }}</td>
                    <td class="p-3"><span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">{{ $log->hubungan }}</span></td>
                    <td class="p-3"><span class="text-green-600 font-bold">✔ Selesai</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-400 italic">Belum ada aktifitas penjemputan hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection