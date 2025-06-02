<?php

namespace Database\Seeders;

use App\Models\GuruMataPelajaran;
use Illuminate\Database\Seeder;

class GuruMataPelajaranSeeder extends Seeder
{
    public function run()
    {
        // Assuming guru_mapel user has ID 3 and a mata pelajaran exists with ID 1
        GuruMataPelajaran::create([
            'guru_id' => 3, // ID from UserSeeder for guru_mapel
            'mata_pelajaran_id' => 1
        ]);
    }
}