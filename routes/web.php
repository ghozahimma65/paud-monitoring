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

        Route::get('/perkembangan', [PerkembanganController::class, 'index'])->name('admin.perkembangan.index');
        Route::get('/perkembangan/{id}', [PerkembanganController::class, 'show'])->name('admin.perkembangan.show');
        Route::get('/perkembangan/{id}/print', [PerkembanganController::class, 'print'])->name('admin.perkembangan.print');

        // Akun
        Route::resource('akun', AkunController::class);
        Route::post('akun/{akun}/reset-password', [AkunController::class, 'resetPassword'])->name('akun.resetPassword');
    });

});