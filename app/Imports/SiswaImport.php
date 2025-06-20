<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use SkipsErrors;
    
    protected $kelas_id;

    public function __construct($kelas_id = null)
    {
        $this->kelas_id = $kelas_id;
    }

    public function model(array $row)
    {
        // Skip baris kosong
        if (empty($row['nis']) || empty($row['nama_lengkap'])) {
            return null;
        }

        try {
            return new Siswa([
                'nis' => trim($row['nis']),
                'nisn' => trim($row['nisn'] ?? ''),
                'nama_lengkap' => trim($row['nama_lengkap']),
                'kelas_id' => $this->kelas_id ?? ($row['kelas_id'] ?? null),
                'jenis_kelamin' => strtoupper(trim($row['jenis_kelamin'] ?? 'L')),
                'tempat_lahir' => trim($row['tempat_lahir'] ?? ''),
                'tanggal_lahir' => $this->transformDate($row['tanggal_lahir'] ?? null),
                'agama' => trim($row['agama'] ?? ''),
                'alamat' => trim($row['alamat'] ?? ''),
                'nama_ayah' => trim($row['nama_ayah'] ?? ''),
                'nama_ibu' => trim($row['nama_ibu'] ?? ''),
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating Siswa model: ' . $e->getMessage(), ['row' => $row]);
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nis' => 'required|unique:siswa,nis',
            'nama_lengkap' => 'required|string|max:255',
            'kelas_id' => $this->kelas_id ? '' : 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah ada dalam database',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'kelas_id.required' => 'Kelas ID wajib diisi',
            'kelas_id.exists' => 'Kelas tidak ditemukan',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',
        ];
    }

    private function transformDate($value)
    {
        if (empty($value)) {
            return null;
        }

        try {
            // Jika value adalah angka (Excel date)
            if (is_numeric($value)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            }
            
            // Jika value adalah string tanggal
            if (is_string($value)) {
                // Coba berbagai format tanggal
                $formats = ['Y-m-d', 'd/m/Y', 'd-m-Y', 'Y/m/d'];
                
                foreach ($formats as $format) {
                    try {
                        return Carbon::createFromFormat($format, $value);
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }
            
            return null;
        } catch (\Exception $e) {
            Log::warning('Failed to transform date: ' . $value, ['error' => $e->getMessage()]);
            return null;
        }
    }
}