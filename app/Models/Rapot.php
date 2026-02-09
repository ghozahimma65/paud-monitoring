<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id', 'tahun_ajaran', 'semester', 'tanggal_rapot',
        
        // NARASI A-E (Sesuai PDF)
        'narasi_agama',         // A. AIK
        'narasi_budi_pekerti',  // B. Budi Pekerti
        'narasi_jati_diri',     // C. Jati Diri
        'narasi_literasi',      // D. Literasi
        'narasi_kokurikuler',   // E. Kokurikuler (Panjang)

        // REFLEKSI & TTD
        'refleksi_orang_tua',
        'nama_guru', 'nipy_guru',
        'nama_kepala_sekolah', 'nipy_kepala_sekolah',

        // FISIK & KEHADIRAN
        'tinggi_badan', 'berat_badan', 'lingkar_kepala',
        'sakit', 'izin', 'alpha',
        
        // SISA (Biarkan p5 ada jika nanti butuh)
        'p5_tema', 'p5_judul', 'p5_narasi'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}