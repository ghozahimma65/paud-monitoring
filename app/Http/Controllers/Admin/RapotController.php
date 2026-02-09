<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RapotController extends Controller
{
    public function create($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        return view('admin.rapot.create', compact('siswa'));
    }

    public function store(Request $request, $siswa_id)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'tanggal_rapot' => 'required|date',
            'narasi_agama' => 'required',
            'narasi_budi_pekerti' => 'required',
            'narasi_jati_diri' => 'required',
            'narasi_literasi' => 'required',
            'narasi_kokurikuler' => 'required', // E Wajib
        ]);

        Rapot::create([
            'siswa_id' => $siswa_id,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'tanggal_rapot' => $request->tanggal_rapot,

            // Narasi A-E
            'narasi_agama' => $request->narasi_agama,
            'narasi_budi_pekerti' => $request->narasi_budi_pekerti,
            'narasi_jati_diri' => $request->narasi_jati_diri,
            'narasi_literasi' => $request->narasi_literasi,
            'narasi_kokurikuler' => $request->narasi_kokurikuler,

            // TTD & Refleksi
            'refleksi_orang_tua' => $request->refleksi_orang_tua,
            'nama_guru' => $request->nama_guru,
            'nipy_guru' => $request->nipy_guru,
            'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
            'nipy_kepala_sekolah' => $request->nipy_kepala_sekolah,

            // Fisik
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'sakit' => $request->sakit ?? 0,
            'izin' => $request->izin ?? 0,
            'alpha' => $request->alpha ?? 0,
        ]);

        return redirect()->route('perkembangan.show', $siswa_id)->with('success', 'Rapot Berhasil Dibuat!');
    }

    public function show($id)
    {
        $rapot = Rapot::with('siswa')->findOrFail($id);
        return view('admin.rapot.show', compact('rapot'));
    }
    
    // Edit & Update bisa menyesuaikan strukturnya sama dengan Store
}