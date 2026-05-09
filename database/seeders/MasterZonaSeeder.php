<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\MasterZona::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $kotaMadiun = [
            'Kartoharjo', 'Manguharjo', 'Taman'
        ];

        $kabupatenMadiun = [
            'Balerejo', 'Dagangan', 'Dolopo', 'Geger', 'Gemarang', 'Jiwan', 'Kare', 'Kebonsari', 'Madiun', 'Mejayan', 'Pilangkenceng', 'Saradan', 'Sawahan', 'Wonoasri', 'Wungu'
        ];

        foreach ($kotaMadiun as $zona) {
            \App\Models\MasterZona::create(['nama_zona' => $zona, 'kategori' => 'Kota Madiun']);
        }

        foreach ($kabupatenMadiun as $zona) {
            \App\Models\MasterZona::create(['nama_zona' => $zona, 'kategori' => 'Kabupaten Madiun']);
        }
    }
}
