<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index($kelompok)
    {
        $mapel = MataPelajaran::where('kelompok', $kelompok)->get();
        return view('superadmin.mapel.index', compact('mapel', 'kelompok'));
    }

    public function create($kelompok)
    {
        return view('superadmin.mapel.create', compact('kelompok'));
    }

    public function store(Request $request, $kelompok)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|unique:mata_pelajaran,kode_mapel',
        ]);

        $validated['kelompok'] = $kelompok;

        MataPelajaran::create($validated);

        return redirect()->route('superadmin.mapel.index', $kelompok)
            ->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function edit($kelompok, MataPelajaran $mapel)
    {
        return view('superadmin.mapel.edit', compact('mapel', 'kelompok'));
    }

    public function update(Request $request, $kelompok, MataPelajaran $mapel)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|unique:mata_pelajaran,kode_mapel,' . $mapel->id,
        ]);

        $mapel->update($validated);

        return redirect()->route('superadmin.mapel.index', $kelompok)
            ->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    public function destroy($kelompok, MataPelajaran $mapel)
    {
        $mapel->delete();

        return redirect()->route('superadmin.mapel.index', $kelompok)
            ->with('success', 'Mata pelajaran berhasil dihapus');
    }
}