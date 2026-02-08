@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📈 Laporan Perkembangan</h1>
            <p class="text-gray-600 text-sm mt-1">Pilih siswa untuk melihat Catatan Anekdot, Hasil Karya, dan Ceklis.</p>
        </div>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-bold text-sm">
            Total Siswa: {{ $siswas->count() }}
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
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
    
    <div class="mt-4 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} PAUD Aisyiyah Monitoring System
    </div>
</div>
@endsection