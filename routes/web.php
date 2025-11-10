<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\WaliMuridController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PerkembanganController;

// Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Splash screen (halaman awal)
Route::get('/', function () {
    return view('splash');
});

// Hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengumuman', \App\Http\Controllers\Admin\PengumumanController::class);

Route::prefix('admin')->group(function () {
        Route::resource('guru', GuruController::class);
        Route::resource('wali-murid', WaliMuridController::class);
        Route::resource('siswa', SiswaController::class);

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/perkembangan', [PerkembanganController::class, 'index'])->name('admin.perkembangan.index');
        Route::get('/perkembangan/{id}', [PerkembanganController::class, 'show'])->name('admin.perkembangan.show');
        Route::get('/perkembangan/{id}/print', [PerkembanganController::class, 'print'])->name('admin.perkembangan.print');
    });
});
}); 
});