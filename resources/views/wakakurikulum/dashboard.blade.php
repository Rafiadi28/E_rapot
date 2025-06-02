@extends('layouts.app')

@section('title', 'Dashboard Waka Kurikulum')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dashboard Waka Kurikulum</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Mata Pelajaran</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalMapel }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Guru Mapel</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalGuruMapel }}</p>
        </div>
    </div>
</div>
@endsection