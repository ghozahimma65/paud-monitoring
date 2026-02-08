<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\WaliMuridController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PerkembanganController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\PenjemputanController;

// Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Splash
Route::get('/', function () {
    return view('splash');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pengumuman', PengumumanController::class);

    Route::prefix('admin')->group(function () {

        Route::resource('guru', GuruController::class);
        Route::resource('wali-murid', WaliMuridController::class);
        Route::resource('siswa', SiswaController::class);

        // --- BAGIAN PERKEMBANGAN (YANG KITA PERBAIKI) ---
                // 1. Halaman Index (Daftar Siswa)
                Route::get('/perkembangan', [PerkembanganController::class, 'index'])
                    ->name('admin.perkembangan.index');
        
                // 2. Halaman Detail Rapot (Show) -> Nama rute: 'perkembangan.show'
                Route::get('/perkembangan/{id}', [PerkembanganController::class, 'show'])
                    ->name('perkembangan.show'); 
        
                // 3. Halaman Cetak (Print) -> Nama rute: 'perkembangan.print'
                Route::get('/perkembangan/{id}/print', [PerkembanganController::class, 'print'])
                    ->name('perkembangan.print'); 
                // ----------------------------------------
        
        // Akun
        Route::resource('akun', AkunController::class);
        Route::post('akun/{akun}/reset-password', [AkunController::class, 'resetPassword'])->name('akun.resetPassword');
        
        Route::get('/penjemputan', [PenjemputanController::class, 'index'])->name('penjemputan.index');
        Route::delete('/penjemputan/{id}', [PenjemputanController::class, 'destroy'])->name('penjemputan.destroy');
        
        // === ROUTE RAPOT ===
            // Form Input Rapot Baru
            Route::get('/siswa/{id}/rapot/create', [App\Http\Controllers\Admin\RapotController::class, 'create'])->name('rapot.create');
            
            // Simpan Data Rapot
            Route::post('/siswa/{id}/rapot', [App\Http\Controllers\Admin\RapotController::class, 'store'])->name('rapot.store');
            
            // Lihat Detail/Cetak Rapot
            Route::get('/rapot/{id}', [App\Http\Controllers\Admin\RapotController::class, 'show'])->name('rapot.show');
            
            // Cetak PDF (Nanti)
            Route::get('/rapot/{id}/print', [App\Http\Controllers\Admin\RapotController::class, 'print'])->name('rapot.print');
    });

});