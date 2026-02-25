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
        Schema::create('jalur_jalans', function (Blueprint $table) {
            $table->id();
            // Titik awal persimpangan
            $table->foreignId('titik_awal_id')->constrained('titik_jalans')->onDelete('cascade');
            // Titik tujuan persimpangan
            $table->foreignId('titik_tujuan_id')->constrained('titik_jalans')->onDelete('cascade');
            // Jarak asli jalan raya (dalam meter / kilometer) -> Ini jadi G-Cost di A*
            $table->double('jarak'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalur_jalans');
    }
};
