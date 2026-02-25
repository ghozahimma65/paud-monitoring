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
            'siswa_id'  => 'required|exists:siswas,id',
            'tanggal'   => 'required|date',
            'indikator' => 'required|string',
            'hasil'     => 'required|in:BB,MB,BSH,BSB', // Validasi skala PAUD
            'keterangan'=> 'nullable|string',
        ]);

        // Simpan data ke database
        $ceklis = PenilaianCeklis::create([
            'siswa_id'  => $request->siswa_id,
            'guru_id'   => $request->user()->id, // Ambil ID dari Guru yang login
            'tanggal'   => $request->tanggal,
            'indikator' => $request->indikator,
            'hasil'     => $request->hasil,
            'keterangan'=> $request->keterangan,
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