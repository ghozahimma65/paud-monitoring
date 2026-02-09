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
        {{-- 1. Tombol Anekdot --}}
        <a href="{{ route('anekdot.create', $siswa->id) }}" class="flex flex-col items-center p-4 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition relative overflow-hidden group">
            <span class="text-2xl mb-2 group-hover:scale-110 transition">📝</span>
            <span class="font-bold">Catatan Anekdot</span>
            <span class="text-xs bg-blue-700 text-white px-3 py-1 rounded-full mt-2 shadow-sm border border-blue-400">
                {{ $siswa->anekdots->count() }} Data
            </span>
        </a>

        {{-- 2. Tombol Hasil Karya --}}
        <a href="{{ route('hasil-karya.create', $siswa->id) }}" class="flex flex-col items-center p-4 bg-purple-500 text-white rounded-lg shadow hover:bg-purple-600 transition relative overflow-hidden group">
            <span class="text-2xl mb-2 group-hover:scale-110 transition">🎨</span>
            <span class="font-bold">Hasil Karya</span>
            <span class="text-xs bg-purple-700 text-white px-3 py-1 rounded-full mt-2 shadow-sm border border-purple-400">
                {{ $siswa->hasilKaryas->count() }} Data
            </span>
        </a>

        {{-- 3. Tombol Ceklis --}}
        <a href="{{ route('ceklis.create', $siswa->id) }}" class="flex flex-col items-center p-4 bg-orange-500 text-white rounded-lg shadow hover:bg-orange-600 transition relative overflow-hidden group">
            <span class="text-2xl mb-2 group-hover:scale-110 transition">✅</span>
            <span class="font-bold">Ceklis Capaian</span>
            <span class="text-xs bg-orange-700 text-white px-3 py-1 rounded-full mt-2 shadow-sm border border-orange-400">
                {{ $siswa->penilaianCeklis->count() }} Data
            </span>
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-10">
        <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
            <h2 class="text-lg font-bold flex items-center gap-2">🎓 Riwayat Rapot Semester</h2>
            <a href="{{ route('rapot.create', $siswa->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow transition duration-200 text-sm flex items-center gap-2">
                ➕ Buat Rapot Baru
            </a>
        </div>
        <div class="p-0 overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="py-3 px-6 text-left">Tahun Ajaran</th>
                        <th class="py-3 px-6 text-center">Semester</th>
                        <th class="py-3 px-6 text-center">Tanggal Rapot</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse($rapots as $rapot)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">{{ $rapot->tahun_ajaran }}</td>
                        <td class="py-4 px-6 text-center"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">Semester {{ $rapot->semester }}</span></td>
                        <td class="py-4 px-6 text-center">{{ \Carbon\Carbon::parse($rapot->tanggal_rapot)->translatedFormat('d F Y') }}</td>
                        <td class="py-4 px-6 text-center flex justify-center gap-2">
                            <a href="{{ route('rapot.show', $rapot->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold border border-blue-500 px-3 py-1 rounded transition">👁️ Lihat</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-8 text-gray-400">Belum ada rapot.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-10">
        <div class="bg-blue-600 text-white p-4 rounded-t-xl">
            <h2 class="text-lg font-bold flex items-center gap-2">📝 Riwayat Catatan Anekdot</h2>
        </div>
        
        @php
            $anekdotGroup = $siswa->anekdots->sortByDesc('tanggal')->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F Y');
            });
        @endphp

        <div class="bg-white border-x border-b border-gray-200 rounded-b-xl p-4">
            @forelse($anekdotGroup as $bulan => $items)
                <details class="group mb-2" open>
                    <summary class="flex justify-between items-center font-medium cursor-pointer list-none bg-blue-50 hover:bg-blue-100 p-3 rounded-lg text-blue-800">
                        <span class="flex items-center gap-2">
                            <span class="transition group-open:rotate-90">▶</span> 📂 {{ $bulan }}
                        </span>
                        <span class="text-xs bg-white text-blue-600 px-2 py-1 rounded-full border border-blue-200">{{ $items->count() }} Data</span>
                    </summary>
                    <div class="text-gray-500 mt-2 pl-4 space-y-4 pb-4 border-l-2 border-blue-100 ml-3">
                        @foreach($items as $ad)
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 relative">
                                <div class="absolute -left-[25px] top-4 w-4 h-4 bg-blue-500 rounded-full border-4 border-white"></div>
                                <p class="text-xs text-gray-400 mb-1">📅 {{ \Carbon\Carbon::parse($ad->tanggal)->translatedFormat('d F Y') }} | ⏰ {{ $ad->waktu }}</p>
                                <p class="font-bold text-gray-800">"{{ $ad->uraian_kejadian }}"</p>
                                @if($ad->foto)
                                    <img src="{{ asset('storage/anekdot/' . $ad->foto) }}" class="mt-2 w-32 h-32 object-cover rounded-lg border">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </details>
            @empty
                <div class="text-center py-6 text-gray-400">Belum ada catatan anekdot.</div>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <div class="bg-purple-600 text-white p-4 rounded-t-xl">
            <h2 class="text-lg font-bold flex items-center gap-2">🎨 Riwayat Hasil Karya</h2>
        </div>

        @php
            $karyaGroup = $siswa->hasilKaryas->sortByDesc('tanggal')->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F Y');
            });
        @endphp

        <div class="bg-white border-x border-b border-gray-200 rounded-b-xl p-4">
            @forelse($karyaGroup as $bulan => $items)
                <details class="group mb-2">
                    <summary class="flex justify-between items-center font-medium cursor-pointer list-none bg-purple-50 hover:bg-purple-100 p-3 rounded-lg text-purple-800">
                        <span class="flex items-center gap-2">
                            <span class="transition group-open:rotate-90">▶</span> 📂 {{ $bulan }}
                        </span>
                        <span class="text-xs bg-white text-purple-600 px-2 py-1 rounded-full border border-purple-200">{{ $items->count() }} Data</span>
                    </summary>
                    <div class="text-gray-500 mt-2 pl-4 grid grid-cols-1 md:grid-cols-2 gap-4 pb-4">
                        @foreach($items as $hk)
                            <div class="flex gap-4 p-3 bg-white rounded-lg border border-purple-100 shadow-sm">
                                @if($hk->foto)
                                    <img src="{{ asset('storage/hasil_karya/' . $hk->foto) }}" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                @endif
                                <div>
                                    <p class="text-xs font-bold text-purple-600">{{ \Carbon\Carbon::parse($hk->tanggal)->translatedFormat('d M Y') }}</p>
                                    <p class="text-sm text-gray-800 line-clamp-2">"{{ $hk->deskripsi_foto }}"</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </details>
            @empty
                <div class="text-center py-6 text-gray-400">Belum ada data hasil karya.</div>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <div class="bg-orange-500 text-white p-4 rounded-t-xl">
            <h2 class="text-lg font-bold flex items-center gap-2">✅ Riwayat Ceklis Capaian</h2>
        </div>

        @php
            // Mengambil data dan mengelompokkan per bulan
            $ceklisGroup = $siswa->penilaianCeklis->sortByDesc('tanggal')->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F Y');
            });
        @endphp

        <div class="bg-white border-x border-b border-gray-200 rounded-b-xl p-4">
            @forelse($ceklisGroup as $bulan => $items)
                <details class="group mb-2" open>
                    <summary class="flex justify-between items-center font-medium cursor-pointer list-none bg-orange-50 hover:bg-orange-100 p-3 rounded-lg text-orange-800 transition">
                        <span class="flex items-center gap-2">
                            <span class="transition-transform duration-200 group-open:rotate-90 text-orange-400">▶</span> 
                            📂 {{ $bulan }}
                        </span>
                        <span class="text-xs bg-white text-orange-600 px-2 py-1 rounded-full border border-orange-200 font-bold">
                            {{ $items->count() }} Data
                        </span>
                    </summary>

                    <div class="mt-2 overflow-x-auto border rounded-lg">
                        <table class="min-w-full bg-white text-sm">
                            <thead class="bg-gray-50 text-gray-600 font-bold border-b">
                                <tr>
                                    <th class="py-2 px-4 text-left w-24">Tgl</th>
                                    <th class="py-2 px-4 text-left">Indikator & Catatan</th>
                                    <th class="py-2 px-4 text-center w-24">Hasil</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($items as $cc)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 font-medium text-gray-500 align-top">
                                        {{ \Carbon\Carbon::parse($cc->tanggal)->format('d/m') }}
                                    </td>
                                    <td class="py-3 px-4 align-top">
                                        <p class="font-bold text-gray-800 mb-1">{{ $cc->indikator }}</p>
                                        @if($cc->keterangan)
                                            <p class="text-xs text-gray-500 italic bg-gray-50 p-2 rounded border border-gray-100">
                                                "{{ $cc->keterangan }}"
                                            </p>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center align-top">
                                        @php
                                            $colors = [
                                                'BB' => 'bg-red-100 text-red-700 border-red-200',
                                                'MB' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                'BSH' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'BSB' => 'bg-green-100 text-green-700 border-green-200',
                                            ];
                                            $colorClass = $colors[$cc->hasil] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-bold border {{ $colorClass }}">
                                            {{ $cc->hasil }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </details>
            @empty
                <div class="text-center py-6 text-gray-400">Belum ada data ceklis.</div>
            @endforelse
        </div>
    </div>

</div> 
@endsection