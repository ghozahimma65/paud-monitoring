<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'keterangan',
        'kelas_id',
        'wali_id',
        'foto',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function waliMurid()
    {
        return $this->belongsTo(WaliMurid::class, 'wali_id');
    }
}