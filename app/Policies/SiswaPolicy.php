<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Siswa;

class SiswaPolicy
{
    public function view(User $user, Siswa $siswa)
    {
        return $user->role === 'walikelas' && 
               $siswa->kelas->walikelas_id === $user->id;
    }
}