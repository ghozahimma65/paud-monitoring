<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anekdot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnekdotController extends Controller
{
    // Menampilkan form tambah anekdot
    public function create($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        return view('admin.anekdot.create', compact('siswa'));
    }

    // Menyimpan data anekdot
    public function store(Request $request, $siswa_id)
    {
        // 1. Validasi
        $request->validate([
            'tanggal'           => 'required|date',
            'waktu'             => 'required|string|max:50',
            'tempat'            => 'required|string|max:255',
            'uraian_kejadian'   => 'required|string',
            'analisis_capaian'  => 'nullable|string',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // 2. Ambil data mentah lalu tambahkan manual
        $data = $request->all();
        $data['siswa_id'] = $siswa_id;
        $data['guru_id'] = auth()->id();
        $data['kejadian_teramati'] = $request->uraian_kejadian; // ISI PAKSA
    
        // 3. Upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anekdot', 'public');
        }
    
        // 4. Simpan (Akan berhasil jika Model sudah diupdate fillable-nya)
        Anekdot::create($data);
    
        return redirect()
            ->route('perkembangan.show', $siswa_id)
            ->with('success', 'Catatan anekdot berhasil disimpan!');
    }
}
