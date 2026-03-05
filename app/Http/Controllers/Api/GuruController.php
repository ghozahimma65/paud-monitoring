<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anekdot;
use App\Models\HasilKarya;
use App\Models\Penjemputan;
use App\Models\PenilaianCeklis;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    // Input Rapot Guru Mobile
    public function storeRapot(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'nilai_aik' => 'required|string',
            'nilai_budi_pekerti' => 'required|string',
            'nilai_jati_diri' => 'required|string',
            'nilai_literasi_steam' => 'required|string',
            'nilai_kokurikuler' => 'required|string',
            // 'catatan_guru' => 'nullable|string', // Admin Rapot model does not have catatan_guru
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'lingkar_kepala' => 'required|numeric',
            'sakit' => 'required|numeric',
            'izin' => 'required|numeric',
            'alpha' => 'required|numeric',
        ]);

        try {
            // Gunakan Model Rapot (sesuai Web Admin)
            $rapot = new \App\Models\Rapot();
            $rapot->siswa_id = $request->siswa_id;
            $rapot->semester = $request->semester;
            $rapot->tahun_ajaran = $request->tahun_ajaran;
            $rapot->tanggal_rapot = now()->format('Y-m-d');
            
            // Map ke kolom Model Rapot
            $rapot->narasi_agama = $request->nilai_aik;
            $rapot->narasi_budi_pekerti = $request->nilai_budi_pekerti;
            $rapot->narasi_jati_diri = $request->nilai_jati_diri;
            $rapot->narasi_literasi = $request->nilai_literasi_steam;
            $rapot->narasi_kokurikuler = $request->nilai_kokurikuler;
            
            $rapot->tinggi_badan = $request->tinggi_badan;
            $rapot->berat_badan = $request->berat_badan;
            $rapot->lingkar_kepala = $request->lingkar_kepala;
            $rapot->sakit = $request->sakit;
            $rapot->izin = $request->izin;
            $rapot->alpha = $request->alpha;
            
            // Default Guru name from logged in user if available
            $rapot->nama_guru = auth()->user()->name ?? 'Guru PAUD';
            
            $rapot->save();

            return response()->json([
                'success' => true,
                'message' => 'Data Rapot berhasil disimpan',
                'data' => $rapot
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan rapot: ' . $e->getMessage()
            ], 500);
        }
    }

    // 1. Input Catatan Anekdot
    public function storeAnekdot(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required|date',
            'kejadian_teramati' => 'required',
            'analisis_capaian' => 'required',
        ]);

        // Otomatis isi guru_id dari user yang login
        $data = $request->all();
        $data['guru_id'] = $request->user()->id; 

        Anekdot::create($data);

        return response()->json(['success' => true, 'message' => 'Anekdot berhasil disimpan']);
    }

    // Ambil Riwayat Anekdot yang dibuat oleh Guru yang login
    public function getAnekdot(Request $request)
    {
        $data = Anekdot::with('siswa')->where('guru_id', $request->user()->id)->latest()->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    // Ambil Riwayat Hasil Karya yang dibuat oleh Guru yang login
    public function getKarya(Request $request)
    {
        $data = HasilKarya::with('siswa')->where('guru_id', $request->user()->id)->latest()->get();
        
        $data->transform(function ($item) {
            $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
            return $item;
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    // Ambil Riwayat Ceklis yang dibuat oleh Guru yang login
    public function getCeklis(Request $request)
    {
        $data = PenilaianCeklis::with('siswa')->where('guru_id', $request->user()->id)->latest()->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    // 2. Input Hasil Karya (Upload Foto)
    public function storeKarya(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'required|image|max:5120', // Max 5MB
            'analisis_capaian' => 'required',
        ]);

        // Upload Foto
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('karya', 'public');
        }

        HasilKarya::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->user()->id,
            'tanggal' => $request->tanggal,
            'foto' => $path,
            'deskripsi_foto' => $request->deskripsi_foto,
            'analisis_capaian' => $request->analisis_capaian,
        ]);

        return response()->json(['success' => true, 'message' => 'Karya berhasil disimpan']);
    }

    public function storeCeklis(Request $request)
    {
        // Validasi disesuaikan dengan struktur tabel penilaian_ceklis kamu
        $request->validate([
            'siswa_id'           => 'required|exists:siswas,id',
            'tanggal'            => 'required|date',
            'aspek_perkembangan' => 'required|string',
            'indikator'          => 'required|string',
            'hasil'              => 'required|in:BB,MB,BSH,BSB', // Validasi skala PAUD
            'keterangan'         => 'nullable|string',
        ]);

        // Simpan data ke database
        $ceklis = PenilaianCeklis::create([
            'siswa_id'           => $request->siswa_id,
            'guru_id'            => $request->user()->id, // Ambil ID dari Guru yang login
            'tanggal'            => $request->tanggal,
            'aspek_perkembangan' => $request->aspek_perkembangan,
            'indikator'          => $request->indikator,
            'hasil'              => $request->hasil,
            'keterangan'         => $request->keterangan,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Penilaian Ceklis berhasil disimpan',
            'data'    => $ceklis
        ], 201);
    }

    // 3. Input Penjemputan (Scan QR)
    public function storePenjemputan(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'nama_penjemput' => 'required',
            'status_hubungan' => 'required',
            'foto' => 'nullable|image', 
        ]);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('penjemputan', 'public');
        }

        Penjemputan::create([
            'siswa_id' => $request->siswa_id,
            'nama_penjemput' => $request->nama_penjemput,
            'status_hubungan' => $request->status_hubungan,
            'foto_bukti' => $pathFoto,
            'waktu_jemput' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Data penjemputan tercatat']);
    }

    // 4. Scan QR Penjemputan
    public function scanJemput(Request $request)
    {
        $request->validate([
            'qr_code' => 'required',
        ]);

        // Cari siswa berdasarkan qr_code (Biasanya NIS atau ID Siswa)
        $siswa = Siswa::where('nis', $request->qr_code)
                      ->orWhere('id', $request->qr_code)
                      ->first();

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak valid! Data siswa tidak ditemukan.'
            ], 404);
        }

        // Catat Penjemputan
        // Kita bisa atur default nama penjemput "Orang Tua/Wali"
        Penjemputan::create([
            'siswa_id' => $siswa->id,
            'nama_penjemput' => 'Orang Tua / Wali', 
            'status_hubungan' => 'Orang Tua',
            'waktu_jemput' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mencatat penjemputan untuk ' . $siswa->nama_lengkap
        ]);
    }
}