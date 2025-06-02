<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalGuru = User::whereIn('role', ['guru_mapel', 'walikelas'])->count();
        $totalSiswa = \App\Models\Siswa::count();

        return view('superadmin.dashboard', compact('totalUsers', 'totalGuru', 'totalSiswa'));
    }
}