<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    
    protected $fillable = [
        'siswa_id',
        'guru_id',
        'mata_pelajaran_id',
        'nilai_formatif',
        'deskripsi_formatif',
        'nilai_sumatif',
        'deskripsi_sumatif',
        'nilai_akhir_semester',
        'deskripsi_akhir_semester',
        'capaian_kompetensi',
        'semester',
        'tahun_ajaran'
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke model User (Guru)
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Relasi ke model MataPelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    // Method untuk menghitung nilai akhir semester
    public function hitungNilaiAkhir()
    {
        // Bobot penilaian sesuai Kurikulum Merdeka
        $bobotFormatif = 0.4; // 40%
        $bobotSumatif = 0.6;  // 60%

        if ($this->nilai_formatif !== null && $this->nilai_sumatif !== null) {
            $nilaiAkhir = ($this->nilai_formatif * $bobotFormatif) + ($this->nilai_sumatif * $bobotSumatif);
            $this->nilai_akhir_semester = round($nilaiAkhir, 2);
            $this->save();
        }

        return $this->nilai_akhir_semester;
    }
}