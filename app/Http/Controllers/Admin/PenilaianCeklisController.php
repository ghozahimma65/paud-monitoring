<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenilaianCeklis; // Pakai model yang benar
use App\Models\Siswa;
use Illuminate\Http\Request;

class PenilaianCeklisController extends Controller
{
    public function create($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        // Pastikan view-nya mengarah ke folder yang benar
        return view('admin.ceklis.create', compact('siswa'));
    }

    public function store(Request $request, $siswa_id)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'indikator'   => 'required|string',
            'hasil'       => 'required|in:BB,MB,BSH,BSB', // Validasi 'hasil'
            'keterangan'  => 'nullable|string',
        ]);

        $data = $request->all();
        $data['siswa_id'] = $siswa_id;
        $data['guru_id'] = auth()->id();

        PenilaianCeklis::create($data);

        return redirect()->route('perkembangan.show', $siswa_id)
                         ->with('success', 'Data penilaian ceklis berhasil disimpan!');
    }
}