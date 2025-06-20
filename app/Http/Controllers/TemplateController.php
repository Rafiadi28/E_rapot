<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TemplateController extends Controller
{
    /**
     * Download template import siswa
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadSiswaTemplate()
    {
        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Header kolom
        $headers = [
            'NIS', 'NISN', 'Nama Lengkap', 'Jenis Kelamin (L/P)', 'Tempat Lahir',
            'Tanggal Lahir (YYYY-MM-DD)', 'Agama', 'Alamat', 'Nama Ayah', 'Nama Ibu'
        ];
        
        // Set header
        $sheet->fromArray([$headers], null, 'A1');
        
        // Style untuk header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]
        ];
        
        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);
        
        // Set lebar kolom
        foreach(range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Buat writer
        $writer = new Xlsx($spreadsheet);
        
        // Simpan ke output
        $fileName = 'template_import_siswa_' . date('Ymd_His') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
