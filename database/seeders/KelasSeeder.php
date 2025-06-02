<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run()
    {
        // Dapatkan ID user dengan role walikelas
        $walikelas = User::where('role', 'walikelas')->first();

        // Contoh data kelas
        Kelas::create([
            'nama_kelas' => 'X-1',
            'tingkat' => 'X',
            'jurusan' => 'MPLB',
            'walikelas_id' => $walikelas->id  // Gunakan ID wali kelas yang valid
        ]);

        Kelas::create([
            'nama_kelas' => 'X-2',
            'tingkat' => 'X',
            'jurusan' => 'MPLB',
            'walikelas_id' => $walikelas->id
        ]);
    }
}