<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilKarya;
use App\Models\Siswa;
use Illuminate\Http\Request;

class HasilKaryaController extends Controller
{
    public function create($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        return view('admin.hasil_karya.create', compact('siswa'));
    }

    public function store(Request $request, $siswa_id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'foto' => 'required|image|max:2048', // Foto wajib ada untuk hasil karya
            'deskripsi_foto' => 'required', // Sesuai nama kolom di DB kamu
            'analisis_capaian' => 'nullable',
        ]);

        $data = $request->all();
        $data['siswa_id'] = $siswa_id;
        $data['guru_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/hasil_karya', $filename);
            $data['foto'] = $filename;
        }

        HasilKarya::create($data);

        return redirect()->route('perkembangan.show', $siswa_id)
                         ->with('success', 'Hasil Karya berhasil diupload!');
    }
}