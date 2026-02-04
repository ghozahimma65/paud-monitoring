<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WaliMuridSeeder extends Seeder
{
    public function run()
    {
        $walis = [
            ['nama' => 'Tomi Puspita Aji', 'alamat' => 'Jl. Ciliwung No. 22 RT 47 RW 15 Taman'],
            ['nama' => 'Yonna Setyawan', 'alamat' => 'Jl. Jambu Kembar 1 No. 1 CRT 20 RW 07 Taman Kota Madiun'],
            ['nama' => 'Taufiq Rahman Luis', 'alamat' => 'Griya Kencana Wungu Blok C No. 12'], // Asumsi dari data sebelumnya
            ['nama' => 'Andika Bayu', 'alamat' => 'Jl. Pilang Mudya 3 / 8'],
            ['nama' => 'Masita Sari', 'alamat' => 'Dsn. Butan Rt 035 Rw 005 Ds. Krandegan Kec. Kebonsari'],
            ['nama' => 'Ayu Trisnawati', 'alamat' => 'Rt 018 Rw 004 Jl. Remora Mas Blok O No. 7 Perum Telaga Mas'],
            ['nama' => 'Alliemsa Anggi Putra', 'alamat' => 'Jl. Panglima Sudirman No. 75 RT 37 RW 12 Taman Kota Madiun'],
            ['nama' => 'Renny Wulandari', 'alamat' => 'Rt 033 Rw 001 Jl. Khairil Anwar Gang Palm 1/284 Ds. Badean'],
            ['nama' => 'Anggieta', 'alamat' => 'Dusun II Ds. Sukolilo Kec Jiwan Kab Madiun'],
            ['nama' => 'Miftakhul Jannah', 'alamat' => 'Jl. Sasono Mulyo No. 18 Sogaten'],
            ['nama' => 'Ika Septina', 'alamat' => 'Jl. Pasopati No. 18 Josenan'],
        ];

        foreach ($walis as $w) {
            DB::table('wali_murids')->insert([
                'nama_wali'  => $w['nama'],
                'alamat'     => $w['alamat'],
                'no_hp'      => '-',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}