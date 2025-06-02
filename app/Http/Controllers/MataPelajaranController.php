<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mataPelajaran = MataPelajaran::paginate(10);
        return view('wakakurikulum.mata-pelajaran.index', compact('mataPelajaran'));
    }

public function createMataPelajaran()
    {
        return view('wakakurikulum.mata-pelajaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'siswa_id' => 'required|exists:siswa,id',
            'nilai_pengetahuan' => 'required|numeric|min:0|max:100',
            'nilai_keterampilan' => 'required|numeric|min:0|max:100',
            'capaian_kompetensi' => 'required|string',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required|string'
        ]);
    
        $validated['guru_id'] = Auth::id();
        
        Nilai::create($validated);
    
        return redirect()->route('nilai.index')
            ->with('success', 'Nilai berhasil disimpan');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('wakakurikulum.mata-pelajaran.edit', compact('mataPelajaran'));
    }

    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|unique:mata_pelajaran,kode_mapel,'.$mataPelajaran->id,
            'kelompok' => 'required|in:A,B,C',
        ]);

        $mataPelajaran->update($validated);

        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();
        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil dihapus');
    }
    public function create()
{
    $mataPelajaran = MataPelajaran::where('guru_id', Auth::id())->get();
    $siswa = Siswa::whereHas('kelas.mataPelajaran', function($query) {
        $query->where('guru_id', Auth::id());
    })->get();
    
    return view('gurumapel.nilai.create', compact('mataPelajaran', 'siswa'));
    }
    
}