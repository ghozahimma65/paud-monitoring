<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\WaliMurid;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@paud.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );

        // Guru
        $guruUser = User::updateOrCreate(
            ['email' => 'guru@paud.com'],
            [
                'name' => 'Bu Guru',
                'password' => Hash::make('123456'),
                'role' => 'guru',
            ]
        );
        Guru::updateOrCreate(
            ['user_id' => $guruUser->id],
            ['bidang' => 'Pengajar TK']
        );

        // Wali
        $waliUser = User::updateOrCreate(
            ['email' => 'wali@paud.com'],
            [
                'name' => 'Pak Budi',
                'password' => Hash::make('123456'),
                'role' => 'wali',
            ]
        );
        $wali = WaliMurid::updateOrCreate(
            ['user_id' => $waliUser->id],
            [
                'alamat' => 'Jl. Mawar No. 10',
                'lokasi_lat' => -8.1723,
                'lokasi_lng' => 113.6995,
            ]
        );

        // Kelas
        $kelas = Kelas::updateOrCreate(
            ['nama_kelas' => 'Kelompok A'],
            ['umur_group' => '4-5 tahun']
        );

        // Siswa
        Siswa::updateOrCreate(
            ['nis' => 'S001'],
            [
                'nama' => 'Ani',
                'tanggal_lahir' => '2020-01-01',
                'kelas_id' => $kelas->id,
                'wali_id' => $wali->id,
                'foto' => null,
            ]
        );
    }
}
