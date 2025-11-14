<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    use HasFactory;

    protected $table = 'wali_murids';

    protected $fillable = [
        'nama_wali',
        'no_hp',
        'email',
        'alamat',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}