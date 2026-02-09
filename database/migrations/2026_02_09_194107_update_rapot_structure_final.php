<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rapots', function (Blueprint $table) {
            // Kita tambahkan kolom jika belum ada
            if (!Schema::hasColumn('rapots', 'narasi_budi_pekerti')) {
                $table->text('narasi_budi_pekerti')->nullable()->after('narasi_agama');
            }
            if (!Schema::hasColumn('rapots', 'narasi_kokurikuler')) {
                $table->text('narasi_kokurikuler')->nullable()->after('narasi_literasi');
            }
            if (!Schema::hasColumn('rapots', 'refleksi_orang_tua')) {
                $table->text('refleksi_orang_tua')->nullable();
            }
            // Data Tanda Tangan
            if (!Schema::hasColumn('rapots', 'nama_guru')) {
                $table->string('nama_guru')->nullable();
            }
            if (!Schema::hasColumn('rapots', 'nipy_guru')) {
                $table->string('nipy_guru')->nullable();
            }
            if (!Schema::hasColumn('rapots', 'nama_kepala_sekolah')) {
                $table->string('nama_kepala_sekolah')->nullable();
            }
            if (!Schema::hasColumn('rapots', 'nipy_kepala_sekolah')) {
                $table->string('nipy_kepala_sekolah')->nullable();
            }
        });
    }

    public function down()
    {
        // Tidak perlu drop column agar data aman
    }
};