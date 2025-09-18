<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    protected $table = 'wali_murids';
    protected $fillable = ['user_id','alamat','lokasi_lat','lokasi_lng'];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class,'wali_id');
    }
}