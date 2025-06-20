<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SiswaTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function array(): array
    {
        // Contoh data kosong untuk template
        return [
            // Baris kosong untuk diisi pengguna
            [
                'nis' => '',
                'nisn' => '',
                'nama_lengkap' => '',
                'kelas_id' => '',
                'jenis_kelamin' => '',
                'tempat_lahir' => '',
                'tanggal_lahir' => '',
                'agama' => '',
                'alamat' => '',
                'nama_ayah' => '',
                'nama_ibu' => '',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'NIS*',
            'NISN*',
            'Nama Lengkap*',
            'ID Kelas*',
            'Jenis Kelamin (L/P)*',
            'Tempat Lahir*',
            'Tanggal Lahir (YYYY-MM-DD)*',
            'Agama*',
            'Alamat*',
            'Nama Ayah*',
            'Nama Ibu*',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style untuk header
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F46E5'], // Indigo-600
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'D1D5DB'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set lebar kolom
        $sheet->getColumnDimension('A')->setWidth(15);  // NIS
        $sheet->getColumnDimension('B')->setWidth(15);  // NISN
        $sheet->getColumnDimension('C')->setWidth(30);  // Nama Lengkap
        $sheet->getColumnDimension('D')->setWidth(10);  // Kelas ID
        $sheet->getColumnDimension('E')->setWidth(15);  // Jenis Kelamin
        $sheet->getColumnDimension('F')->setWidth(20);  // Tempat Lahir
        $sheet->getColumnDimension('G')->setWidth(20);  // Tanggal Lahir
        $sheet->getColumnDimension('H')->setWidth(15);  // Agama
        $sheet->getColumnDimension('I')->setWidth(30);  // Alamat
        $sheet->getColumnDimension('J')->setWidth(25);  // Nama Ayah
        $sheet->getColumnDimension('K')->setWidth(25);  // Nama Ibu

        // Tambahkan catatan
        $sheet->setCellValue('A3', 'Catatan:');
        $sheet->mergeCells('A3:K3');
        $sheet->setCellValue('A4', '1. Kolom bertanda (*) wajib diisi');
        $sheet->setCellValue('A5', '2. Format tanggal: YYYY-MM-DD (contoh: 2005-01-31)');
        $sheet->setCellValue('A6', '3. Jenis Kelamin: L (Laki-laki) atau P (Perempuan)');
        $sheet->setCellValue('A7', '4. Kelas ID: Masukkan ID kelas yang tersedia di sistem');
        $sheet->setCellValue('A8', '5. Agama: Islam, Kristen, Katolik, Hindu, Buddha, Konghucu');
        
        // Style untuk catatan
        $sheet->getStyle('A3:K8')->applyFromArray([
            'font' => [
                'color' => ['rgb' => '6B7280'],
                'italic' => true,
            ]
        ]);
        
        // Auto filter
        $sheet->setAutoFilter('A1:K1');
        
        // Freeze baris pertama
        $sheet->freezePane('A2');
        
        return [
            // Style untuk data
            'A2:K1000' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'E5E7EB'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                ],
            ],
        ];
    }
}