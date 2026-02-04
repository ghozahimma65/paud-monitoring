<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->string('nama_guru'); 
            $table->enum('jenis_guru', ['guru_kelas', 'shadow_abk']); 
            $table->string('nip')->nullable();
            $table->string('no_hp')->nullable(); 
            $table->string('email')->nullable(); // Wajib ada biar ga error seeder
            $table->text('alamat')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guru');
    }
};