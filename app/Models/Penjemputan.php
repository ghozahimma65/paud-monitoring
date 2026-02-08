<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    use HasFactory;

    protected $table = 'penjemputans';
    
    // Kita pakai guarded kosong biar semua kolom bisa diisi
    protected $guarded = [];

    // Relasi: Penjemputan milik Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}