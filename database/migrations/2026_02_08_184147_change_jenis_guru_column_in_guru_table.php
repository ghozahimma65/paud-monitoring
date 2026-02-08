<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('guru', function (Blueprint $table) {
            // FUNGSI INI BUTUH DOCTRINE/DBAL (YANG BARUSAN KAMU INSTALL)
            // Mengubah kolom jenis_guru jadi VARCHAR(50) biar muat tulisan panjang
            $table->string('jenis_guru', 50)->change(); 
        });
    }

    public function down()
    {
        Schema::table('guru', function (Blueprint $table) {
            // (Opsional) Kembalikan ke pendek kalau di-rollback
            $table->string('jenis_guru', 20)->change(); 
        });
    }
};