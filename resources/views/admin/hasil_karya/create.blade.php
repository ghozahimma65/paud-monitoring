@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">🎨 Upload Hasil Karya</h1>
            <p class="text-sm text-gray-500">Siswa: {{ $siswa->nama_siswa }}</p>
        </div>
        <a href="{{ route('perkembangan.show', $siswa->id) }}" class="text-gray-600 hover:text-purple-600 transition">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('hasil-karya.store', $siswa->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 p-6">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">📅 Tanggal Karya</label>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">📸 Foto Karya</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 hover:bg-gray-100 transition">
                <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100" required>
                <p class="text-xs text-gray-400 mt-2">*Format: JPG/PNG. Wajib diisi.</p>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">📝 Deskripsi Karya (Apa yang anak buat?)</label>
            <textarea name="deskripsi_foto" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500" placeholder="Contoh: Menggambar pemandangan gunung dengan krayon..." required></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">🧠 Analisis Capaian (Opsional)</label>
            <textarea name="analisis_capaian" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500" placeholder="Contoh: Ananda sudah mampu memadukan warna dengan baik..."></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                💾 Simpan Karya
            </button>
        </div>
    </form>
</div>
@endsection