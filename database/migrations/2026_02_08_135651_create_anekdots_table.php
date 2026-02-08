<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
     {
         Schema::create('anekdots', function (Blueprint $table) {
             $table->id();
             $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade'); // Relasi ke Siswa
             $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');   // Relasi ke Guru
             $table->date('tanggal');
             $table->text('kejadian_teramati');
             $table->text('analisis_capaian')->nullable();
             $table->string('foto')->nullable(); // Path foto
             $table->timestamps();
         });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anekdots');
    }
    
    
};
