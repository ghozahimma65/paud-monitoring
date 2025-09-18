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
    Schema::create('siswas', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('nis')->unique();
    $table->date('tanggal_lahir');
    $table->unsignedBigInteger('kelas_id');
    $table->unsignedBigInteger('wali_id');
    $table->string('foto')->nullable();
    $table->timestamps();

    $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
    $table->foreign('wali_id')->references('id')->on('wali_murids')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
