<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Make sure Auth facade is imported
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Exports\SiswaTemplateExport;


class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role === 'superadmin') {
            $siswa = Siswa::with('kelas')->paginate(10);
            return view('superadmin.siswa.index', compact('siswa'));
        } elseif (Auth::user()->role === 'walikelas') {
            $kelas = Kelas::where('walikelas_id', Auth::id())->first();
            
            if ($kelas) {
                $siswa = Siswa::where('kelas_id', $kelas->id)->paginate(10);
            } else {
                $siswa = collect()->paginate(10);
            }
            
            return view('walikelas.siswa.index', compact('siswa', 'kelas'));
        }
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('superadmin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nisn' => 'required|unique:siswa,nisn',
            'nama_lengkap' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ]);

        Siswa::create($request->all());

        return redirect()->route('superadmin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('superadmin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $siswa->id,
            'nisn' => 'required|unique:siswa,nisn,' . $siswa->id,
            'nama_lengkap' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ]);

        $siswa->update($request->all());

        return redirect()->route('superadmin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('superadmin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }

    // Fitur Upload
    public function upload()
    {
        $kelas = Kelas::all();
        return view('superadmin.siswa.upload', compact('kelas'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
    
        $kelas_id = $request->kelas_id;
    
        try {
            Excel::import(new SiswaImport($kelas_id), $request->file('file'));
            
            return redirect()->route('superadmin.siswa.index')
                ->with('success', 'Data siswa berhasil diimport');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            
            foreach ($failures as $failure) {
                $errors[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            }
            
            return redirect()->back()
                ->withErrors(['import' => $errors])
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['import' => 'Terjadi kesalahan saat import: ' . $e->getMessage()])
                ->withInput();
        }
    }
}