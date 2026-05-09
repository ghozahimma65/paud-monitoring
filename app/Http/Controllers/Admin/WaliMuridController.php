<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliMurid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class WaliMuridController extends Controller
{
    public function index()
    {
        $walis = WaliMurid::with('user')->latest()->get();

        // PERBAIKAN DI SINI: Sesuaikan dengan nama folder 'wali'
        return view('admin.wali.index', compact('walis'));
    }

    public function create()
    {
        $zonas = \App\Models\MasterZona::orderBy('kategori', 'desc')->get()->groupBy('kategori');
        return view('admin.wali.create', compact('zonas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            // 1. Buat User Login
            $user = User::create([
                'name' => $request->nama_wali,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'wali_murid',
            ]);

            // 2. Buat Profil Wali
            WaliMurid::create([
                'user_id' => $user->id,
                'nama_wali' => $request->nama_wali,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'pekerjaan' => $request->pekerjaan,
                'master_zona_id' => $request->master_zona_id,
            ]);
        });

        return redirect()->route('wali-murid.index')->with('success', 'Berhasil! Akun Wali Murid siap digunakan.');
    }

    public function edit($id)
    {
        $data = WaliMurid::with('user')->findOrFail($id);
        $zonas = \App\Models\MasterZona::orderBy('kategori', 'desc')->get()->groupBy('kategori');
        return view('admin.wali.edit', compact('data', 'zonas'));
    }

    public function update(Request $request, $id)
    {
        $wali = WaliMurid::findOrFail($id);

        $request->validate([
            'nama_wali' => 'required',
            'email' => 'required|email|unique:users,email,' . $wali->user_id,
            'password' => 'nullable|min:6',
            'no_hp' => 'required',
        ]);

        DB::transaction(function () use ($request, $wali) {

            // 1. Update User Login
            if ($wali->user) {
                $userData = [
                    'name' => $request->nama_wali,
                    'email' => $request->email,
                ];

                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }

                $wali->user->update($userData);
            }

            // 2. Update Profil Wali
            $wali->update([
                'nama_wali' => $request->nama_wali,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'master_zona_id' => $request->master_zona_id,
                // 'pekerjaan' => $request->pekerjaan, // Form belum ada input pekerjaan
            ]);
        });

        return redirect()->route('wali-murid.index')->with('success', 'Data Wali Murid berhasil diperbarui');
    }

    public function destroy($id)
    {
        $wali = WaliMurid::findOrFail($id);

        if ($wali->user) {
            $wali->user->delete();
        } else {
            $wali->delete();
        }

        return redirect()->route('wali-murid.index')->with('success', 'Data Wali Murid berhasil dihapus');
    }
}