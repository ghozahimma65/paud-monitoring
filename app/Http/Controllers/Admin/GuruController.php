<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::orderBy('created_at', 'desc')->get();
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama_guru' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::transaction(function () use ($request) {

            // A. SIMPAN KE TABEL USERS (Disini tempatnya Email & Password)
            $user = User::create([
                'name' => $request->nama_guru,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'guru',
            ]);

            // B. SIMPAN KE TABEL GURU (HANYA DATA PROFIL)
            Guru::create([
                'user_id' => $user->id,
                'nama_guru' => $request->nama_guru,
                'nip' => $request->nip,
                'jenis_guru' => $request->jenis_guru, // Pastikan kolom ini ada di tabel guru kamu
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,

                // ❌ JANGAN ADA baris 'email' => ... disini
                // ❌ JANGAN ADA baris 'password' => ... disini
            ]);

        });

        return redirect()->route('guru.index')->with('success', 'Berhasil menambahkan Guru!');
    }

    public function edit($id)
    {
        // PENTING: Tambahkan ->with('user') biar data email & nama akun ke-load
        $guru = Guru::with('user')->findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        // Cari data guru
        $guru = Guru::findOrFail($id);

        // 1. Validasi
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $guru->user_id,
            'password' => 'nullable|min:6',
            'no_hp' => 'nullable|string',
            'jenis_guru' => 'required|string',
            'nip' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $guru) {
            // Update User Login (jika ada)
            if ($guru->user) {
                $userData = [
                    'name' => $request->nama_guru,
                    'email' => $request->email,
                ];

                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }

                $guru->user->update($userData);
            }

            // Update Tabel Guru LANGSUNG
            $guru->update([
                'nama_guru' => $request->nama_guru,
                'no_hp' => $request->no_hp,
                'jenis_guru' => $request->jenis_guru,
                'nip' => $request->nip,
                'alamat' => $request->alamat,
            ]);
        });

        return redirect()->route('guru.index')->with('success', 'Data Guru berhasil diperbarui!');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}