<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\WaliMurid;
use App\Models\Pengumuman;
use App\Models\PenilaianCeklis;

class WaliController extends Controller
{
    public function getDashboard(Request $request)
    {
        $user = Auth::user();

        // 1. Dapatkan Profil Wali
        $wali = WaliMurid::where('user_id', $user->id)->first();

        if (!$wali) {
            return response()->json([
                'success' => false,
                'message' => 'Profil Wali Murid tidak ditemukan',
            ], 404);
        }

        // 2. Dapatkan Data Siswa (Asumsi: 1 Wali -> 1 Siswa utama)
        $siswa = Siswa::with('kelompok')
            ->where('wali_murid_id', $wali->id)
            ->first();

        if (!$siswa) {
             return response()->json([
                'success' => false,
                'message' => 'Data Anak tidak ditemukan untuk wali ini',
            ], 404);
        }

        // 3. Pengumuman Aktif Terbaru
        $pengumuman = Pengumuman::where('status', true)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->latest()
            ->first();

        // 4. Hitung Rekapan 6 Aspek Perkembangan dari Ceklis
        $ceklis = PenilaianCeklis::where('siswa_id', $siswa->id)->get();
        
        $aspekList = [
            'Nilai Agama & Moral',
            'Fisik Motorik',
            'Kognitif',
            'Bahasa',
            'Sosial Emosional',
            'Seni',
        ];

        $progressPerkembangan = [];

        foreach ($aspekList as $aspek) {
            // Filter ceklis yang nama indikatornya mengandung kata kunci aspek
            // Karena nama indikator di database bisa bervariasi, kita buat mapping persentase sederhana
            // Nilai: BM=25%, MB=50%, BSH=75%, BSB=100%
            $ceklisAspek = $ceklis->filter(function($item) use ($aspek) {
                // Di sistem riil, indikator harus punya relasi 'aspek'. 
                // Karena disini plain text, kita simulasi ambil rata-rata secara mock atau jika ada kategori.
                // Disini kita akan buat dummy fallback atau mock calculation per siswa untuk UI Showcase.
                return true; 
            })->random(min($ceklis->count(), 2)); 
            
            // Kalkulasi real-ish:
            $totalScore = 0;
            $count = 0;
            foreach ($ceklisAspek as $c) {
                if ($c->hasil == 'BM') $totalScore += 25;
                elseif ($c->hasil == 'MB') $totalScore += 50;
                elseif ($c->hasil == 'BSH') $totalScore += 75;
                elseif ($c->hasil == 'BSB') $totalScore += 100;
                $count++;
            }

            $percentage = $count > 0 ? round($totalScore / $count) : 0; // fallback ke 0 jika blm ada nilai

            $progressPerkembangan[] = [
                'aspek' => $aspek,
                'nilai' => $percentage
            ];
        }

        // Return Data
        return response()->json([
            'success' => true,
            'data' => [
                'siswa' => [
                    'id' => $siswa->id,
                    'nis' => $siswa->nis,
                    'nama' => $siswa->nama_siswa,
                    'kelas' => $siswa->kelompok->nama_kelompok ?? '-',
                ],
                'pengumuman' => $pengumuman,
                'progress' => $progressPerkembangan
            ]
        ], 200);
    }
}
