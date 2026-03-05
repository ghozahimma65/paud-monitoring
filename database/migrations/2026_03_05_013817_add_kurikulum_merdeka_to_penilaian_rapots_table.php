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
        Schema::table('penilaian_rapots', function (Blueprint $table) {
            $table->text('nilai_aik')->nullable();
            $table->text('nilai_budi_pekerti')->nullable();
            $table->text('nilai_jati_diri')->nullable();
            $table->text('nilai_literasi_steam')->nullable();
            $table->text('nilai_kokurikuler')->nullable();
            
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->integer('lingkar_kepala')->nullable();
            
            $table->integer('sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('alpha')->nullable();
            
            $table->string('file_pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian_rapots', function (Blueprint $table) {
            $table->dropColumn([
                'nilai_aik', 'nilai_budi_pekerti', 'nilai_jati_diri', 
                'nilai_literasi_steam', 'nilai_kokurikuler',
                'tinggi_badan', 'berat_badan', 'lingkar_kepala',
                'sakit', 'izin', 'alpha', 'file_pdf'
            ]);
        });
    }
};
