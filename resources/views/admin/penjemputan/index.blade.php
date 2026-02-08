@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 mt-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">🛵 Log Penjemputan</h1>
            <p class="text-gray-500 text-sm mt-1">Daftar riwayat penjemputan siswa (Real-time).</p>
        </div>
        
        <div class="flex gap-3">
            <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm font-semibold border border-blue-100">
                Hari Ini: {{ $logs->where('waktu_jemput', '>=', now()->today())->count() }}
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider border-b border-gray-200">
                        <th class="p-4 font-bold">Waktu Jemput</th>
                        <th class="p-4 font-bold">Nama Siswa</th>
                        <th class="p-4 font-bold">Nama Penjemput</th>
                        <th class="p-4 font-bold text-center">Status Hubungan</th>
                        <th class="p-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($logs as $log)
                    <tr class="hover:bg-blue-50 transition duration-150 group">
                        <td class="p-4 whitespace-nowrap">
                            <div class="text-gray-800 font-semibold">
                                {{ \Carbon\Carbon::parse($log->waktu_jemput)->format('H:i') }} WIB
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($log->waktu_jemput)->format('d M Y') }}
                            </div>
                        </td>
                        
                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $log->siswa->nama ?? 'Siswa Terhapus' }}</div>
                            <div class="text-xs text-gray-500">NIS: {{ $log->siswa->nis ?? '-' }}</div>
                        </td>

                        <td class="p-4 text-gray-700 font-medium">
                            {{ $log->nama_penjemput }}
                        </td>

                        <td class="p-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                {{ $log->status_hubungan }}
                            </span>
                        </td>

                        <td class="p-4 text-center">
                            <form action="{{ route('penjemputan.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus data log ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50" title="Hapus Riwayat">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-10 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-sm">Belum ada data penjemputan hari ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection