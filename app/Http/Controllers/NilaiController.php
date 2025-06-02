<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $guru = Auth::user();
        $nilaiSiswa = Nilai::where('guru_id', $guru->id)
            ->with(['siswa', 'mataPelajaran'])
            ->get();

        return view('nilai.index', compact('nilaiSiswa'));
    }

    public function create()
    {
        $guru = Auth::user();
        $mataPelajaran = $guru->mataPelajaran;
        $siswa = Siswa::all();

        return view('nilai.create', compact('mataPelajaran', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'nilai_formatif' => 'required|numeric|min:0|max:100',
            'nilai_sumatif' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = new Nilai();
        $nilai->siswa_id = $request->siswa_id;
        $nilai->guru_id = Auth::id();
        $nilai->mata_pelajaran_id = $request->mata_pelajaran_id;
        $nilai->nilai_formatif = $request->nilai_formatif;
        $nilai->nilai_sumatif = $request->nilai_sumatif;

        // Generate deskripsi otomatis sesuai Kurikulum Merdeka
        $nilai->deskripsi_formatif = $nilai->generateDeskripsiFormatif($request->nilai_formatif);
        $nilai->deskripsi_sumatif = $nilai->generateDeskripsiSumatif($request->nilai_sumatif);
        
        // Hitung nilai akhir semester
        $nilai->hitungNilaiAkhir();
        
        // Generate capaian kompetensi
        $nilai->capaian_kompetensi = $nilai->generateCapaianKompetensi();

        $nilai->save();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan');
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $guru = Auth::user();
        $mataPelajaran = $guru->mataPelajaran;
        $siswa = Siswa::all();

        return view('nilai.edit', compact('nilai', 'mataPelajaran', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'nilai_formatif' => 'required|numeric|min:0|max:100',
            'nilai_sumatif' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->siswa_id = $request->siswa_id;
        $nilai->mata_pelajaran_id = $request->mata_pelajaran_id;
        $nilai->nilai_formatif = $request->nilai_formatif;
        $nilai->nilai_sumatif = $request->nilai_sumatif;

        // Update deskripsi otomatis
        $nilai->deskripsi_formatif = $nilai->generateDeskripsiFormatif($request->nilai_formatif);
        $nilai->deskripsi_sumatif = $nilai->generateDeskripsiSumatif($request->nilai_sumatif);
        
        // Update nilai akhir semester
        $nilai->hitungNilaiAkhir();
        
        // Update capaian kompetensi
        $nilai->capaian_kompetensi = $nilai->generateCapaianKompetensi();

        $nilai->save();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus');
    }
}