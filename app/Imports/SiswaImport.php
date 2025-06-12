<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $kelas_id;

    public function __construct($kelas_id = null)
    {
        $this->kelas_id = $kelas_id;
    }

    public function model(array $row)
    {
        return new Siswa([
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'nama_lengkap' => $row['nama_lengkap'],
            'kelas_id' => $this->kelas_id ?? $row['kelas_id'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $this->transformDate($row['tanggal_lahir']),
            'agama' => $row['agama'],
            'alamat' => $row['alamat'],
            'nama_ayah' => $row['nama_ayah'],
            'nama_ibu' => $row['nama_ibu'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nis' => 'required|unique:siswa,nis',
            'nisn' => 'required|unique:siswa,nisn',
            'nama_lengkap' => 'required',
            'kelas_id' => $this->kelas_id ? '' : 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ];
    }

    private function transformDate($value)
    {
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat('Y-m-d', $value);
        }
    }
}