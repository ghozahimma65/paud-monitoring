<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa + data walinya (supaya tidak berat query-nya)
        $siswas = Siswa::with('wali')->latest()->get();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        // Ambil data wali untuk dropdown pilihan
        $walis = WaliMurid::orderBy('nama_wali', 'asc')->get();
        return view('admin.siswa.create', compact('walis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa'    => 'required|string|max:100',
            'wali_id'       => 'required|exists:wali_murids,id', // Wajib pilih wali yg valid
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir'  => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $walis = WaliMurid::orderBy('nama_wali', 'asc')->get();
        return view('admin.siswa.edit', compact('siswa', 'walis'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama_siswa'    => 'required|string|max:100',
            'wali_id'       => 'required|exists:wali_murids,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir'  => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil dihapus.');
    }
}