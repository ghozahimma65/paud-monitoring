<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjemputans', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel siswa
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            
            $table->string('nama_penjemput')->nullable(); 
            $table->string('status_hubungan')->nullable(); 
            $table->string('foto_bukti')->nullable(); // Kita buat boleh kosong (nullable)
            $table->timestamp('waktu_jemput')->useCurrent();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjemputans');
    }
};