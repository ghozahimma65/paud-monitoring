<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\WaliMurid;
use App\Models\Kelas;
use App\Models\Pengumuman; 

class DashboardController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->first();
        $aktivitas = [
        (object)['deskripsi' => 'Admin menambahkan data guru', 'created_at' => now()],
        (object)['deskripsi' => 'Admin membuat pengumuman baru', 'created_at' => now()->subHour()],
    ];

    return view('dashboard', compact('pengumuman','aktivitas'));
}
}