<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        // Sementara kita return array kosong dulu atau contoh data
        return response()->json([
            'success' => true,
            'data'    => [
                ['judul' => 'Libur Nasional', 'isi' => 'Besok sekolah libur ya bunda.'],
            ]
        ]);
    }
}