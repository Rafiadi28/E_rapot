<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function array(): array
    {
        // Contoh data
        return [
            [
                'nis' => '1234567',
                'nisn' => '9876543210',
                'nama_lengkap' => 'Nama Siswa',
                'kelas_id' => '1',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2005-01-01',
                'agama' => 'Islam',
                'alamat' => 'Jl. Contoh No. 123',
                'nama_ayah' => 'Nama Ayah',
                'nama_ibu' => 'Nama Ibu',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'nis',
            'nisn',
            'nama_lengkap',
            'kelas_id',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'alamat',
            'nama_ayah',
            'nama_ibu',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}