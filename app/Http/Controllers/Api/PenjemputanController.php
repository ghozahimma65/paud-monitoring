<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjemputan;
use App\Models\Siswa;
use Carbon\Carbon;

class PenjemputanController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id', // Pastikan ID siswa ada di tabel siswas
        ]);

        // 2. Ambil Data Siswa (Opsional, buat log)
        $siswa = Siswa::find($request->siswa_id);

        // 3. Simpan ke Database
        // Sesuaikan nama kolom dengan database kamu
        $penjemputan = Penjemputan::create([
            'siswa_id' => $request->siswa_id,
            'nama_penjemput' => 'Wali Murid', // Default dulu, nanti bisa update
            'status_hubungan' => 'Orang Tua', // Default
            'waktu_jemput' => Carbon::now(),
            'foto_bukti' => null, // Nanti kalau mau fitur foto penjemput
        ]);

        // 4. Kirim Respon Sukses ke HP
        if($penjemputan) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mencatat penjemputan untuk ' . $siswa->nama_lengkap,
                'data' => $penjemputan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data',
            ], 409);
        }
    }
}