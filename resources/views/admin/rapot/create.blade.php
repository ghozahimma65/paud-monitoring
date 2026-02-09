@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

<style>
    /* CSS PERBAIKAN TRIX EDITOR */
    trix-editor { 
        min-height: 200px; 
        background: white; 
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 1rem;
    }
    
    /* Paksa tombol toolbar muncul dan rapi */
    trix-toolbar .trix-button_group {
        display: inline-flex !important;
        background: #f3f4f6;
        border-radius: 4px;
        margin-right: 5px;
        border: 1px solid #e5e7eb;
    }
    
    trix-toolbar .trix-button {
        background: white;
        width: 30px; /* Lebar tombol */
        height: 30px;
        border-right: 1px solid #e5e7eb;
    }
    
    trix-toolbar .trix-button.trix-active {
        background: #bfdbfe; /* Warna biru saat aktif */
    }

    /* Sembunyikan tombol upload file & code block yang jarang dipakai */
    .trix-button--icon-attach, 
    .trix-button--icon-code { display: none !important; }

    /* KONFIGURASI LIST AGAR MUNCUL DI PREVIEW EDITOR */
    .trix-content ul { list-style-type: disc; margin-left: 1.5rem; }
    .trix-content ol { list-style-type: decimal; margin-left: 1.5rem; }
    
    /* Styling Card Form */
    .form-card {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        border-top: 4px solid #3b82f6; /* Garis Atas Biru */
    }
</style>

<div class="max-w-5xl mx-auto py-8 px-4 bg-gray-100 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">📝 Buat Rapot Baru</h1>
            <p class="text-gray-600">Siswa: {{ $siswa->nama_siswa }}</p>
        </div>
        <a href="{{ route('perkembangan.show', $siswa->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
        <p class="font-bold text-yellow-800">Tips Menulis:</p>
        <p class="text-sm text-yellow-700">
            • Tidak perlu menekan tombol <strong>TAB</strong> untuk paragraf baru (sistem akan otomatis membuat tulisan menjorok di PDF).<br>
            • Gunakan tombol <strong>List Angka</strong> atau <strong>List Bulat</strong> di toolbar editor untuk membuat poin-poin.
        </p>
    </div>

    <form action="{{ route('rapot.store', $siswa->id) }}" method="POST">
        @csrf
        
        <div class="form-card">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">📂 Identitas Rapot</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-sm mb-1">Tahun Ajaran</label>
                    <select name="tahun_ajaran" class="w-full border p-2 rounded">
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-1">Semester</label>
                    <select name="semester" class="w-full border p-2 rounded">
                        <option value="1">1 (Ganjil)</option>
                        <option value="2">2 (Genap)</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-1">Tanggal Rapot</label>
                    <input type="date" name="tanggal_rapot" value="{{ date('Y-m-d') }}" class="w-full border p-2 rounded">
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-4">I. Capaian Pembelajaran</h2>
        
        <div class="form-card">
            <label class="block text-xl font-bold text-blue-800 mb-2">A. Nilai Agama (AIK)</label>
            <input id="narasi_agama" type="hidden" name="narasi_agama">
            <trix-editor input="narasi_agama" placeholder="Tulis narasi..."></trix-editor>
        </div>

        <div class="form-card">
            <label class="block text-xl font-bold text-blue-800 mb-2">B. Budi Pekerti</label>
            <input id="narasi_budi_pekerti" type="hidden" name="narasi_budi_pekerti">
            <trix-editor input="narasi_budi_pekerti" placeholder="Tulis narasi..."></trix-editor>
        </div>

        <div class="form-card">
            <label class="block text-xl font-bold text-blue-800 mb-2">C. Jati Diri</label>
            <input id="narasi_jati_diri" type="hidden" name="narasi_jati_diri">
            <trix-editor input="narasi_jati_diri" placeholder="Tulis narasi..."></trix-editor>
        </div>

        <div class="form-card">
            <label class="block text-xl font-bold text-blue-800 mb-2">D. Literasi & STEAM</label>
            <input id="narasi_literasi" type="hidden" name="narasi_literasi">
            <trix-editor input="narasi_literasi" placeholder="Tulis narasi..."></trix-editor>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-4">II. Kokurikuler</h2>
        <div class="form-card" style="border-top-color: #10b981;">
            <label class="block text-xl font-bold text-green-800 mb-2">E. KOKURIKULER</label>
            <p class="text-sm text-gray-500 mb-2">Salin teks kokurikuler di sini.</p>
            <input id="narasi_kokurikuler" type="hidden" name="narasi_kokurikuler">
            <trix-editor input="narasi_kokurikuler" placeholder="Paste teks..."></trix-editor>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-4">III. Data Akhir</h2>
        <div class="form-card" style="border-top-color: #f59e0b;">
            <h3 class="font-bold mb-4">Data Pertumbuhan & Kehadiran</h3>
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div><label>Berat (kg)</label><input type="number" step="0.1" name="berat_badan" class="w-full border p-2 rounded"></div>
                <div><label>Tinggi (cm)</label><input type="number" step="0.1" name="tinggi_badan" class="w-full border p-2 rounded"></div>
                <div><label>Lingkar Kpl (cm)</label><input type="number" step="0.1" name="lingkar_kepala" class="w-full border p-2 rounded"></div>
            </div>
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div><label>Sakit</label><input type="number" name="sakit" value="0" class="w-full border p-2 rounded"></div>
                <div><label>Izin</label><input type="number" name="izin" value="0" class="w-full border p-2 rounded"></div>
                <div><label>Alpha</label><input type="number" name="alpha" value="0" class="w-full border p-2 rounded"></div>
            </div>

            <hr class="my-6">

            <h3 class="font-bold mb-4">Refleksi & Tanda Tangan</h3>
            <div class="mb-4">
                <label class="block font-bold mb-2">Refleksi Orang Tua (Opsional)</label>
                <textarea name="refleksi_orang_tua" rows="3" class="w-full border p-2 rounded bg-gray-50"></textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-600">Nama Guru Kelas</label>
                    <input type="text" name="nama_guru" value="Dwi Lestari, S.Pd" class="w-full border p-2 rounded mb-2">
                    <label class="block text-sm font-bold text-gray-600">NIP/NBM</label>
                    <input type="text" name="nipy_guru" placeholder="-" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600">Nama Kepala Sekolah</label>
                    <input type="text" name="nama_kepala_sekolah" value="Tri Marya Endarwati, M.Pd" class="w-full border p-2 rounded mb-2">
                    <label class="block text-sm font-bold text-gray-600">NIP/NBM</label>
                    <input type="text" name="nipy_kepala_sekolah" placeholder="-" class="w-full border p-2 rounded">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg text-lg">
            💾 SIMPAN RAPOT
        </button>
    </form>
</div>
@endsection