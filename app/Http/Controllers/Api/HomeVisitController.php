<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterZona;
use App\Models\Siswa;

class HomeVisitController extends Controller
{
    /**
     * Endpoint 1: Mendapatkan daftar zona, dikelompokkan berdasarkan kategori
     */
    public function getZonasi()
    {
        // Mengambil semua data zona dan mengelompokkan berdasarkan field 'kategori'
        $zonas = MasterZona::orderBy('kategori', 'desc')->get()->groupBy('kategori');
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data zonasi',
            'data'    => $zonas
        ]);
    }

    /**
     * Endpoint 2: Mendapatkan daftar siswa berdasarkan zona_id
     */
    public function getSiswaByZona($zona_id)
    {
        // Query Siswa yang berelasi dengan wali_murid, dimana wali_murid.master_zona_id = $zona_id
        $siswas = Siswa::with('wali_murid')
            ->whereHas('wali_murid', function ($query) use ($zona_id) {
                $query->where('master_zona_id', $zona_id);
            })
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data siswa di zona tersebut',
            'data'    => $siswas
        ]);
    }
}
