<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\WaliMurid;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function index()
{
    $pengumuman = "Besok ada kegiatan belajar di kantor polisi";
    $jadwal = "Pembelajaran di kantor polisi - 8 a.m.";
    $aktivitas = [
        ['nama' => 'Winda Kurnia', 'waktu' => '01 Aug, 09:20AM'],
        ['nama' => 'Siti Nurhaliza', 'waktu' => '01 Aug, 04:20PM'],
        ['nama' => 'Daffa Lintang', 'waktu' => '01 Aug, 08:20AM'],
    ];

    return view('dashboard', compact('pengumuman', 'jadwal', 'aktivitas'));
}
}
