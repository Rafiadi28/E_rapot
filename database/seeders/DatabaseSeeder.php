<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            KelasSeeder::class,           // Tambahkan ini sebelum MataPelajaranSeeder
            MataPelajaranSeeder::class,
            GuruMataPelajaranSeeder::class,
            KelasMataPelajaranSeeder::class
        ]);
    }
}


