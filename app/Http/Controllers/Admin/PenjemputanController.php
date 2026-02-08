<?php

namespace App\Http\Controllers\Admin; // Namespace sudah benar (di folder Admin)

use App\Http\Controllers\Controller; // <--- INI OBATNYA! (Panggil Controller Utama)
use Illuminate\Http\Request;
use App\Models\Penjemputan;
use Illuminate\Support\Facades\Storage;

class PenjemputanController extends Controller
{
    public function index()
    {
        // Ambil data penjemputan, urutkan dari yang paling baru (latest)
        $logs = Penjemputan::with('siswa')->latest('waktu_jemput')->get();
        
        // Kirim ke tampilan
        return view('admin.penjemputan.index', compact('logs'));
    }

    public function destroy($id)
    {
        $log = Penjemputan::findOrFail($id);

        // Hapus foto jika ada
        if ($log->foto_bukti) {
            Storage::delete('public/' . $log->foto_bukti);
        }

        $log->delete();

        return redirect()->back()->with('success', 'Data penjemputan dihapus.');
    }
}