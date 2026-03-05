<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianCeklis extends Model
{
    use HasFactory;

    // Arahkan ke nama tabel yang benar
    protected $table = 'penilaian_ceklis';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'aspek_perkembangan', // Kolom aspek_perkembangan
        'indikator', // Sekarang sudah jadi teks
        'tanggal',
        'hasil',     // Ingat, di database kamu namanya 'hasil'
        'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}