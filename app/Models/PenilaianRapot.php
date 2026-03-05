<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianRapot extends Model
{
    protected $table = 'penilaian_rapots';

    protected $fillable = [
        'siswa_id',
        'semester',
        'tahun_ajaran',
        'catatan_guru',
        'nama_guru',
        'nilai_aspek',
        'nilai_aik',
        'nilai_budi_pekerti',
        'nilai_jati_diri',
        'nilai_literasi_steam',
        'nilai_kokurikuler',
        'tinggi_badan',
        'berat_badan',
        'lingkar_kepala',
        'sakit',
        'izin',
        'alpha',
        'file_pdf',
    ];

    protected $casts = [
        'nilai_aspek' => 'array',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
