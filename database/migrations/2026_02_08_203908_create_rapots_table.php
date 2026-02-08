<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rapots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            
            // Info Dasar
            $table->string('semester', 50); 
            $table->string('tahun_ajaran', 20);
            $table->date('tanggal_rapot');

            // --- ISI RAPOT SESUAI PDF ---
            
            // A. AIK (Al Islam, Ke'aisyiyahan & Kemuhammadiyahan)
            $table->text('narasi_aik')->nullable(); 

            // B. Nilai Agama & Budi Pekerti
            $table->text('narasi_nilai_agama')->nullable();

            // C. Jati Diri
            $table->text('narasi_jati_diri')->nullable();

            // D. Dasar Literasi, Matematika, Sains, Teknologi, Rekayasa, Seni
            $table->text('narasi_literasi')->nullable();

            // E. Kokurikuler (Pengganti P5)
            $table->text('narasi_kokurikuler')->nullable();

            // --- DATA FISIK ---
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('lingkar_kepala')->nullable();
            $table->string('lingkar_lengan')->nullable();

            // --- KEHADIRAN ---
            $table->integer('sakit')->default(0);
            $table->integer('izin')->default(0);
            $table->integer('alpha')->default(0);

            // --- REFLEKSI ---
            $table->text('refleksi_orang_tua')->nullable();

            // --- TANDA TANGAN ---
            $table->string('nama_guru')->nullable(); // Guru Kelas
            $table->string('nama_kepala_sekolah')->nullable(); // Kepala Sekolah / Pengelola
            $table->string('nbm_kepala_sekolah')->nullable(); // NBM Kepala Sekolah (Opsional)

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapots');
    }
};