<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndikatorSeeder extends Seeder
{
    public function run()
    {
        $indikators = [
            ['nama_indikator' => 'Anak disiplin mengikuti upacara'],
            ['nama_indikator' => 'Anak dapat menyebutkan 3 benda ciptaan Allah dan buatan manusia'],
            ['nama_indikator' => 'Anak dapat menirukan surat Al-Ikhlas'],
            ['nama_indikator' => 'Anak dapat mengenal simbol Pemuda Muhammadiyah'],
            ['nama_indikator' => 'Anak dapat mengikuti Gerakan senam irama'],
            ['nama_indikator' => 'Anak memiliki kemampuan motorik halus menyusun dan menggunting'],
            ['nama_indikator' => 'Anak mampu memecahkan masalah sederhana saat bermain'],
            ['nama_indikator' => 'Anak memiliki sikap tanggung jawab'],
            ['nama_indikator' => 'Anak dapat mengetahui cara merawat lingkungan sekitar'],
        ];

        DB::table('indikators')->insert($indikators);
    }
}