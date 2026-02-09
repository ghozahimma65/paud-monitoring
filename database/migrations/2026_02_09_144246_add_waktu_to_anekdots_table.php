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
             // Tambahkan kolom waktu setelah kolom tanggal
             $table->string('waktu')->after('tanggal')->nullable();
         });
     }
     
     public function down(): void
     {
         Schema::table('anekdots', function (Blueprint $table) {
             $table->dropColumn('waktu');
         });
     }
};
