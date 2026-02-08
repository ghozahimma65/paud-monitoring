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
            $siswa = \App\Models\Siswa::findOrFail($siswa_id);
            
            // PERBAIKAN: Ambil data dari Model 'Guru', bukan 'User'
            // Kita ambil semua guru, diurutkan berdasarkan nama
            $gurus = \App\Models\Guru::orderBy('nama_guru', 'asc')->get();
    
            return view('admin.rapot.create', compact('siswa', 'gurus'));
        }

    // 2. SIMPAN DATA RAPOT KE DATABASE
    public function store(Request $request, $siswa_id)
        {
            $request->validate([
                'semester' => 'required',
                'tahun_ajaran' => 'required',
                'tanggal_rapot' => 'required|date',
                'nama_guru' => 'required',
                'nama_kepala_sekolah' => 'required',
            ]);
    
            Rapot::create([
                'siswa_id' => $siswa_id,
                'semester' => $request->semester,
                'tahun_ajaran' => $request->tahun_ajaran,
                'tanggal_rapot' => $request->tanggal_rapot,
    
                // Urutan A-E Sesuai PDF
                'narasi_aik' => $request->narasi_aik,
                'narasi_nilai_agama' => $request->narasi_nilai_agama,
                'narasi_jati_diri' => $request->narasi_jati_diri,
                'narasi_literasi' => $request->narasi_literasi,
                'narasi_kokurikuler' => $request->narasi_kokurikuler, // Kolom Baru
    
                // Fisik & Kehadiran
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'lingkar_kepala' => $request->lingkar_kepala,
                'lingkar_lengan' => $request->lingkar_lengan,
                'sakit' => $request->sakit ?? 0,
                'izin' => $request->izin ?? 0,
                'alpha' => $request->alpha ?? 0,
    
                // Refleksi & TTD
                'refleksi_orang_tua' => $request->refleksi_orang_tua,
                'nama_guru' => $request->nama_guru,
                'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
                'nbm_kepala_sekolah' => $request->nbm_kepala_sekolah,
            ]);
    
            return redirect()->route('perkembangan.show', $siswa_id)
                             ->with('success', 'Rapot berhasil dibuat!');
        }

    // 3. LIHAT DETAIL RAPOT (PREVIEW SEBELUM CETAK)
    public function show($id)
    {
        $rapot = Rapot::with('siswa')->findOrFail($id);
        return view('admin.rapot.show', compact('rapot'));
    }

    // 4. CETAK PDF (Nanti kita bahas fitur ini)
    public function print($id)
    {
        $rapot = Rapot::with('siswa')->findOrFail($id);
        return view('admin.rapot.print', compact('rapot'));
    }
}