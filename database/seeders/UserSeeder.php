<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Superadmin
        User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Tahun2011'),
                'role' => 'superadmin',
                'nip' => '123456789'
            ]
        );

        // Waka Kurikulum
        User::updateOrCreate(
            ['email' => 'wakakurikulum@example.com'],
            [
                'name' => 'Waka Kurikulum',
                'password' => Hash::make('password123'),
                'role' => 'waka_kurikulum',
                'nip' => '234567890'
            ]
        );

        // Guru Mapel
        User::updateOrCreate(
            ['email' => 'gurumapel@example.com'],
            [
                'name' => 'Guru Mapel',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
                'nip' => '345678901'
            ]
        );

        // Wali Kelas
        User::updateOrCreate(
            ['email' => 'walikelas@example.com'],
            [
                'name' => 'Wali Kelas',
                'password' => Hash::make('password123'),
                'role' => 'walikelas',
                'nip' => '456789012'
            ]
        );
    }
}
