<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class WaliMuridController extends Controller
{
    public function index()
    {
        $walis = WaliMurid::latest()->get();
        return view('admin.wali.index', compact('walis'));
    }

    public function create()
    {
        return view('admin.wali.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required|string|max:100',
            'no_hp'     => 'nullable|string|max:20',
            'alamat'    => 'nullable|string',
        ]);

        WaliMurid::create($request->all());

        return redirect()->route('wali-murid.index')->with('success', 'Data Wali Murid berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $wali = WaliMurid::findOrFail($id);
        return view('admin.wali.edit', compact('wali'));
    }

    public function update(Request $request, $id)
    {
        $wali = WaliMurid::findOrFail($id);
        
        $request->validate([
            'nama_wali' => 'required|string|max:100',
            'no_hp'     => 'nullable|string|max:20',
            'alamat'    => 'nullable|string',
        ]);

        $wali->update($request->all());

        return redirect()->route('wali-murid.index')->with('success', 'Data Wali Murid berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $wali = WaliMurid::findOrFail($id);

        // --- LOGIC AMAN (Mencegah Error Database) ---
        // Cek apakah wali ini punya anak didik (siswa)
        // Pastikan di Model WaliMurid sudah ada relasi: public function siswas()
        $jumlah_siswa = $wali->siswas()->count();

        if ($jumlah_siswa > 0) {
            // Jika masih punya siswa, BATALKAN hapus & beri pesan Error
            return redirect()->route('wali-murid.index')->with('error', '❌ Gagal Hapus! Wali ini masih terhubung dengan ' . $jumlah_siswa . ' data Siswa. Hapus atau pindahkan data siswanya dulu.');
        }

        // Jika tidak punya siswa, baru boleh dihapus
        $wali->delete();
        
        return redirect()->route('wali-murid.index')->with('success', '✅ Data Wali Murid berhasil dihapus.');
    }
}