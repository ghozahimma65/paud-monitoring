<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anekdot extends Model
{
    use HasFactory;

    protected $table = "anekdots"; // Pastikan nama tabelnya sesuai

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'tanggal',
        'waktu',
        'tempat',
        'uraian_kejadian',
        'kejadian_teramati', // TAMBAHKAN INI
        'analisis_capaian',
        'foto',
    ];
}
