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
         Schema::create('indikators', function (Blueprint $table) {
             $table->id();
             $table->string('kelompok_usia')->default('4-5 Tahun'); 
             $table->text('nama_indikator'); // Contoh: "Anak dapat menirukan surat Al-Ikhlas"
             $table->timestamps();
         });
     }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikators');
    }
};
