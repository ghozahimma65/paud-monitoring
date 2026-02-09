<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    use HasFactory;

    // Nama tabel di database kamu (Sesuai screenshot)
    protected $table = 'wali_murids';

    // ✅ JURUS OPEN GATE: Izinkan semua data masuk (Alamat, Pekerjaan, dll)
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'wali_id');
    }
}