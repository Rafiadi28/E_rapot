<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliKelasController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $kelas = Kelas::where('walikelas_id', $user->id)->first();
    
        $siswaBelumLengkap = Siswa::where('kelas_id', $kelas->id)
            ->whereDoesntHave('nilai', function($query) {
                $query->whereNotNull('nilai_formatif')
                      ->whereNotNull('nilai_sumatif')
                      ->whereNotNull('nilai_akhir_semester');
            })
            ->get();

        $totalSiswa = Siswa::where('kelas_id', $kelas->id)->count();

        return view('walikelas.dashboard', compact('kelas', 'siswaBelumLengkap', 'totalSiswa'));
    }

    public function rapor(Siswa $siswa, Request $request)
    {
        // Validasi akses wali kelas
        $this->authorize('view', $siswa);

        // Ambil data nilai
        $nilai = $siswa->nilai()
            ->where('semester', $request->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->with('mataPelajaran')
            ->get()
            ->groupBy('mataPelajaran.kelompok');

        // Data kehadiran
        $kehadiran = $siswa->kehadiran()
            ->where('semester', $request->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->first();

        // Format tanggal rapor
        $tanggal_rapor = now()->locale('id')->isoFormat('D MMMM Y');

        return view('walikelas.rapor.show', compact(
            'siswa',
            'nilai',
            'kehadiran',
            'tanggal_rapor',
            'semester',
            'tahun_ajaran'
        ));
    }
}