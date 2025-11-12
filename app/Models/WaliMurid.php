<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    use HasFactory;

    protected $table = 'wali_murids';

    protected $fillable = [
        'nama_wali',
        'email',
        'no_hp',
        'alamat',
    ];

    // Tambahin relasi ke siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'wali_id');
    }
}