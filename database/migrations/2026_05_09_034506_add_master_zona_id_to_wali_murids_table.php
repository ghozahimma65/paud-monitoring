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
        Schema::table('wali_murids', function (Blueprint $table) {
            $table->foreignId('master_zona_id')->nullable()->constrained('master_zonas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wali_murids', function (Blueprint $table) {
            $table->dropForeign(['master_zona_id']);
            $table->dropColumn('master_zona_id');
        });
    }
};
