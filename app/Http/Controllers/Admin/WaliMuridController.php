<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class WaliMuridController extends Controller
{
    public function index()
    {
        $walis = WaliMurid::latest()->get();
        return view('admin.wali.index', compact('walis'));
    }

    public function create()
    {
        return view('admin.wali.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required|string|max:100',
            'no_hp'     => 'nullable|string|max:20',
            'alamat'    => 'nullable|string',
        ]);

        WaliMurid::create($request->all());

        return redirect()->route('wali-murid.index')->with('success', 'Data Wali Murid berhasil ditambahkan.');
    }

    public function edit($id)
        {
            // Kita pakai nama variable $data biar netral dan pasti beda
            $data = WaliMurid::with('user')->findOrFail($id);
            
            // Kirim ke view dengan nama 'data'
            return view('admin.wali.edit', compact('data'));
        }
    
        public function update(Request $request, $id)
        {
            $data = WaliMurid::findOrFail($id);
    
            $request->validate([
                'nama_wali' => 'required|string|max:255',
                // Cek email unik kecuali user ini ($data->user_id)
                'email'     => 'nullable|email|unique:users,email,' . ($data->user_id ?? 0),
                'no_hp'     => 'nullable|string',
                'alamat'    => 'nullable|string',
            ]);
    
            // 1. Update User (Jika ada)
            if ($data->user) {
                $data->user->update([
                    'name'  => $request->nama_wali,
                    'email' => $request->email,
                ]);
            }
    
            // 2. Update Data Wali
            $data->update([
                'nama_wali' => $request->nama_wali,
                'no_hp'     => $request->no_hp,
                'alamat'    => $request->alamat,
            ]);
    
            return redirect()->route('wali-murid.index')->with('success', 'Data Wali Murid berhasil diperbarui!');
        }
    
        // --- DELETE (Perbaikan Hapus User juga) ---
        public function destroy($id)
        {
            $waliMurid = WaliMurid::findOrFail($id);
    
            // Hapus akun loginnya juga biar bersih
            if ($waliMurid->user) {
                $waliMurid->user->delete();
            }
    
            $waliMurid->delete();
    
            return redirect()->route('wali-murid.index')->with('success', 'Data Wali Murid berhasil dihapus!');
        }
}