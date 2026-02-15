<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Panggil Controller Khusus API (Bukan Admin!)
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\PenjemputanController;

/*
|--------------------------------------------------------------------------
| API Routes (Jembatan Android)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PINTU MASUK (PUBLIC)
// ==========================================
Route::post('/login', [AuthController::class, 'login']); // Login Guru & Wali

Route::get('/pengumuman', [PengumumanController::class, 'index']); // Info Sekolah

// --- KHUSUS WALI MURID (Lihat Data) ---
// Wali melihat daftar anaknya
 
// ==========================================
// 2. AREA TERKUNCI (BUTUH TOKEN)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // --- UMUM ---
    Route::get('/siswa-saya', [SiswaController::class, 'index']); // Pindah ke sini biar bisa baca Auth::user()
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) { 
        return $request->user(); // Cek siapa yang login
    });

    
    // Wali melihat laporan (Wajib kirim ?siswa_id=1 di URL)
    Route::get('/anekdot', [LaporanController::class, 'getAnekdot']); 
    Route::get('/karya', [LaporanController::class, 'getKarya']);
    Route::get('/penjemputan', [LaporanController::class, 'getPenjemputan']);


    // --- KHUSUS GURU (Input Data) ---
    // Nanti kalau Guru login di HP untuk input data:
    Route::post('/guru/anekdot', [GuruController::class, 'storeAnekdot']);
    Route::post('/guru/karya', [GuruController::class, 'storeKarya']);
    Route::post('/guru/penjemputan', [GuruController::class, 'storePenjemputan']);
    Route::post('/guru/ceklis', [GuruController::class, 'storeCeklis']);

    // RUTE PENJEMPUTAN BARU
    Route::post('/penjemputan', [PenjemputanController::class, 'store']);
});

