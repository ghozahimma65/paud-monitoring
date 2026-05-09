<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterZona extends Model
{
    protected $table = 'master_zonas';
    protected $fillable = ['nama_zona', 'kategori'];
}
