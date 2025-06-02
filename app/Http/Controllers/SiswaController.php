<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
{
    public function index()
    {
        $user = auth()->guard('web')->user();
        $kelas = $user->waliKelas;
        $siswa = Siswa::where('kelas_id', $kelas->id)->paginate(10);
        
        return view('walikelas.siswa.index', compact('siswa'));
    }

    // Add other necessary CRUD methods here
}