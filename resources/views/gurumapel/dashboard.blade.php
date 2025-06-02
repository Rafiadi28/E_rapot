@extends('layouts.app')

@section('title', 'Dashboard Guru Mapel')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dashboard Guru Mapel</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Mata Pelajaran Diampu</h3>
            <ul class="space-y-2">
                @foreach($mapelDiampu as $mapel)
                    <div>
                        <h3>{{ $mapel->nama_mapel }}</h3>
                        <p>Kelas yang diajar:</p>
                        <ul>
                            @foreach($mapel->kelas as $kelas)
                                <li>{{ $kelas->nama_kelas }} - {{ $kelas->tingkat }} {{ $kelas->jurusan }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </ul>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Input Nilai Terbaru</h3>
            <div class="space-y-4">
                @foreach($nilaiTerbaru as $nilai)
                    <div class="border-b pb-2">
                        <p class="font-semibold">{{ $nilai->siswa->nama_lengkap }}</p>
                        <p class="text-sm text-gray-500">{{ $nilai->created_at->format('d M Y H:i') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection