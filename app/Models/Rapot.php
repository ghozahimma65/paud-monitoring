<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    use HasFactory;

    // Ini kuncinya biar semua kolom bisa diisi
    protected $guarded = [];

    // Relasi balik ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}