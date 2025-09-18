<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        return response()->json(Guru::with('user')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bidang'  => 'required|string|max:255',
        ]);

        $guru = Guru::create($request->all());
        return response()->json($guru, 201);
    }

    public function show($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return response()->json($guru);
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return response()->json($guru);
    }

    public function destroy($id)
    {
        Guru::destroy($id);
        return response()->json(['message' => 'Guru deleted']);
    }
}