<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua data siswa beserta data walinya
        $siswa = Siswa::with(['wali_murid', 'kelompok'])->get();

        return response()->json([
            'success' => true,
            'data'    => $siswa
        ]);
    }
}