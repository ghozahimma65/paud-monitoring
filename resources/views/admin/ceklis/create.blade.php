@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">✅ Input Penilaian Ceklis</h1>
            <p class="text-sm text-gray-500">Siswa: {{ $siswa->nama_siswa }}</p>
        </div>
        <a href="{{ route('perkembangan.show', $siswa->id) }}" class="text-gray-600 hover:text-orange-600 transition">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('ceklis.store', $siswa->id) }}" method="POST" class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 p-6">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">📅 Tanggal</label>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">🎯 Indikator (Salin dari Word)</label>
            <textarea name="indikator" rows="2" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-500" placeholder="Contoh: Anak disiplin mengikuti upacara..." required></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-4">📊 Hasil Capaian (Pilih Satu)</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <label class="cursor-pointer">
                    <input type="radio" name="hasil" value="BB" class="peer sr-only" required>
                    <div class="p-4 rounded-lg border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-50 hover:bg-gray-50 text-center transition">
                        <span class="block text-xl mb-1">🔴</span><span class="font-bold text-red-600">BB</span>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="hasil" value="MB" class="peer sr-only">
                    <div class="p-4 rounded-lg border-2 border-gray-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:bg-gray-50 text-center transition">
                        <span class="block text-xl mb-1">🟡</span><span class="font-bold text-yellow-600">MB</span>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="hasil" value="BSH" class="peer sr-only">
                    <div class="p-4 rounded-lg border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50 text-center transition">
                        <span class="block text-xl mb-1">🔵</span><span class="font-bold text-blue-600">BSH</span>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="hasil" value="BSB" class="peer sr-only">
                    <div class="p-4 rounded-lg border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 text-center transition">
                        <span class="block text-xl mb-1">🟢</span><span class="font-bold text-green-600">BSB</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-2">📝 Keterangan / Kejadian Teramati</label>
            <textarea name="keterangan" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-500" placeholder="Salin dari kolom keterangan file Word..."></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                💾 Simpan
            </button>
        </div>
    </form>
</div>
@endsection