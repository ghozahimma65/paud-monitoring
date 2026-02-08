<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Anekdot;
use App\Models\HasilKarya;
use App\Models\PenilaianCeklis;
use Illuminate\Http\Request;

class PerkembanganController extends Controller
{
    // Halaman Utama: Tampilkan Daftar Siswa
    public function index()
        {
            // PERBAIKAN: Ganti 'nama' menjadi 'nama_siswa'
            $siswas = Siswa::orderBy('nama_siswa', 'asc')->get();
            
            return view('admin.perkembangan.index', compact('siswas'));
        }

    // Halaman Detail: Tampilkan Rapot (Gabungan 3 Tabel)
    public function show($id)
        {
            $siswa = Siswa::findOrFail($id);
    
            // 1. Ambil Data Rapot (Untuk Tabel Bawah)
            $rapots = \App\Models\Rapot::where('siswa_id', $id)->orderBy('created_at', 'desc')->get();
    
            // 2. Ambil Data Harian (Untuk Tombol/Menu Atas) - SUDAH DIAKTIFKAN
            $anekdots = \App\Models\Anekdot::where('siswa_id', $id)->get();
            $karyas   = \App\Models\HasilKarya::where('siswa_id', $id)->get();
            $ceklis   = \App\Models\PenilaianCeklis::where('siswa_id', $id)->get();
    
            // Kirim semua variabel ke View
            return view('admin.perkembangan.show', compact('siswa', 'rapots', 'anekdots', 'karyas', 'ceklis'));
        }

    // Halaman Cetak (Opsional, logika sama dengan show)
    public function print($id)
    {
        $siswa = Siswa::findOrFail($id);
        $anekdots = Anekdot::where('siswa_id', $id)->get();
        $karyas = HasilKarya::where('siswa_id', $id)->get();
        $ceklis = PenilaianCeklis::where('siswa_id', $id)->with('indikator')->get();

        return view('admin.perkembangan.print', compact('siswa', 'anekdots', 'karyas', 'ceklis'));
    }
}