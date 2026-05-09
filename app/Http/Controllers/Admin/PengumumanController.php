<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'          => 'boolean',
        ]);

        // 2. Simpan Pengumuman ke Database
        $pengumuman = Pengumuman::create($request->all());

        // 3. Ambil semua FCM token user yang tidak null (guru & wali murid)
        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        // 4. Trigger Broadcast Notifikasi FCM
        if (count($tokens) > 0) {
            $notifTitle = "Pengumuman Baru: " . $pengumuman->judul;
            $notifBody  = "Ada pengumuman baru dari sekolah, yuk cek sekarang!";
            
            // Panggil method dari Controller dasar
            $this->sendFCMNotification($notifTitle, $notifBody, $tokens);
        }

        // 5. Redirect dengan pesan sukses
        return redirect()->route('pengumuman.index')
                         ->with('success', 'Pengumuman berhasil ditambahkan dan notifikasi telah dikirim.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'boolean',
        ]);

        $pengumuman->update($request->all());

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
