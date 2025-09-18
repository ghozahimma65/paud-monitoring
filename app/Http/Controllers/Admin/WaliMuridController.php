<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaliMurid;

class WaliMuridController extends Controller
{
    public function index()
    {
        return response()->json(WaliMurid::with('user')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'alamat'    => 'nullable|string',
            'pekerjaan' => 'nullable|string',
        ]);

        $wali = WaliMurid::create($request->all());
        return response()->json($wali, 201);
    }

    public function show($id)
    {
        $wali = WaliMurid::with('user')->findOrFail($id);
        return response()->json($wali);
    }

    public function update(Request $request, $id)
    {
        $wali = WaliMurid::findOrFail($id);
        $wali->update($request->all());
        return response()->json($wali);
    }

    public function destroy($id)
    {
        WaliMurid::destroy($id);
        return response()->json(['message' => 'Wali Murid deleted']);
    }
}