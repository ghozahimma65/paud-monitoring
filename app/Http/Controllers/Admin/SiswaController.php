<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        return response()->json(Siswa::with(['kelas', 'wali'])->get());
    }

    public function store(SiswaRequest $request)
    {
        $siswa = Siswa::create($request->validated());

        return response()->json([
            'message' => 'Siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }

    public function show($id)
    {
        $siswa = Siswa::with(['kelas', 'wali'])->findOrFail($id);

        return response()->json($siswa);
    }

    public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'nis' => 'required|string|max:50|unique:siswas,nis,' . $id . ',id',
        'tanggal_lahir' => 'required|date',
        'kelas_id' => 'required|exists:kelas,id',
        'wali_id' => 'required|exists:wali_murids,id', // <- pastikan nama tabel wali sesuai
        'foto' => 'nullable|string',
    ]);

    $siswa->update($validatedData);

    return response()->json([
        'message' => 'Siswa berhasil diupdate',
        'data' => $siswa
    ], 200);
}

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json([
            'message' => 'Siswa berhasil dihapus'
        ]);
    }
}