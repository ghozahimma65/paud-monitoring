<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\WaliMurid;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        // Format: [Nama Anak, Nama Orang Tua, Tempat Lahir, Tgl Lahir (YYYY-MM-DD), JK]
        $data_siswa = [
            ['Achazia Nakhi Shankara', 'Tomi Puspita Aji', 'Kota Madiun', '2021-03-30', 'L'],
            ['Zayn Risky Putra Setyawan', 'Yonna Setyawan', 'Kota Madiun', '2020-04-07', 'L'],
            ['Zain Mizyal Alkhalifi Luis', 'Taufiq Rahman Luis', 'Kota Madiun', '2022-02-27', 'L'],
            ['Yafiq Hasan Besari', 'Andika Bayu', 'Berau', '2020-02-19', 'L'],
            ['Azia Nurafni Shidqia', 'Masita Sari', 'Madiun', '2019-01-14', 'P'],
            ['Zhafir Reza Arifa Putra', 'Ayu Trisnawati', 'Madiun', '2019-05-05', 'L'],
            ['Alliemsa Azka Ayyub Anggoro', 'Alliemsa Anggi Putra', 'Madiun', '2018-07-20', 'L'],
            ['Samudra Zikru Al Fakih', 'Renny Wulandari', 'Malang', '2018-01-24', 'L'],
            // Data tambahan jika ada di PDF tapi terpotong, disesuaikan dengan data wali yg ada
            ['Arsyad', 'Miftakhul Jannah', 'Madiun', '2020-05-10', 'L'],
            ['Almeera', 'Ika Septina', 'Madiun', '2020-08-15', 'P'],
        ];

        foreach ($data_siswa as $ds) {
            // Cari ID Wali berdasarkan Nama Orang Tua
            $wali = WaliMurid::where('nama_wali', 'LIKE', '%' . $ds[1] . '%')->first();

            if ($wali) {
                Siswa::create([
                    'wali_id'       => $wali->id,
                    'nama_siswa'    => $ds[0],
                    'tempat_lahir'  => $ds[2],
                    'tanggal_lahir' => $ds[3],
                    'jenis_kelamin' => $ds[4],
                ]);
            }
        }
    }
}