@extends('layouts.app')

@section('title', 'Rapor Siswa')

@section('content')
<div class="container mx-auto p-6">
    <!-- Header Rapor -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">RAPOR PESERTA DIDIK</h1>
            <h2 class="text-xl">SEKOLAH MENENGAH KEJURUAN</h2>
            <h3 class="text-lg">(SMK)</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <table class="w-full">
                    <tr>
                        <td class="py-2">Nama Sekolah</td>
                        <td>: {{ config('sekolah.nama') }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">NPSN</td>
                        <td>: {{ config('sekolah.npsn') }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">Alamat</td>
                        <td>: {{ config('sekolah.alamat') }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <table class="w-full">
                    <tr>
                        <td class="py-2">Nama Peserta Didik</td>
                        <td>: {{ $siswa->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">NISN/NIS</td>
                        <td>: {{ $siswa->nisn }}/{{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">Kelas</td>
                        <td>: {{ $siswa->kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">Semester</td>
                        <td>: {{ $semester }}</td>
                    </tr>
                    <tr>
                        <td class="py-2">Tahun Pelajaran</td>
                        <td>: {{ $tahun_ajaran }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Nilai Akademik -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-xl font-bold mb-4">A. NILAI AKADEMIK</h3>

        <!-- Kelompok A (Umum) -->
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Kelompok A (Umum)</h4>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Pengetahuan</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Keterampilan</th>
                            <th class="border border-gray-300 px-4 py-2">Capaian Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai->where('mataPelajaran.kelompok', 'A') as $index => $n)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $n->mataPelajaran->nama_mapel }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_pengetahuan }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_keterampilan }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $n->capaian_kompetensi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kelompok B (Umum) -->
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Kelompok B (Umum)</h4>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Pengetahuan</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Keterampilan</th>
                            <th class="border border-gray-300 px-4 py-2">Capaian Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai->where('mataPelajaran.kelompok', 'B') as $index => $n)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $n->mataPelajaran->nama_mapel }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_pengetahuan }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_keterampilan }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $n->capaian_kompetensi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kelompok C (Kejuruan) -->
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Kelompok C (Kejuruan)</h4>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Pengetahuan</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Keterampilan</th>
                            <th class="border border-gray-300 px-4 py-2">Capaian Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai->where('mataPelajaran.kelompok', 'C') as $index => $n)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $n->mataPelajaran->nama_mapel }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_pengetahuan }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_keterampilan }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $n->capaian_kompetensi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Catatan dan Tanda Tangan -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Catatan Wali Kelas -->
            <div>
                <h4 class="font-semibold mb-2">Catatan Wali Kelas</h4>
                <div class="border border-gray-300 p-4 min-h-[100px] rounded">
                    {{ $catatan_walikelas ?? '-' }}
                </div>
            </div>

            <!-- Ketidakhadiran -->
            <div>
                <h4 class="font-semibold mb-2">Ketidakhadiran</h4>
                <table class="w-full border-collapse border border-gray-300">
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Sakit</td>
                        <td class="border border-gray-300 px-4 py-2">: {{ $kehadiran->sakit ?? 0 }} hari</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Izin</td>
                        <td class="border border-gray-300 px-4 py-2">: {{ $kehadiran->izin ?? 0 }} hari</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Tanpa Keterangan</td>
                        <td class="border border-gray-300 px-4 py-2">: {{ $kehadiran->tanpa_keterangan ?? 0 }} hari</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="grid grid-cols-2 gap-6 mt-8">
            <div class="text-center">
                <p>Mengetahui,</p>
                <p>Orang Tua/Wali</p>
                <div class="h-24"></div>
                <p class="border-t border-black pt-2 inline-block">.........................</p>
            </div>
            <div class="text-center">
                <p>{{ config('sekolah.kota') }}, {{ $tanggal_rapor }}</p>
                <p>Wali Kelas</p>
                <div class="h-24"></div>
                <p class="border-t border-black pt-2 inline-block">{{ $siswa->kelas->waliKelas->name }}</p>
                <p>NIP. {{ $siswa->kelas->waliKelas->nip }}</p>
            </div>
        </div>
    </div>
</div>
@endsection