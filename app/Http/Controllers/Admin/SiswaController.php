<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with(['kelas','wali'])->paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $wali = WaliMurid::all();
        return view('admin.siswa.create', compact('kelas','wali'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'nis'           => 'required|string|max:50|unique:siswa,nis',
            'tanggal_lahir' => 'required|date',
            'kelas_id'      => 'required|exists:kelas,id',
            'wali_id'       => 'required|exists:wali_murid,id',
            'foto'          => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('siswa','public');
        }

        Siswa::create($validated);
        return redirect()->route('siswa.index')->with('success','Siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $wali = WaliMurid::all();
        return view('admin.siswa.edit', compact('siswa','kelas','wali'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'nis'           => 'required|string|max:50|unique:siswa,nis,'.$siswa->id,
            'tanggal_lahir' => 'required|date',
            'kelas_id'      => 'required|exists:kelas,id',
            'wali_id'       => 'required|exists:wali_murid,id',
            'foto'          => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('siswa','public');
        }

        $siswa->update($validated);
        return redirect()->route('siswa.index')->with('success','Siswa berhasil diupdate');
    }

    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success','Siswa berhasil dihapus');
    }
}
