<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\WaliMuridController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Guru\PerkembanganController as GuruPerkembangan;
use App\Http\Controllers\Admin\PerkembanganController as AdminPerkembangan;

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
        Route::resource('wali', WaliMuridController::class);
        Route::resource('siswa', SiswaController::class);

Route::middleware(['auth','role:guru'])->prefix('guru')->name('guru.')->group(function(){
    Route::resource('perkembangan', GuruPerkembangan::class);
});

Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('perkembangan', [AdminPerkembangan::class, 'index'])->name('perkembangan.index');
    Route::get('perkembangan/{id}', [AdminPerkembangan::class, 'show'])->name('perkembangan.show');
});
    });
});