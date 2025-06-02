<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class WakaKurikulumController extends Controller
{
    public function dashboard()
    {
        $totalMapel = MataPelajaran::count();
        $totalGuruMapel = User::where('role', 'guru_mapel')->count();

        return view('wakakurikulum.dashboard', compact('totalMapel', 'totalGuruMapel'));
    }
}