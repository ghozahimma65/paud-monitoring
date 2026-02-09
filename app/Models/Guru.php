<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru'; // ✅ Sudah Benar (Sesuai tabelmu)

    // ❌ HAPUS variable $fillable yang lama
    
    // ✅ PAKAI INI SAJA (Jurus Anti Ribet)
    // Artinya: Izinkan semua data masuk ke database
    protected $guarded = []; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}