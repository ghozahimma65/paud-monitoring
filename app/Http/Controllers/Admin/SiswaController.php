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
        // Kita load data wali_murid biar bisa ambil alamatnya nanti
        $siswas = Siswa::with('wali_murid')->latest()->get();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $wali_murids = WaliMurid::all();
        return view('admin.siswa.create', compact('wali_murids'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'           => 'required|unique:siswas,nis',
            'nisn'          => 'nullable|string',
            'nama_siswa'    => 'required|string|max:255',
            'tempat_lahir'  => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'wali_murid_id' => 'required|exists:wali_murids,id',
            // Alamat dihapus, karena ikut Wali Murid
        ]);

        Siswa::create([
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,
            'nama_siswa'    => $request->nama_siswa,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'wali_murid_id' => $request->wali_murid_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $wali_murids = WaliMurid::all();
        return view('admin.siswa.edit', compact('siswa', 'wali_murids'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nis'           => 'required|unique:siswas,nis,'.$id,
            'nisn'          => 'nullable|string',
            'nama_siswa'    => 'required|string|max:255',
            'tempat_lahir'  => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'wali_murid_id' => 'required|exists:wali_murids,id',
        ]);

        $siswa->update([
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,
            'nama_siswa'    => $request->nama_siswa,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'wali_murid_id' => $request->wali_murid_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil dihapus!');
    }
}