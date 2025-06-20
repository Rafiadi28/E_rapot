<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::paginate(10); // Mengubah ::all() menjadi ::paginate()
        return view('superadmin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('superadmin.kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1|max:12',
            'jurusan_id' => 'required|exists:jurusan,id',
            'walikelas_id' => 'required|exists:users,id',
        ]);

        Kelas::create($validated);

        return redirect()->route('superadmin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kelas)
    {
        return view('superadmin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1|max:12',
            'jurusan_id' => 'required|exists:jurusan,id',
            'walikelas_id' => 'required|exists:users,id',
        ]);

        $kelas->update($validated);

        return redirect()->route('superadmin.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('superadmin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus');
    }
}