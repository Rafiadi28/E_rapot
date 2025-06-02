<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    
    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan',
        'walikelas_id'
    ];

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'walikelas_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsToMany(MataPelajaran::class, 'kelas_mata_pelajaran');
    }

    // Tambahkan accessor jika diperlukan
    public function getNamaKelasAttribute()
    {
        return $this->attributes['nama_kelas'];
    }
}