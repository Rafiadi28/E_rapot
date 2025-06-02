<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaran extends Model
{
    protected $table = 'tujuan_pembelajaran';
    
    protected $fillable = [
        'capaian_pembelajaran_id',
        'deskripsi',
        'alur_tujuan'
    ];

    public function capaianPembelajaran()
    {
        return $this->belongsTo(CapaianPembelajaran::class);
    }
}