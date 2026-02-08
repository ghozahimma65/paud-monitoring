@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📝 Input Rapot (Format Baru)</h1>

    <form action="{{ route('rapot.store', $siswa->id) }}" method="POST" class="bg-white shadow-lg rounded-xl overflow-hidden">
        @csrf
        
        <div class="bg-green-50 p-6 border-b border-green-100 grid grid-cols-3 gap-4">
            <div>
                <label class="font-bold text-sm">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" value="2025/2026" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="font-bold text-sm">Semester</label>
                <select name="semester" class="w-full border rounded p-2">
                    <option value="1 (Satu)">1 (Satu)</option>
                    <option value="2 (Dua)">2 (Dua)</option>
                </select>
            </div>
            <div>
                <label class="font-bold text-sm">Tanggal Rapot</label>
                <input type="date" name="tanggal_rapot" value="{{ date('Y-m-d') }}" class="w-full border rounded p-2">
            </div>
        </div>

        <div class="p-6 space-y-6">
            
            <div>
                <label class="font-bold block mb-1">A. PENGEMBANGAN AL ISLAM, KE'AISYIYAHAN DAN KEMUHAMMADIYAHAN (AIK)</label>
                <textarea name="narasi_aik" rows="5" class="w-full border rounded p-2" placeholder="Isi narasi AIK..."></textarea>
            </div>

            <div>
                <label class="font-bold block mb-1">B. CAPAIAN PEMBELAJARAN NILAI AGAMA DAN BUDI PEKERTI</label>
                <textarea name="narasi_nilai_agama" rows="5" class="w-full border rounded p-2" placeholder="Isi narasi Nilai Agama..."></textarea>
            </div>

            <div>
                <label class="font-bold block mb-1">C. CAPAIAN PEMBELAJARAN JATI DIRI</label>
                <textarea name="narasi_jati_diri" rows="5" class="w-full border rounded p-2" placeholder="Isi narasi Jati Diri..."></textarea>
            </div>

            <div>
                <label class="font-bold block mb-1">D. CAPAIAN PEMBELAJARAN DASAR-DASAR LITERASI, MATEMATIKA, SAINS, TEKNOLOGI, REKAYASA, SENI</label>
                <textarea name="narasi_literasi" rows="5" class="w-full border rounded p-2" placeholder="Isi narasi STEAM..."></textarea>
            </div>

            <div>
                <label class="font-bold block mb-1">E. KOKURIKULER</label>
                <textarea name="narasi_kokurikuler" rows="5" class="w-full border rounded p-2 bg-yellow-50" placeholder="Isi narasi Kokurikuler..."></textarea>
            </div>

        </div>

        <div class="p-6 border-t bg-gray-50 grid grid-cols-2 gap-6">
            <div>
                <h3 class="font-bold mb-2">Pertumbuhan Fisik</h3>
                <input type="text" name="berat_badan" placeholder="Berat Badan (kg)" class="w-full mb-2 border rounded p-2">
                <input type="text" name="tinggi_badan" placeholder="Tinggi Badan (cm)" class="w-full mb-2 border rounded p-2">
                <input type="text" name="lingkar_kepala" placeholder="Lingkar Kepala (cm)" class="w-full mb-2 border rounded p-2">
                <input type="text" name="lingkar_lengan" placeholder="Lingkar Lengan (cm)" class="w-full border rounded p-2">
            </div>
            <div>
                <h3 class="font-bold mb-2">Kehadiran (Hari)</h3>
                <input type="number" name="sakit" placeholder="Sakit" class="w-full mb-2 border rounded p-2">
                <input type="number" name="izin" placeholder="Izin" class="w-full mb-2 border rounded p-2">
                <input type="number" name="alpha" placeholder="Alpha" class="w-full border rounded p-2">
            </div>
        </div>

        <div class="p-6 border-t">
            <div class="mb-4">
                <label class="font-bold block mb-1">Refleksi Orang Tua</label>
                <textarea name="refleksi_orang_tua" rows="2" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="font-bold block mb-1">Nama Kepala Sekolah (Pengelola)</label>
                    <input type="text" name="nama_kepala_sekolah" value="TRI MARYA ENDARWATI, M.Pd" class="w-full border rounded p-2 bg-blue-50">
                    <input type="text" name="nbm_kepala_sekolah" value="NBM. 1420476" class="w-full border rounded p-2 mt-2 text-sm" placeholder="NBM/NIP">
                </div>
                <div>
                                    <label class="font-bold block mb-1">Nama Guru Kelas</label>
                                    
                                    <select name="nama_guru" class="w-full border rounded p-2 bg-blue-50 focus:ring-green-500 focus:border-green-500" required>
                                        <option value="">-- Pilih Guru Kelas --</option>
                                        @foreach($gurus as $guru)
                                            <option value="{{ $guru->nama_guru }}">
                                                {{ $guru->nama_guru }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">*Pilih nama guru kelas dari daftar.</p>
                                </div>
        </div>

        <div class="p-6 bg-gray-100 flex justify-end">
            <button type="submit" class="bg-green-600 text-white font-bold py-3 px-8 rounded shadow">💾 Simpan Rapot</button>
        </div>
    </form>
</div>
@endsection