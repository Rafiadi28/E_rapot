@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Input Nilai Siswa</h2>

        <form action="{{ route('nilai.store') }}" method="POST" x-data="{ 
            nilaiPengetahuan: '', 
            nilaiKeterampilan: '',
            validateNilai() {
                return this.nilaiPengetahuan >= 0 && this.nilaiPengetahuan <= 100 &&
                       this.nilaiKeterampilan >= 0 && this.nilaiKeterampilan <= 100;
            }
        }">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pilih Mata Pelajaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Mata Pelajaran
                    </label>
                    <select name="mata_pelajaran_id" required 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mataPelajaran as $mapel)
                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Siswa -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Siswa
                    </label>
                    <select name="siswa_id" required 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">Pilih Siswa</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_lengkap }} - {{ $s->nis }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Nilai Pengetahuan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nilai Pengetahuan
                    </label>
                    <input type="number" name="nilai_pengetahuan" required
                           x-model="nilaiPengetahuan"
                           min="0" max="100"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                           placeholder="0-100">
                </div>

                <!-- Input Nilai Keterampilan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nilai Keterampilan
                    </label>
                    <input type="number" name="nilai_keterampilan" required
                           x-model="nilaiKeterampilan"
                           min="0" max="100"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                           placeholder="0-100">
                </div>

                <!-- Capaian Kompetensi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Capaian Kompetensi
                    </label>
                    <textarea name="capaian_kompetensi" required
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                              rows="4"
                              placeholder="Deskripsikan capaian kompetensi siswa"></textarea>
                </div>

                <!-- Semester dan Tahun Ajaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Semester
                    </label>
                    <select name="semester" required 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tahun Ajaran
                    </label>
                    <input type="text" name="tahun_ajaran" required
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                           placeholder="2023/2024">
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6">
                <button type="submit"
                        x-bind:disabled="!validateNilai()"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    Simpan Nilai
                </button>
            </div>
        </form>
    </div>
</div>
@endsection