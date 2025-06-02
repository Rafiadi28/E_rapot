<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KelasMataPelajaran;

class KelasMataPelajaranSeeder extends Seeder
{
    public function run()
    {
        // Contoh relasi kelas dengan mata pelajaran
        // Asumsikan kelas dengan ID 1 dan mata pelajaran dengan ID 1
        KelasMataPelajaran::create([
            'kelas_id' => 1,
            'mata_pelajaran_id' => 1
        ]);
    }
}