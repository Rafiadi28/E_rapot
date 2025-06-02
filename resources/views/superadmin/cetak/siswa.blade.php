<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nilai Siswa') }} - {{ $siswa->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('superadmin.cetak.kelas', $siswa->kelas) }}" class="text-blue-600 hover:text-blue-900 mr-4">
                            ← Kembali ke Daftar Siswa
                        </a>
                        <a href="{{ route('superadmin.cetak.rapor', $siswa) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-block">
                            Cetak Rapor
                        </a>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Data Siswa</h3>
                        <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                        <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                        <p><strong>Kelas:</strong> {{ $siswa->kelas->nama }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Nilai Mata Pelajaran</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Pengetahuan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Keterampilan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($nilai as $n)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $n->mata_pelajaran->nama_mapel }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $n->nilai_pengetahuan }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $n->nilai_keterampilan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Kehadiran</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-gray-100 p-4 rounded">
                                <p class="text-sm text-gray-600">Sakit</p>
                                <p class="text-2xl font-bold">{{ $kehadiran->sakit }}</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded">
                                <p class="text-sm text-gray-600">Izin</p>
                                <p class="text-2xl font-bold">{{ $kehadiran->izin }}</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded">
                                <p class="text-sm text-gray-600">Alpha</p>
                                <p class="text-2xl font-bold">{{ $kehadiran->alpha }}</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded">
                                <p class="text-sm text-gray-600">Total</p>
                                <p class="text-2xl font-bold">{{ $kehadiran->sakit + $kehadiran->izin + $kehadiran->alpha }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>