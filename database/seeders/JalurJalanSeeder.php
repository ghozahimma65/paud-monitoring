<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JalurJalanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan tabel jalur_jalans sebelum diisi
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('jalur_jalans')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Ambil semua data titik yang sudah Ghoza input
        $titik = DB::table('titik_jalans')->get()->keyBy('id');
        $jalur = [];

        // 3. Hubungkan PAUD (ID 1) dengan Simpang A (2) dan Simpang B (3)
        $jalur = array_merge($jalur, $this->buatJalurBolakBalik($titik[1], $titik[2]));
        $jalur = array_merge($jalur, $this->buatJalurBolakBalik($titik[1], $titik[3]));

        // 4. Hubungkan SETIAP RUMAH SISWA (ID 4 sampai 59) ke titik terdekatnya
        for ($i = 4; $i <= 59; $i++) {
            if(!isset($titik[$i])) continue; // Lewati kalau ID tidak ada

            $rumah = $titik[$i];

            // Hitung jarak dari rumah ke PAUD & Persimpangan
            $jarakKePaud = $this->hitungJarak($rumah->latitude, $rumah->longitude, $titik[1]->latitude, $titik[1]->longitude);
            $jarakKeSimpangA = $this->hitungJarak($rumah->latitude, $rumah->longitude, $titik[2]->latitude, $titik[2]->longitude);
            $jarakKeSimpangB = $this->hitungJarak($rumah->latitude, $rumah->longitude, $titik[3]->latitude, $titik[3]->longitude);

            // Cari mana yang paling dekat
            $terdekat = 1;
            $jarakMin = $jarakKePaud;

            if ($jarakKeSimpangA < $jarakMin) {
                $terdekat = 2;
                $jarakMin = $jarakKeSimpangA;
            }
            if ($jarakKeSimpangB < $jarakMin) {
                $terdekat = 3;
                $jarakMin = $jarakKeSimpangB;
            }

            // Buat jembatan bolak-balik dari rumah ke titik terdekat tersebut
            $jalur = array_merge($jalur, $this->buatJalurBolakBalik($rumah, $titik[$terdekat]));
        }

        // 5. Simpan semua data jembatannya ke Database!
        DB::table('jalur_jalans')->insert($jalur);
        
        $totalJalur = count($jalur);
        $this->command->info("WOW! Berhasil membuat {$totalJalur} jembatan rute secara otomatis pakai Haversine Formula!");
    }

    // --- RUMUS BANTUAN ---

    // Fungsi bikin jalur 2 arah (Pergi - Pulang)
    private function buatJalurBolakBalik($titikA, $titikB) {
        $jarak = $this->hitungJarak($titikA->latitude, $titikA->longitude, $titikB->latitude, $titikB->longitude);
        return [
            ['titik_awal_id' => $titikA->id, 'titik_tujuan_id' => $titikB->id, 'jarak' => $jarak],
            ['titik_awal_id' => $titikB->id, 'titik_tujuan_id' => $titikA->id, 'jarak' => $jarak],
        ];
    }

    // Rumus Haversine: Mengubah Latitude & Longitude menjadi jarak Meter aslinya
    private function hitungJarak($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371000; // Radius bumi dalam meter
        $latFrom = deg2rad((float)$lat1);
        $lonFrom = deg2rad((float)$lon1);
        $latTo = deg2rad((float)$lat2);
        $lonTo = deg2rad((float)$lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        
        return round($angle * $earthRadius); // Dibulatkan
    }
}