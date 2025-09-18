<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'tanggal_lahir',
        'kelas_id',
        'wali_id',
        'foto',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function wali()
    {
        return $this->belongsTo(WaliMurid::class, 'wali_id');
    }
}