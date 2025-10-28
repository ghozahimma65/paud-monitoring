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
    Schema::create('perkembangans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('siswa_id');
        $table->unsignedBigInteger('guru_id');
        $table->date('tanggal');
        $table->string('aspek'); // contoh: Motorik, Bahasa, Sosial
        $table->text('deskripsi');
        $table->string('foto')->nullable();
        $table->timestamps();

        $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkembangans');
    }
};
