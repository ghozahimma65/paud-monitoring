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
            // Murni kalkulasi berdasarkan data riil yang match aspeknya
            $ceklisAspek = $ceklis->where('aspek_perkembangan', $aspek); 
            
            $totalScore = 0;
            $count = 0;
            foreach ($ceklisAspek as $c) {
                if ($c->hasil == 'BM') $totalScore += 25;
                elseif ($c->hasil == 'MB') $totalScore += 50;
                elseif ($c->hasil == 'BSH') $totalScore += 75;
                elseif ($c->hasil == 'BSB') $totalScore += 100;
                $count++;
            }

            // Murni kalkulasi berdasarkan data riil, 0 jika kosong
            $percentage = $count > 0 ? round($totalScore / $count) : 0; 

            $progressPerkembangan[] = [
                'aspek' => $aspek,
                'nilai' => $percentage
            ];
        }

        // 5. Relasi data penjemputan terakhir
        $penjemputanTerakhir = \App\Models\Penjemputan::where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        // Return Data
        return response()->json([
            'success' => true,
            'data' => [
                'siswa' => [
                    'id' => $siswa->id,
                    'nis' => $siswa->nis,
                    'nama' => $siswa->nama_siswa,
                    'kelas' => $siswa->kelompok->nama_kelompok ?? '-',
                    'foto' => $siswa->foto ?? null,
                ],
                'pengumuman' => $pengumuman,
                'progress' => $progressPerkembangan,
                'penjemputan_terakhir' => $penjemputanTerakhir
            ]
        ], 200);
    }

    // --- KHUSUS WALI MURID: Riwayat Penilaian Anak Spesifik (PRIVASI) ---
    public function getRiwayatAnak($id)
    {
        $user = Auth::user();
        
        // 1. Dapatkan Profil Wali
        $wali = WaliMurid::where('user_id', $user->id)->first();
        if (!$wali) {
            return response()->json(['success' => false, 'message' => 'Profil Wali Murid tidak ditemukan'], 404);
        }

        // 2. Pastikan Siswa yang diminta benar-benar anak dari wali ini (Keamanan Privasi)
        $siswa = Siswa::where('id', $id)->where('wali_murid_id', $wali->id)->first();
        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki akses ke data siswa ini'], 403);
        }

        // 3. Ambil Semua Data Riwayat Khusus Anak Ini Saja
        $anekdot = \App\Models\Anekdot::with('siswa')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get();
            
        $ceklis = PenilaianCeklis::with('siswa')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get();
            
        $karya = \App\Models\HasilKarya::with('siswa')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get()
            ->map(function ($item) {
                if ($item->foto) {
                    $item->foto_url = url('storage/' . $item->foto);
                }
                return $item;
            });

        return response()->json([
            'status' => 'success',
            'data' => [
                'anekdot' => $anekdot,
                'ceklis' => $ceklis,
                'karya' => $karya
            ]
        ], 200);
    }

    // --- KHUSUS WALI MURID: Rapot Penilaian Anak (Semester) ---
    public function getRapotAnak($id)
    {
        $user = Auth::user();
        
        $wali = WaliMurid::where('user_id', $user->id)->first();
        if (!$wali) {
            return response()->json(['success' => false, 'message' => 'Profil Wali Murid tidak ditemukan'], 404);
        }

        $siswa = Siswa::where('id', $id)->where('wali_murid_id', $wali->id)->first();
        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki akses ke data siswa ini'], 403);
        }

        // Ambil SEMUA riwayat rapot untuk siswa ini
        $rapots = \App\Models\Rapot::with('siswa')
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($rapots->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Rapot belum tersedia'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $rapots
        ], 200);
    }
}
