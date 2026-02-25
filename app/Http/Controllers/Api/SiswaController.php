<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\WaliMurid; // Tambahkan Model Wali Murid
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan Auth

class SiswaController extends Controller
{
    public function index()
    {
        // 1. Cek siapa yang sedang login (ambil dari Token)
        $user = Auth::user();

        // 2. Logika Pembeda Data
        if ($user->role == 'guru') {
            // --- JIKA GURU ---
            // Ambil SEMUA data siswa (untuk menu "Data Kelas")
            $siswa = Siswa::with(['wali_murid', 'kelompok', 'anekdots'])->latest()->get();

        } else {
            // --- JIKA WALI MURID ---
            // Cari data profil Wali Murid yang sesuai dengan User ID yang login
            // Asumsi: Tabel 'wali_murids' punya kolom 'user_id'
            $wali = WaliMurid::where('user_id', $user->id)->first();

            if ($wali) {
                // Ambil siswa yang punya ID Wali Murid tersebut
                $siswa = Siswa::with(['wali_murid', 'kelompok'])
                              ->where('wali_murid_id', $wali->id)
                              ->latest()
                              ->get();
            } else {
                // Kalau data walinya belum di-link, kasih kosong aja biar gak error
                $siswa = []; 
            }
        }

        // 3. Kirim hasilnya ke Flutter
        return response()->json([
            'success' => true,
            'data'    => $siswa
        ]);
    }
}