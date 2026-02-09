<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rapots', function (Blueprint $table) {
            
            // 1. Cek Kolom A (Agama). Kalau belum ada, kita buat.
            // Kita hapus 'after' supaya aman dan tidak error.
            if (!Schema::hasColumn('rapots', 'narasi_agama')) {
                $table->text('narasi_agama')->nullable();
            }

            // 2. Cek Kolom B (Budi Pekerti). Kalau belum ada, buat.
            if (!Schema::hasColumn('rapots', 'narasi_budi_pekerti')) {
                $table->text('narasi_budi_pekerti')->nullable();
            }

            // 3. Cek Kolom E (Kokurikuler) sekalian.
            if (!Schema::hasColumn('rapots', 'narasi_kokurikuler')) {
                $table->text('narasi_kokurikuler')->nullable();
            }

            // 4. Pastikan kolom C & D juga aman
            if (!Schema::hasColumn('rapots', 'narasi_jati_diri')) {
                $table->text('narasi_jati_diri')->nullable();
            }
            if (!Schema::hasColumn('rapots', 'narasi_literasi')) {
                $table->text('narasi_literasi')->nullable();
            }
        });
    }

    public function down()
    {
        // Kosongkan saja agar aman saat rollback
    }
};