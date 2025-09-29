<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliMurid;
use App\Models\User;
use Illuminate\Http\Request;

class WaliMuridController extends Controller
{
    public function index()
    {
        // ambil semua wali murid + user terkait
        $wali = WaliMurid::with('user')->get();
        return view('admin.wali.index', compact('wali'));
    }

    public function create()
    {
        // ambil data user untuk dropdown (jika sudah punya akun)
        $users = User::where('role', 'wali')->get();
        return view('admin.wali.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'alamat'     => 'nullable|string',
            'lokasi_lat' => 'nullable|numeric',
            'lokasi_lng' => 'nullable|numeric',
        ]);

        WaliMurid::create($request->all());

        return redirect()->route('wali.index')->with('success', 'Wali Murid berhasil ditambahkan');
    }

    public function edit(WaliMurid $wali)
    {
        $users = User::where('role', 'wali')->get();
        return view('admin.wali.edit', compact('wali', 'users'));
    }

    public function update(Request $request, WaliMurid $wali)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'alamat'     => 'nullable|string',
            'lokasi_lat' => 'nullable|numeric',
            'lokasi_lng' => 'nullable|numeric',
        ]);

        $wali->update($request->all());

        return redirect()->route('wali.index')->with('success', 'Wali Murid berhasil diperbarui');
    }

    public function destroy(WaliMurid $wali)
    {
        $wali->delete();

        return redirect()->route('wali.index')->with('success', 'Wali Murid berhasil dihapus');
    }
}
