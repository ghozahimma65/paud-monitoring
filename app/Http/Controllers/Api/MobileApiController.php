<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Penjemputan;
use App\Models\Anekdot;
use App\Models\HasilKarya;
use App\Models\PenilaianCeklis;

class MobileApiController extends Controller
{
    // ==========================================
    // 1. OTENTIKASI (LOGIN UMUM GURU & WALI)
    // ==========================================
    public function login(Request $request)
    {
        // Cek email & password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            
            // Cek role: Hanya Guru dan Wali yang boleh login di HP
            if ($user->role !== 'guru' && $user->role !== 'wali') {
                return response()->json([
                    'success' => false, 
                    'message' => 'Maaf, Admin hanya bisa login di Website/Laptop.'
                ], 403);
            }

            // Buat Token
            $token = $user->createToken('MobileAppToken')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'user'    => $user,  // Disini ada info 'role' (guru/wali)
                'token'   => $token,
            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'Email atau Password Salah'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logout Berhasil']);
    }

    // ==========================================
    // 2. FITUR KHUSUS GURU 👩‍🏫
    // ==========================================
    
    // Ambil Daftar Siswa (Untuk dipilih saat input nilai)
    public function getSiswa(Request $request)
    {
        // Opsional: Bisa difilter berdasarkan kelas guru tersebut
        $siswas = Siswa::orderBy('nama', 'asc')->get();
        return response()->json(['success' => true, 'data' => $siswas]);
    }

    // Input Anekdot
    public function storeAnekdot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'tanggal' => 'required|date',
            'kejadian_teramati' => 'required',
            'analisis_capaian' => 'required',
        ]);

        if ($validator->fails()) return response()->json($validator->errors(), 400);

        Anekdot::create($request->all());
        return response()->json(['success' => true, 'message' => 'Anekdot berhasil disimpan']);
    }

    // Input Hasil Karya (Upload Foto)
    public function storeKarya(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'required|image',
            'analisis_capaian' => 'required',
        ]);

        if ($validator->fails()) return response()->json($validator->errors(), 400);

        // Simpan foto ke folder public/storage/karya
        $path = $request->file('foto')->store('karya', 'public');

        HasilKarya::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'foto' => $path,
            'deskripsi_foto' => $request->deskripsi_foto,
            'analisis_capaian' => $request->analisis_capaian,
        ]);

        return response()->json(['success' => true, 'message' => 'Karya berhasil disimpan']);
    }

    // Scan QR Code (Input Penjemputan)
    public function storePenjemputan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required', // Didapat dari hasil Scan QR
            'nama_penjemput' => 'required',
            'status_hubungan' => 'required',
            'foto' => 'nullable|image', 
        ]);

        if ($validator->fails()) return response()->json($validator->errors(), 400);

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

    // ==========================================
    // 3. FITUR KHUSUS WALI MURID 👪
    // ==========================================

    // Ambil Data Anak Saya (Berdasarkan Login Wali)
    public function getAnakSaya(Request $request)
    {
        $user = Auth::user();
        // Asumsi: Di tabel siswas ada kolom 'user_id' yang nyambung ke Wali
        // Atau tabel users punya relasi ke siswa.
        // Kita pakai cara paling umum: Cari siswa yang wali_id nya = ID User login
        
        // Cek dulu apakah di tabel siswa ada kolom wali_id atau user_id?
        // Kalau belum ada relasi, kita ambil dummy dulu atau cari berdasarkan nama (sementara)
        // SEMENTARA: Kita ambil 1 siswa pertama sebagai contoh (Nanti kita perbaiki relasinya)
        $anak = Siswa::first(); 

        return response()->json(['success' => true, 'data' => $anak]);
    }

    // Lihat Rapot Anak Saya
    public function getRapotAnak(Request $request)
    {
        // Ambil ID siswa dari request (dikirim dari HP)
        $siswa_id = $request->siswa_id;

        $anekdots = Anekdot::where('siswa_id', $siswa_id)->orderBy('tanggal', 'desc')->get();
        $karyas = HasilKarya::where('siswa_id', $siswa_id)->orderBy('tanggal', 'desc')->get();
        // $ceklis = ... (Menyusul)

        return response()->json([
            'success' => true,
            'data' => [
                'anekdots' => $anekdots,
                'karyas' => $karyas,
            ]
        ]);
    }
}