<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rapor Siswa') }} - {{ $siswa->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 flex justify-between items-center">
                        <a href="{{ route('superadmin.cetak.siswa', $siswa) }}" class="text-blue-600 hover:text-blue-900">
                            ← Kembali
                        </a>
                        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cetak Rapor
                        </button>
                    </div>

                    <div class="print-area">
                        <!-- Header Rapor -->
                        <div class="text-center mb-8">
                            <h1 class="text-2xl font-bold mb-2">RAPOR PESERTA DIDIK</h1>
                            <h2 class="text-xl">{{ config('sekolah.nama') }}</h2>
                        </div>

                        <!-- Data Siswa -->
                        <div class="mb-8">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2">Nama Peserta Didik</td>
                                    <td class="py-2">: {{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">NIS</td>
                                    <td class="py-2">: {{ $siswa->nis }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Kelas</td>
                                    <td class="py-2">: {{ $kelas->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Semester</td>
                                    <td class="py-2">: {{ config('sekolah.semester') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Tahun Pelajaran</td>
                                    <td class="py-2">: {{ config('sekolah.tahun_pelajaran') }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Nilai -->
                        <div class="mb-8">
                            <h3 class="font-semibold mb-4">A. Nilai Akademik</h3>
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2">No</th>
                                        <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                                        <th class="border border-gray-300 px-4 py-2">KKM</th>
                                        <th class="border border-gray-300 px-4 py-2">Nilai Pengetahuan</th>
                                        <th class="border border-gray-300 px-4 py-2">Nilai Keterampilan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai as $index => $n)
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $n->mata_pelajaran->nama_mapel }}</td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">75</td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_pengetahuan }}</td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $n->nilai_keterampilan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Kehadiran -->
                        <div class="mb-8">
                            <h3 class="font-semibold mb-4">B. Ketidakhadiran</h3>
                            <table class="w-full max-w-md">
                                <tr>
                                    <td class="py-2">Sakit</td>
                                    <td class="py-2">: {{ $kehadiran->sakit }} hari</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Izin</td>
                                    <td class="py-2">: {{ $kehadiran->izin }} hari</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Tanpa Keterangan</td>
                                    <td class="py-2">: {{ $kehadiran->alpha }} hari</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tanda Tangan -->
                        <div class="mt-16 grid grid-cols-2 gap-8">
                            <div class="text-center">
                                <p class="mb-20">Mengetahui,</p>
                                <p>Orang Tua/Wali</p>
                                <div class="h-16"></div>
                                <p>........................</p>
                            </div>
                            <div class="text-center">
                                <p class="mb-4">{{ config('sekolah.kota') }}, {{ date('d F Y') }}</p>
                                <p class="mb-16">Wali Kelas</p>
                                <p>{{ $kelas->walikelas->name }}</p>
                                <p>NIP. {{ $kelas->walikelas->nip }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .print-area {
                padding: 2cm;
            }
            @page {
                size: A4;
                margin: 0;
            }
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</x-app-layout>