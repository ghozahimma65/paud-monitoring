<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Pastikan guarded kosong biar semua kolom bisa diisi
    protected $guarded = [];

    // Relasi ke Wali Murid
    public function wali_murid()
    {
        return $this->belongsTo(WaliMurid::class, 'wali_murid_id');
    }
}