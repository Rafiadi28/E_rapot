<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DownloadController extends Controller
{
    public function downloadTemplateSiswa()
    {
        // Pastikan tidak ada output sebelumnya
        if (ob_get_level()) ob_end_clean();

        // Buat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setTitle('Template Import Siswa');

        // Set header
        $headers = [
            'NIS', 'NISN', 'Nama Lengkap', 'Jenis Kelamin (L/P)', 
            'Tempat Lahir', 'Tanggal Lahir (YYYY-MM-DD)', 'Agama', 
            'Alamat', 'Nama Ayah', 'Nama Ibu'
        ];
        
        // Tambahkan header ke sheet
        $sheet->fromArray($headers, null, 'A1');

        // Style untuk header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
        ];
        
        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);

        // Set lebar kolom otomatis
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Buat writer
        $writer = new Xlsx($spreadsheet);
        
        // Nama file
        $fileName = 'template_import_siswa_' . date('Ymd_His') . '.xlsx';
        
        // Hapus semua output sebelumnya
        $response = response()->streamDownload(
            function() use ($writer) {
                $writer->save('php://output');
            },
            $fileName,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Cache-Control' => 'max-age=0'
            ]
        );

        return $response;
    }
}
