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
        Schema::table('penilaian_ceklis', function (Blueprint $table) {
            $table->string('aspek_perkembangan')->nullable()->after('siswa_id'); // Atau diletakkan setelah guru_id/tanggal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian_ceklis', function (Blueprint $table) {
            $table->dropColumn('aspek_perkembangan');
        });
    }
};
