<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

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
        // Validasi disesuaikan dengan kolom database
        $request->validate([
            'nama_guru'  => 'required|string|max:100',
            'email'      => 'nullable|email|max:100',
            'no_hp'      => 'nullable|string|max:20',
            'jenis_guru' => 'required|in:guru_kelas,shadow_abk', // UBAH 'bidang' JADI 'jenis_guru'
        ]);

        Guru::create($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
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
                    'nama_guru'  => 'required|string|max:255', // Harus nama_guru
                    'email'      => 'required|email',
                    'no_hp'      => 'nullable|string',
                    'jenis_guru' => 'required|string',
                ]);
        
                // 2. Update Tabel Guru LANGSUNG
                // Kita abaikan tabel user dulu karena user_id kamu masih NULL
                $guru->update([
                    'nama_guru'  => $request->nama_guru, // Masukkan ke kolom nama_guru
                    'email'      => $request->email,
                    'no_hp'      => $request->no_hp,
                    'jenis_guru' => $request->jenis_guru,
                ]);
        
                return redirect()->route('guru.index')->with('success', 'Data Guru berhasil diperbarui!');
            }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}