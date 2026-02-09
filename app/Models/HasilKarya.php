<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKarya extends Model
{
    use HasFactory;

    protected $table = "hasil_karyas"; // Pastikan nama tabelnya sesuai
    
    protected $fillable = [
        'siswa_id',
        'guru_id',
        'tanggal',
        'foto',
        'deskripsi_foto', // Pastikan ini sama persis dengan DB
        'analisis_capaian'
    ];
}
