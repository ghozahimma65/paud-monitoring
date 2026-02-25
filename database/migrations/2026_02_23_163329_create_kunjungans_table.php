<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade'); // Relasi ke Guru (User)
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade'); // Relasi ke Siswa
            $table->date('tanggal_visit');
            $table->string('status')->default('menunggu'); // Status: menunggu, jalan, selesai
            
            // --- Kolom untuk Penilaian (Dibuat fleksibel) ---
            $table->string('materi_belajar')->nullable();
            $table->string('nilai')->nullable(); // String, biar bisa diisi "BB", "BSB", atau angka 80
            $table->text('catatan')->nullable();
            $table->string('foto_kegiatan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kunjungans');
    }
};