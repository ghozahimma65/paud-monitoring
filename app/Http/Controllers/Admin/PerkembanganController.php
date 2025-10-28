<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perkembangan;
use Illuminate\Http\Request;

class PerkembanganController extends Controller
{
    // ✅ Admin hanya bisa lihat (read-only)
    public function index()
{
    $perkembangans = Perkembangan::orderBy('tanggal', 'desc')->get();
    return view('admin.perkembangan.index', compact('perkembangans'));
}

    public function show($id)
    {
        $perkembangan = Perkembangan::with(['siswa', 'guru'])->findOrFail($id);
        return view('admin.perkembangan.show', compact('perkembangan'));
    }

    public function print($id)
    {
        $perkembangan = Perkembangan::with(['siswa', 'guru'])->findOrFail($id);
        return view('admin.perkembangan.print', compact('perkembangan'));
    }
}
