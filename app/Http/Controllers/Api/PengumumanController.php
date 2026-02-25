<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = \App\Models\Pengumuman::where('status', true)->latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }
}