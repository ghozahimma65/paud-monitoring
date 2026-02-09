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
            // 1. Ambil input email & password
            $credentials = $request->only('email', 'password');
    
            // 2. Coba Login
            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();
    
                // --- 🛡️ SATPAM (LOGIKA BLOKIR) ---
                
                // Cek Role User yang baru saja login
                $user = Auth::user();
    
                // Jika role-nya 'wali_murid', TOLAK!
                if ($user->role === 'wali_murid') {
                    Auth::logout(); // Logout paksa
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
    
                    return back()->with('error', 'Maaf, Wali Murid hanya bisa login lewat Aplikasi Android!');
                }
    
                // Jika Admin ATAU Guru, lolos ke Dashboard
                return redirect()->intended('/dashboard');
            }
    
            // 3. Kalau email atau password salah
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