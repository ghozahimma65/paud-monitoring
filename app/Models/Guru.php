<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru'; // Sesuai DB kamu

    protected $fillable = [
        'nama_guru',  // SEBELUMNYA 'nama' (SALAH), HARUS 'nama_guru'
        'jenis_guru', // SEBELUMNYA 'jenis_guru' (SUDAH BENAR TAPI INPUT FORM SALAH)
        'no_hp',
        'email',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}