@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dashboard Wali Kelas</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Informasi Kelas</h3>
            <div class="space-y-2">
                <p><span class="font-medium">Kelas:</span> {{ $kelas->nama_kelas }}</p>
                <p><span class="font-medium">Jurusan:</span> {{ $kelas->jurusan }}</p>
                <p><span class="font-medium">Total Siswa:</span> {{ $totalSiswa }}</p>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Siswa Belum Lengkap Nilai</h3>
            <ul class="space-y-2">
                @foreach($siswaBelumLengkap as $siswa)
                    <li class="text-red-600">{{ $siswa->nama_lengkap }}</li>
                @endforeach
            </ul>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Rapor</h3>
            <div class="space-y-4">
                <a href="{{ route('walikelas.rapor.index') }}" class="block w-full text-center bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                    Lihat Rapor
                </a>
            </div>
        </div>
    </div>
</div>
@endsection