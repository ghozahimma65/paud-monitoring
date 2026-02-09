<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rapots', function (Blueprint $table) {
            
            // 1. Cek Kolom Refleksi
            if (!Schema::hasColumn('rapots', 'refleksi_orang_tua')) {
                $table->text('refleksi_orang_tua')->nullable();
            }

            // 2. Cek Kolom Nama Guru
            if (!Schema::hasColumn('rapots', 'nama_guru')) {
                $table->string('nama_guru')->nullable();
            }

            // 3. Cek Kolom NIPY Guru
            if (!Schema::hasColumn('rapots', 'nipy_guru')) {
                $table->string('nipy_guru')->nullable();
            }

            // 4. Cek Kolom Kepala Sekolah
            if (!Schema::hasColumn('rapots', 'nama_kepala_sekolah')) {
                $table->string('nama_kepala_sekolah')->nullable();
            }

            // 5. Cek Kolom NIPY Kepala Sekolah
            if (!Schema::hasColumn('rapots', 'nipy_kepala_sekolah')) {
                $table->string('nipy_kepala_sekolah')->nullable();
            }
            
            // 6. Pastikan Tanggal Rapot tipe Date (ubah kalau perlu)
            if (Schema::hasColumn('rapots', 'tanggal_rapot')) {
                $table->date('tanggal_rapot')->nullable()->change();
            }
        });
    }

    public function down()
    {
        // Kosongkan agar aman saat rollback
    }
};