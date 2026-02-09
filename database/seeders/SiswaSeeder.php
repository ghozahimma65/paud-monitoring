<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        // Data diambil dari CSV yang kamu kirim (Sample 5 Siswa dulu biar cepat)
        $siswas = [
            [
                'nama_siswa' => 'Abdila Kaivan Baihaqi Alzafa', // SUDAH DIPERBAIKI (nama -> nama_siswa)
                'nis' => '2024247',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2018-03-10',
                'alamat' => 'Cempaka Munggut RT. 5 RW. 2 Kec. Wungu',
                'kelompok_id' => 1
            ],
            [
                'nama_siswa' => 'Hanifah Syafi\'a',
                'nis' => '2024268',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2019-05-12',
                'alamat' => 'Madiun',
                'kelompok_id' => 1
            ],
            [
                'nama_siswa' => 'Abrizam Rafka Danindra',
                'nis' => '2024271',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2019-07-15',
                'alamat' => 'Perum Gajahmada Regency Blok A 10 Kota Madiun',
                'kelompok_id' => 1
            ],
            [
                'nama_siswa' => 'Achazia Nakhi Shankara',
                'nis' => '222285',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2021-03-30',
                'alamat' => 'Jl. Ciliwung No. 22 Kota Madiun',
                'kelompok_id' => 1
            ],
            [
                'nama_siswa' => 'Ahmad Farzan Wisanggeni',
                'nis' => '2023233',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2019-01-10',
                'alamat' => 'Plumpung Lor RT. 8 Rw. 1 Wonoasri Kab. Madiun',
                'kelompok_id' => 1
            ],
        ];

        DB::table('siswas')->insert($siswas);
    }
}