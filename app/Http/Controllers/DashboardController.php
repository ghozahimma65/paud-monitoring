<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas; // Pastikan model ini ada
use App\Models\Pengumuman; 

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        // Cek dulu tabel kelas ada atau belum, kalau belum kasih 0
        $totalKelas = \Schema::hasTable('kelas') ? Kelas::count() : 0;

        // 2. PENGUMUMAN (Ambil 3 Terbaru yang Statusnya Aktif/1)
        $pengumuman = Pengumuman::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();

        // 3. SISWA BARU (Untuk Tabel)
        $siswaBaru = Siswa::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalSiswa', 
            'totalGuru', 
            'totalKelas', 
            'pengumuman', 
            'siswaBaru'
        ));
    }
}