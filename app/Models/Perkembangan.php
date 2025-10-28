<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perkembangan extends Model
{
    protected $fillable = [
        'siswa_id', 'guru_id', 'tanggal', 'aspek', 'deskripsi', 'foto'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
