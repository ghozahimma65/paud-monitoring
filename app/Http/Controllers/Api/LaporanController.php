<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anekdot;
use App\Models\HasilKarya;
use App\Models\Penjemputan;
use App\Models\Siswa;

class LaporanController extends Controller
{
    // Fungsi Helper untuk Cek Akses
    private function cekAksesAnak($user, $siswaId)
    {
        $wali = $user->waliMurid;
        if (!$wali) return false;

        // Cek apakah siswa ini benar anak dari wali tersebut
        $isAnakSendiri = Siswa::where('id', $siswaId)->where('wali_id', $wali->id)->exists();
        return $isAnakSendiri;
    }

    public function getAnekdot(Request $request)
    {
        $request->validate(['siswa_id' => 'required']);
        
        if (!$this->cekAksesAnak($request->user(), $request->siswa_id)) {
            return response()->json(['message' => 'Akses ditolak. Ini bukan data anak Anda.'], 403);
        }

        $data = Anekdot::where('siswa_id', $request->siswa_id)->latest()->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function getKarya(Request $request)
    {
        $request->validate(['siswa_id' => 'required']);

        if (!$this->cekAksesAnak($request->user(), $request->siswa_id)) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $data = HasilKarya::where('siswa_id', $request->siswa_id)->latest()->get();
        
        // Tambahkan URL lengkap foto biar bisa muncul di HP
        $data->transform(function ($item) {
            $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
            return $item;
        });

        return response()->json(['success' => true, 'data' => $data]);
    }
    
    public function getPenjemputan(Request $request)
    {
        $request->validate(['siswa_id' => 'required']);

        if (!$this->cekAksesAnak($request->user(), $request->siswa_id)) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $data = Penjemputan::where('siswa_id', $request->siswa_id)->latest()->take(10)->get();
        
        $data->transform(function ($item) {
            $item->foto_url = $item->foto_bukti ? asset('storage/' . $item->foto_bukti) : null;
            return $item;
        });

        return response()->json(['success' => true, 'data' => $data]);
    }
}