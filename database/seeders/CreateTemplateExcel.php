<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Buat objek Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$sheet->setCellValue('A1', 'NIS');
$sheet->setCellValue('B1', 'NISN');
$sheet->setCellValue('C1', 'Nama Lengkap');
$sheet->setCellValue('D1', 'Jenis Kelamin (L/P)');
$sheet->setCellValue('E1', 'Tempat Lahir');
$sheet->setCellValue('F1', 'Tanggal Lahir (YYYY-MM-DD)');
$sheet->setCellValue('G1', 'Agama');
$sheet->setCellValue('H1', 'Alamat');
$sheet->setCellValue('I1', 'Nama Ayah');
$sheet->setCellValue('J1', 'Nama Ibu');

// Set lebar kolom
$sheet->getColumnDimension('A')->setWidth(15);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('F')->setWidth(25);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(40);
$sheet->getColumnDimension('I')->setWidth(30);
$sheet->getColumnDimension('J')->setWidth(30);

// Buat writer dan simpan ke file
$writer = new Xlsx($spreadsheet);
$writer->save(public_path('templates/template_siswa.xlsx'));

echo "Template berhasil dibuat di: " . public_path('templates/template_siswa.xlsx');
