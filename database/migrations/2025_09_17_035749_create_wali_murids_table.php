<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wali_murids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->string('nama_wali'); // Sesuai PDF "Nama Orang Tua"
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable(); // Sesuai PDF "Alamat"
            $table->string('pekerjaan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wali_murids');
    }
};