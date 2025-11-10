<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class WaliMuridController extends Controller
{
    public function index()
    {
        $wali_murids = WaliMurid::orderBy('created_at', 'desc')->get();
        return view('admin.wali_murid.index', compact('wali_murids'));
    }

    public function create()
    {
        return view('admin.wali_murid.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);
    
        WaliMurid::create($request->only(['nama_wali', 'email', 'no_hp', 'alamat']));
    
        return redirect()->route('wali-murid.index')->with('success', 'Data wali murid berhasil ditambahkan.');
    }
    public function edit(WaliMurid $wali_murid)
    {
        return view('admin.wali_murid.edit', compact('wali_murid'));
    }

    public function update(Request $request, WaliMurid $wali_murid)
    {
        $request->validate([
            'nama_wali' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        $wali_murid->update($request->all());

        return redirect()->route('wali-murid.index')->with('success', 'Data wali murid berhasil diperbarui.');
    }

    public function destroy(WaliMurid $wali_murid)
    {
        $wali_murid->delete();

        return redirect()->route('wali-murid.index')->with('success', 'Data wali murid berhasil dihapus.');
    }
}
