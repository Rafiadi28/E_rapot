@extends('layouts.app')

@section('title', 'Dashboard Superadmin')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Superadmin</h1>
        <div class="text-sm text-gray-500">
            <i class="fas fa-calendar-alt mr-1"></i> {{ date('d F Y') }}
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm">
                <a href="{{ route('superadmin.users.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Total Guru</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $totalGuru }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm">
                <a href="{{ route('superadmin.users.index') }}" class="text-green-600 hover:text-green-800 flex items-center">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Total Siswa</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalSiswa }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm">
                <a href="{{ route('superadmin.siswa.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-chart-pie text-blue-500 mr-2"></i> Distribusi Kelas
            </h3>
            <div class="h-64 flex items-center justify-center text-gray-500">
                <p>Grafik distribusi kelas akan ditampilkan di sini</p>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-clipboard-list text-green-500 mr-2"></i> Aktivitas Terbaru
            </h3>
            <div class="space-y-4">
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-600">Input nilai oleh <span class="font-medium">Guru Matematika</span></p>
                    <p class="text-xs text-gray-500">2 jam yang lalu</p>
                </div>
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-600">Penambahan siswa baru oleh <span class="font-medium">Admin</span></p>
                    <p class="text-xs text-gray-500">5 jam yang lalu</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Pembaruan data kelas oleh <span class="font-medium">Waka Kurikulum</span></p>
                    <p class="text-xs text-gray-500">1 hari yang lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection