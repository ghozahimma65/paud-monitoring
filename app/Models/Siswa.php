<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi ke Wali Murid
    public function wali_murid()
    {
        return $this->belongsTo(WaliMurid::class, 'wali_murid_id');
    }

    // TAMBAHKAN INI: Relasi ke Kelompok/Kelas
    public function kelompok()
    {
        // 2. Hubungkan ke Model 'Kelas'
        // 3. Pakai kunci 'kelas_id' (sesuai yang ada di file Kelas.php kamu)
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    
    public function anekdots()
    {
        return $this->hasMany(Anekdot::class, 'siswa_id');
    }
    
    public function hasilKaryas()
    {
        return $this->hasMany(HasilKarya::class, 'siswa_id');
    }
    
    public function penilaianCeklis()
    {
        return $this->hasMany(PenilaianCeklis::class, 'siswa_id');
    }
}