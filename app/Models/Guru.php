<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    // kasih tahu Laravel kalau nama tabelnya "guru", bukan "gurus"
    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'jenis_guru',
        'no_hp',
        'email',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}