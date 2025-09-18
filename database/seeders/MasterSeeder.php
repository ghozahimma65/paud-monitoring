<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\WaliMurid;
use App\Models\Siswa;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@paud.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);

        // Guru user
        $guruUser = User::create([
            'name' => 'Bu Guru',
            'email' => 'guru@paud.com',
            'password' => bcrypt('123456'),
            'role' => 'guru',
        ]);
        $guru = Guru::create([
            'user_id' => $guruUser->id,
            'bidang' => 'Pengajar TK'
        ]);

        // Wali murid user
        $waliUser = User::create([
            'name' => 'Pak Budi',
            'email' => 'wali@paud.com',
            'password' => bcrypt('123456'),
            'role' => 'wali',
        ]);
        $wali = WaliMurid::create([
            'user_id' => $waliUser->id,
            'alamat' => 'Jl. Mawar No. 10',
            'lokasi_lat' => -8.1723,
            'lokasi_lng' => 113.6995,
        ]);

        // Kelas
        $kelas = Kelas::create([
            'nama_kelas' => 'Kelompok A',
            'umur_group' => '4-5 tahun',
        ]);

        // Siswa
        Siswa::create([
            'nama' => 'Ani',
            'nis' => 'S001',
            'tanggal_lahir' => '2020-01-01',
            'kelas_id' => $kelas->id,
            'wali_id' => $wali->id,
            'foto' => null,
        ]);
    }
}
