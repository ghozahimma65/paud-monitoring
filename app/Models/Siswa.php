<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas'; // Nama tabel di database

    protected $fillable = [
        'wali_id',        // Kunci Relasi ke Wali Murid
        'nama_siswa',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',  // L atau P
        'tanggal_masuk',  // Opsional
    ];

    /**
     * Relasi: Setiap Siswa PASTI punya satu Wali Murid
     */
    public function wali()
    {
        return $this->belongsTo(WaliMurid::class, 'wali_id');
    }
}