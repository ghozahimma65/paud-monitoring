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
        // Cek tabel anekdots
        if (Schema::hasTable('anekdots')) {
            if (!Schema::hasColumn('anekdots', 'foto')) {
                Schema::table('anekdots', function (Blueprint $table) {
                    $table->string('foto')->nullable();
                });
            }
        }

        // Cek tabel hasil_karyas
        if (Schema::hasTable('hasil_karyas')) {
            if (!Schema::hasColumn('hasil_karyas', 'foto')) {
                Schema::table('hasil_karyas', function (Blueprint $table) {
                    $table->string('foto')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anekdots', function (Blueprint $table) {
            if (Schema::hasColumn('anekdots', 'foto')) {
                $table->dropColumn('foto');
            }
        });

        Schema::table('hasil_karyas', function (Blueprint $table) {
            if (Schema::hasColumn('hasil_karyas', 'foto')) {
                $table->dropColumn('foto');
            }
        });
    }
};