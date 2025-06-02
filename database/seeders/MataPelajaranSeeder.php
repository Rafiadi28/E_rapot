<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run()
    {
        // Contoh data mata pelajaran
        MataPelajaran::create([
            'nama_mapel' => 'Matematika',
            'kode_mapel' => 'MTK',
            'kelompok' => 'A'
        ]);

        MataPelajaran::create([
            'nama_mapel' => 'Bahasa Indonesia',
            'kode_mapel' => 'BIN',
            'kelompok' => 'A'
        ]);

        MataPelajaran::create([
            'nama_mapel' => 'Bahasa Inggris',
            'kode_mapel' => 'BIG',
            'kelompok' => 'A'
        ]);
    }
}