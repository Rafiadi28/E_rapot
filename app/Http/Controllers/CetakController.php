<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('superadmin.cetak.index', compact('kelas'));
    }

    public function kelas(Kelas $kelas)
    {
        $siswa = $kelas->siswa;
        return view('superadmin.cetak.kelas', compact('kelas', 'siswa'));
    }

    public function siswa(Siswa $siswa)
    {
        $nilai = $siswa->nilai;
        $kehadiran = $siswa->kehadiran;
        return view('superadmin.cetak.siswa', compact('siswa', 'nilai', 'kehadiran'));
    }

    public function cetakRapor(Siswa $siswa)
    {
        $nilai = $siswa->nilai;
        $kehadiran = $siswa->kehadiran;
        $kelas = $siswa->kelas;
        
        return view('superadmin.cetak.rapor', compact('siswa', 'nilai', 'kehadiran', 'kelas'));
    }
}