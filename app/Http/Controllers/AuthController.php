<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('web')->attempt($credentials)) {
    $request->session()->regenerate();
    return redirect()->intended('/dashboard');on()->regenerate();

        // cek role di sini
        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/dashboard');
        } else {
            Auth::logout();
            return back()->with('error', 'Hanya admin yang bisa login di website.');
        }
    }

    // kalau email atau password salah
    return back()->with('error', 'Username atau password salah!');
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
}