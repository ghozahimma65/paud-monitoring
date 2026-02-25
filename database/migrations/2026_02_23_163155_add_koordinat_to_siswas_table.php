<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Menambahkan kolom untuk titik koordinat GPS
            $table->string('latitude')->nullable()->after('alamat'); 
            $table->string('longitude')->nullable()->after('latitude');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};