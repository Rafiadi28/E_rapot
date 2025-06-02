<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MataPelajaran;
use App\Models\Nilai;

class GuruMapelController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $mapelDiampu = MataPelajaran::whereHas('guru', function($query) use ($user) {
            $query->where('guru_id', $user->id);
        })->with(['kelas' => function($query) {
            $query->select('kelas.id', 'kelas.nama_kelas', 'kelas.tingkat', 'kelas.jurusan');
        }])->get();

        // When accessing collection data, use proper methods
        $nilaiTerbaru = Nilai::where('guru_id', $user->id)
            ->with(['siswa' => function($query) {
                $query->select('id', 'nama', 'nis');
            }])
            ->latest()
            ->take(5)
            ->get();

        return view('gurumapel.dashboard', compact('mapelDiampu', 'nilaiTerbaru'));
    }
}