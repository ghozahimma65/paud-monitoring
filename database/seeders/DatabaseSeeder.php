<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin (Supaya kamu bisa Login)
        // Kita buat manual di sini biar tidak error pakai seeder lama
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Password default
            'role' => 'admin',
        ]);

        // 2. Jalankan Seeder Data Sekolah (Sesuai PDF)
        $this->call([
            GuruSeeder::class,      // Data Guru (Fixed)
            WaliMuridSeeder::class, // Data Wali (Fixed)
            SiswaSeeder::class,     // Data Siswa (Fixed)
        ]);
        
        // CATATAN: Jangan panggil MasterSeeder lagi karena kodenya usang.
    }
}