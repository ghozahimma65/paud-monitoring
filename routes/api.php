<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\WaliMuridController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Api\PerkembanganController as ApiPerkembangan;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/test', function () {
        return response()->json(['message' => 'API works!']);
    });

    // pilih salah satu (saya sarankan pakai apiResource biar singkat)
    Route::apiResource('kelas', KelasController::class);
    Route::apiResource('guru', GuruController::class)->names([
        'index' => 'api.guru.index',
        'show' => 'api.guru.show',
        'store' => 'api.guru.store',
        'update' => 'api.guru.update',
        'destroy' => 'api.guru.destroy',
    ]);
    Route::apiResource('wali', WaliMuridController::class)->names([
        'index' => 'api.wali.index',
        'show' => 'api.wali.show',
        'store' => 'api.wali.store',
        'update' => 'api.wali.update',
        'destroy' => 'api.wali.destroy',
    ]);
    Route::apiResource('siswa', SiswaController::class)->names([
        'index' => 'api.siswa.index',
        'show' => 'api.siswa.show',
        'store' => 'api.siswa.store',
        'update' => 'api.siswa.update',
        'destroy' => 'api.siswa.destroy',
    ]);
});