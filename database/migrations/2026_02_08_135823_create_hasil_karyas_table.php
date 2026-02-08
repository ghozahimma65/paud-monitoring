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
         Schema::create('hasil_karyas', function (Blueprint $table) {
             $table->id();
             $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
             $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
             $table->date('tanggal');
             $table->string('foto');
             $table->text('deskripsi_foto')->nullable();
             $table->text('analisis_capaian')->nullable();
             $table->timestamps();
         });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_karyas');
    }
};
