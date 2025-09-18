<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        return Kelas::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'umur_group' => 'nullable|string',
        ]);

        return Kelas::create($request->all());
    }

    public function show($id)
    {
        return Kelas::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return $kelas;
    }

    public function destroy($id)
    {
        return Kelas::destroy($id);
    }
}
