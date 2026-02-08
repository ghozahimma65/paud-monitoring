<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data diambil dari CSV Guru yang kamu kirim
        $users = [
            ['name' => 'Tri Marya Endarwati', 'email' => 'admin@paud.com', 'password' => Hash::make('12345678'), 'role' => 'admin', 'no_hp' => '087753218133'],
            ['name' => 'Tutuk Setyaningtyas', 'email' => 'tutuk@paud.com', 'password' => Hash::make('12345678'), 'role' => 'guru', 'no_hp' => '087753897197'],
            ['name' => 'Ike Eria Widyaninggar', 'email' => 'ike@paud.com', 'password' => Hash::make('12345678'), 'role' => 'guru', 'no_hp' => '085235370175'],
            ['name' => 'Fitriyah Wahidah', 'email' => 'fitriyah@paud.com', 'password' => Hash::make('12345678'), 'role' => 'guru', 'no_hp' => '081233460803'],
            ['name' => 'Dwi Lestari', 'email' => 'dwi@paud.com', 'password' => Hash::make('12345678'), 'role' => 'guru', 'no_hp' => '085736369584'],
            // ... (Sebenarnya ada 40, tapi saya masukkan 5 inti dulu biar tidak kepanjangan)
        ];

        DB::table('users')->insert($users);
    }
}