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
         Schema::table('anekdots', function (Blueprint $table) {
             if (!Schema::hasColumn('anekdots', 'tanggal')) $table->date('tanggal')->nullable()->after('siswa_id');
             if (!Schema::hasColumn('anekdots', 'waktu')) $table->string('waktu')->nullable()->after('tanggal');
             if (!Schema::hasColumn('anekdots', 'tempat')) $table->string('tempat')->nullable()->after('waktu');
             if (!Schema::hasColumn('anekdots', 'uraian_kejadian')) $table->text('uraian_kejadian')->nullable()->after('tempat');
             if (!Schema::hasColumn('anekdots', 'analisis_capaian')) $table->text('analisis_capaian')->nullable()->after('uraian_kejadian');
         });
     }
     
     public function down(): void
     {
         Schema::table('anekdots', function (Blueprint $table) {
             $table->dropColumn(['tanggal', 'waktu', 'tempat', 'uraian_kejadian', 'analisis_capaian']);
         });
     }
};
