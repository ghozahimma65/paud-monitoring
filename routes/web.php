<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/', function () {
    return view('splash'); // tampilan splash screen

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
});
