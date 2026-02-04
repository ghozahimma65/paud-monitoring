<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    use HasFactory;

    protected $table = 'wali_murids'; // Default laravel biasanya plural

    protected $fillable = [
        'user_id',
        'nama_wali', // Pastikan kolom di DB 'nama_wali', bukan 'nama'
        'no_hp',
        'alamat',
        'pekerjaan', // Opsional, jaga-jaga kalau butuh
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relasi ke Siswa (Satu wali bisa punya banyak anak)
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'wali_id');
    }
}