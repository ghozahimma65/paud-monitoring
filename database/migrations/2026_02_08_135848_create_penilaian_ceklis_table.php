<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kita gunakan nama tabel sesuai file kamu: 'penilaian_ceklis'
        Schema::create('penilaian_ceklis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            
            // UBAH INI: Dari ID jadi Text supaya bisa copy-paste dari Word
            $table->text('indikator'); 
            
            $table->date('tanggal');
            
            // Sesuai screenshot kamu, namanya 'hasil' bukan 'skala'
            $table->enum('hasil', ['BSB', 'BSH', 'MB', 'BB']); 
            
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_ceklis');
    }
};