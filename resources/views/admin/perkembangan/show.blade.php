@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex justify-between items-center border-l-4 border-green-600">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $siswa->nama_siswa }}</h1>
            <p class="text-gray-600">NIS: <span class="font-mono font-bold">{{ $siswa->nis }}</span> | NISN: {{ $siswa->nisn ?? '-' }}</p>
            <p class="text-sm text-gray-500 mt-1">TTL: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</p>
        </div>
        <div class="text-right">
            <a href="{{ route('admin.perkembangan.index') }}" class="text-gray-500 hover:text-gray-700 font-medium mb-2 block">&larr; Kembali ke Daftar</a>
            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">Siswa Aktif</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            {{-- Tombol Anekdot --}}
            <a href="#" class="bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold py-4 px-6 rounded-lg border border-blue-200 shadow-sm transition flex flex-col items-center justify-center gap-1">
                <span class="flex items-center gap-2 text-lg">📝 Catatan Anekdot</span>
                <span class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded-full">{{ $anekdots->count() }} Data</span>
            </a>
    
            {{-- Tombol Hasil Karya --}}
            <a href="#" class="bg-purple-50 hover:bg-purple-100 text-purple-700 font-semibold py-4 px-6 rounded-lg border border-purple-200 shadow-sm transition flex flex-col items-center justify-center gap-1">
                <span class="flex items-center gap-2 text-lg">🎨 Hasil Karya</span>
                <span class="text-xs bg-purple-200 text-purple-800 px-2 py-1 rounded-full">{{ $karyas->count() }} Data</span>
            </a>
    
            {{-- Tombol Ceklis --}}
            <a href="#" class="bg-orange-50 hover:bg-orange-100 text-orange-700 font-semibold py-4 px-6 rounded-lg border border-orange-200 shadow-sm transition flex flex-col items-center justify-center gap-1">
                <span class="flex items-center gap-2 text-lg">✅ Ceklis Capaian</span>
                <span class="text-xs bg-orange-200 text-orange-800 px-2 py-1 rounded-full">{{ $ceklis->count() }} Data</span>
            </a>
        </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
            <h2 class="text-lg font-bold flex items-center gap-2">
                🎓 Riwayat Rapot Semester
            </h2>
            <a href="{{ route('rapot.create', $siswa->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow transition duration-200 text-sm flex items-center gap-2">
                ➕ Buat Rapot Baru
            </a>
        </div>

        <div class="p-0">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="py-3 px-6 text-left">Tahun Ajaran</th>
                        <th class="py-3 px-6 text-center">Semester</th>
                        <th class="py-3 px-6 text-center">Tanggal Rapot</th>
                        <th class="py-3 px-6 text-center">Status P5</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse($rapots as $rapot)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">{{ $rapot->tahun_ajaran }}</td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">
                                Semester {{ $rapot->semester }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            {{ \Carbon\Carbon::parse($rapot->tanggal_rapot)->translatedFormat('d F Y') }}
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($rapot->p5_tema)
                                <span class="text-xs text-green-600 font-semibold">✅ Ada Projek</span>
                            @else
                                <span class="text-xs text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center flex justify-center gap-2">
                            <a href="{{ route('rapot.show', $rapot->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold border border-blue-500 hover:bg-blue-50 px-3 py-1 rounded transition">
                                👁️ Lihat
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-700 font-semibold border border-red-500 hover:bg-red-50 px-3 py-1 rounded transition">
                                🖨️ PDF
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400">
                            <div class="flex flex-col items-center">
                                <span class="text-4xl mb-2">📄</span>
                                <p>Belum ada rapot yang dibuat untuk siswa ini.</p>
                                <p class="text-xs mt-1">Klik tombol <b>"Buat Rapot Baru"</b> di pojok kanan atas.</p>
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