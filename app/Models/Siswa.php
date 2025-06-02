<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Siswa extends Model
{
    protected $table = 'siswa';
    
    protected $fillable = [
        'nis', 'nisn', 'nama_lengkap', 'kelas_id', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat',
        'nama_ayah', 'nama_ibu'
    ];

    protected $dates = ['tanggal_lahir'];

    // Relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi ke nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class);
    }
}
