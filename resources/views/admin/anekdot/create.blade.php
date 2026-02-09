@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📝 Catatan Anekdot Baru</h1>
            <p class="text-sm text-gray-500">Mencatat peristiwa penting perkembangan siswa</p>
        </div>
        {{-- Ganti yang error tadi dengan ini --}}
        <a href="{{ route('perkembangan.show', $siswa->id) }}" class="flex items-center text-gray-600 hover:text-green-600 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Profil Siswa
        </a>
    </div>

    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full mr-4 text-2xl">🧒</div>
            <div>
                <p class="text-xs text-green-700 font-bold uppercase tracking-wider">Siswa:</p>
                <p class="text-lg font-bold text-green-900">{{ $siswa->nama_siswa }}</p>
                <p class="text-sm text-green-600">NIS: {{ $siswa->nis }} | Kelompok: {{ $siswa->kelompok_id ?? '-' }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('anekdot.store', $siswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="p-6 md:p-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">📅 Tanggal Kejadian</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">⏰ Waktu / Jam</label>
                    <select name="waktu" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                        <option value="Pagi (Datang)">Pagi (Datang)</option>
                        <option value="Kegiatan Inti">Kegiatan Inti</option>
                        <option value="Istirahat / Makan">Istirahat / Makan</option>
                        <option value="Siang (Pulang)">Siang (Pulang)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">📍 Tempat Kejadian</label>
                    <input type="text" name="tempat" placeholder="Contoh: Taman Bermain" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                </div>
            </div>

            <hr class="border-gray-100">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">📖 Uraian Kejadian (Fakta)</label>
                <p class="text-xs text-gray-400 mb-2">*Tuliskan apa yang dilihat dan didengar secara objektif tanpa opini.</p>
                <textarea name="uraian_kejadian" rows="5" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Contoh: Saat istirahat, Budi membagikan bekalnya kepada temannya yang tidak membawa makanan..." required></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">🧠 Analisis Capaian (Capaian Pembelajaran)</label>
                <p class="text-xs text-gray-400 mb-2">*Tuliskan nilai agama, jati diri, atau literasi yang muncul dari kejadian ini.</p>
                <textarea name="analisis_capaian" rows="3" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Contoh: Muncul perilaku positif dalam berbagi (Nilai Agama dan Budi Pekerti)..."></textarea>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl border-2 border-dashed border-gray-200">
                <label class="block text-sm font-bold text-gray-700 mb-2">📸 Foto Dokumentasi (Opsional)</label>
                <div class="flex items-center justify-center w-full mt-2">
                    <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
                </div>
                <p class="text-[10px] text-gray-400 mt-2 italic">*Hanya file gambar (JPG, PNG). Ukuran maksimal 2MB.</p>
            </div>

        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:-translate-y-1 active:scale-95">
                💾 Simpan Catatan Anekdot
            </button>
        </div>
    </form>
</div>
@endsection