<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\WaliMuridController;
use App\Http\Controllers\Admin\SiswaController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/test', function () {
        return response()->json(['message' => 'API works!']);
    });

    // pilih salah satu (saya sarankan pakai apiResource biar singkat)
    Route::apiResource('kelas', KelasController::class);
    Route::apiResource('guru', GuruController::class);
    Route::apiResource('wali', WaliMuridController::class);
    Route::apiResource('siswa', SiswaController::class);
});