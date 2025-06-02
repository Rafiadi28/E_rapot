@extends('layouts.app')

@section('title', 'Dashboard Superadmin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dashboard Superadmin</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Pengguna</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Guru</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalGuru }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Siswa</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalSiswa }}</p>
        </div>
    </div>
</div>
@endsection