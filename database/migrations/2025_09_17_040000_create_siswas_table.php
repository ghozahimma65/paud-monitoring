<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wali_id')->constrained('wali_murids')->onDelete('cascade');
            
            $table->string('nama_siswa'); // Sesuai PDF "Nama Anak"
            $table->string('tempat_lahir'); // Sesuai PDF "Tempat"
            $table->date('tanggal_lahir');  // Sesuai PDF "Tgl Lahir"
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_masuk')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};