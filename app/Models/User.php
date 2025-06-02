<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Tambahkan konstanta untuk role yang valid
    const ROLE_SUPERADMIN = 'superadmin';
    const ROLE_WAKA_KURIKULUM = 'waka_kurikulum';
    const ROLE_GURU_MAPEL = 'guru_mapel';
    const ROLE_WALIKELAS = 'walikelas';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nip'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tambahkan property untuk daftar role yang valid
    protected $validRoles = [
        self::ROLE_SUPERADMIN,
        self::ROLE_WAKA_KURIKULUM,
        self::ROLE_GURU_MAPEL,
        self::ROLE_WALIKELAS
    ];

    public function isSuperadmin()
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    public function isWakaKurikulum()
    {
        return $this->role === self::ROLE_WAKA_KURIKULUM;
    }

    public function isGuruMapel()
    {
        return $this->role === self::ROLE_GURU_MAPEL;
    }

    public function isWalikelas()
    {
        return $this->role === self::ROLE_WALIKELAS;
    }

    // Tambahkan method untuk validasi role
    public function hasValidRole()
    {
        return in_array($this->role, $this->validRoles);
    }

    public function mataPelajaran()
    {
        return $this->belongsToMany(MataPelajaran::class, 'guru_mata_pelajaran', 'guru_id', 'mata_pelajaran_id');
    }
}
