<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Guru Kelas
            ['nama_guru' => 'Ibu. Junita Dhanesti, S.Pd', 'jenis_guru' => 'guru_kelas'],
            ['nama_guru' => 'Ibu. Afif Wais Al Qorni, S.Pd.', 'jenis_guru' => 'guru_kelas'],
            ['nama_guru' => 'Ibu. Anisa Nur Pratama, S.Psi', 'jenis_guru' => 'guru_kelas'],
            
            // Guru Shadow ABK
            ['nama_guru' => 'Ibu. Ellyse Clara Nargata', 'jenis_guru' => 'shadow_abk'],
            ['nama_guru' => 'Ibu. Efa Nur Azizah', 'jenis_guru' => 'shadow_abk'],
            ['nama_guru' => 'Ibu. Istik Sundari, S.Pd.', 'jenis_guru' => 'shadow_abk'],
        ];

        foreach ($data as $d) {
            DB::table('guru')->insert([
                'nama_guru'  => $d['nama_guru'],
                'jenis_guru' => $d['jenis_guru'],
                'email'      => null,
                'no_hp'      => '-',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}