<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    
    protected $fillable = [
        'nama_mapel', 'kode_mapel', 'kelompok'
    ];

    // Relasi ke guru
    public function guru()
    {
        return $this->belongsToMany(User::class, 'guru_mata_pelajaran', 'mata_pelajaran_id', 'guru_id');
    }

    // Relasi ke kelas
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mata_pelajaran');
    }

    // Relasi ke nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}