<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        \Log::info('Login Request Recieved', $request->all());
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            \Log::info('Auth::attempt success');
            $user = Auth::user();
            \Log::info('User retrieved', ['id' => $user->id]);
            
            $token = $user->createToken('auth_token')->plainTextToken;
            \Log::info('Token created');

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'user'    => $user,
                'token'   => $token
            ], 200);
        }

        \Log::info('Auth::attempt failed');

        return response()->json([
            'success' => false,
            'message' => 'Email atau Password salah'
        ], 401);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Berhasil Logout']);
    }

    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string'
        ]);

        $user = Auth::user();
        if ($user) {
            $user->update(['fcm_token' => $request->fcm_token]);
            return response()->json([
                'success' => true,
                'message' => 'FCM Token updated successfully'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated'
        ], 401);
    }
}