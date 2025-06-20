@extends('layouts.app')

@section('title', 'Data Siswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
    /* Reset default styles */
    body {
        background-color: #f4f6f9;
    }
    
    /* Card styles */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    
    .card-header {
        background: #4e73df;
        color: white;
        border-radius: 8px 8px 0 0 !important;
        padding: 15px 20px;
    }
    
    .card-title {
        font-weight: 600;
        font-size: 1.25rem;
        margin: 0;
        display: flex;
        align-items: center;
    }
    
    .card-title i {
        margin-right: 10px;
    }
    
    /* Button styles */
    .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 15px;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
    }
    
    .btn i {
        margin-right: 5px;
    }
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 0.75rem;
    }
    
    .btn-primary {
        background: #4e73df;
        border-color: #4e73df;
    }
    
    .btn-success {
        background: #1cc88a;
        border-color: #1cc88a;
    }
    
    .btn-warning {
        background: #f6c23e;
        border-color: #f6c23e;
        color: #212529;
    }
    
    .btn-danger {
        background: #e74a3b;
        border-color: #e74a3b;
    }
    
    /* Table styles */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: #fff;
        border-collapse: collapse;
    }
    
    .table th {
        background-color: #f8f9fc;
        color: #4e73df;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        padding: 12px 15px;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .table td {
        padding: 12px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .table tr:last-child td {
        border-bottom: none;
    }
    
    .table tr:hover {
        background-color: #f8f9fc;
    }
    
    /* Badge styles */
    .badge {
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.75rem;
    }
    
    .badge-primary {
        background-color: #e3ebf7;
        color: #4e73df;
    }
    
    /* Action buttons */
    .action-buttons .btn {
        padding: 5px 8px;
        margin: 0 2px;
        border-radius: 4px;
    }
    
    /* Empty state */
    .empty-state {
        padding: 40px 0;
        text-align: center;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #d1d3e2;
        margin-bottom: 15px;
    }
    
    /* Pagination */
    .pagination {
        margin: 0;
    }
    
    .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    
    .page-link {
        color: #4e73df;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i> Daftar Siswa
                    </h3>
                    <div class="d-flex gap-2">
                        <!-- Hapus tombol import ini karena duplikat -->
                        <a href="{{ route('template.siswa.download') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-file-excel"></i> Download Template
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">

                    <div class="border-b border-gray-200 bg-white px-6 py-4">
                        <div class="flex flex-col space-y-4 md:flex-row md:items-center md:justify-between md:space-y-0 md:space-x-4">
                            <div class="relative flex-1">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="search" id="searchInput" class="block w-full rounded-md border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Cari siswa...">
                            </div>
                            <div class="grid grid-cols-2 gap-3 sm:flex sm:space-x-3">
                                <select id="filterKelas" class="rounded-md border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Kelas</option>
                                    @foreach(\App\Models\Kelas::all() as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                <select id="filterJenisKelamin" class="rounded-md border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <button type="button" onclick="openImportModal()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <i class="fas fa-file-import mr-2"></i> Import
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-hidden">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS/NISN</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Aksi</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($siswa as $item)
                                    <tr class="hover:bg-gray-50" data-kelas-id="{{ $item->kelas_id }}" data-jenis-kelamin="{{ $item->jenis_kelamin }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $loop->iteration + (($siswa->currentPage() - 1) * $siswa->perPage()) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <span class="text-blue-600 font-medium">{{ substr($item->nama_lengkap, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">NIS: {{ $item->nis }}</div>
                                            <div class="text-sm text-gray-500">NISN: {{ $item->nisn }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $item->kelas->nama_kelas ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($item->jenis_kelamin == 'L')
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Laki-laki
                                                </span>
                                            @else
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                                    Perempuan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('superadmin.siswa.edit', $item->id) }}" 
                                                   class="btn-action edit"
                                                   data-tooltip="tooltip" 
                                                   title="Edit">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.384-.834.68-1.343.882l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                        <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                    </svg>
                                                </a>
                                                <button type="button" 
                                                        class="btn-action delete delete-btn"
                                                        data-id="{{ $item->id }}"
                                                        data-name="{{ $item->nama_lengkap }}"
                                                        data-tooltip="tooltip"
                                                        title="Hapus">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.74v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.5 8.5a.75.75 0 101.5-.06l-.5-8.5zm4.34.06a.75.75 0 10-1.5-.06l-.5 8.5a.75.75 0 101.5.06l.5-8.5z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <a href="{{ route('superadmin.siswa.show', $item->id) }}" 
                                                   class="btn-action view"
                                                   data-tooltip="tooltip" 
                                                   title="Detail">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                                        <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="empty-state">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                                <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada data siswa</h3>
                                                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan data siswa baru.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    @if($siswa->hasPages())
                    <div id="pagination-info" class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200">
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if($siswa->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white">
                                    Sebelumnya
                                </span>
                            @else
                                <a href="{{ $siswa->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Sebelumnya
                                </a>
                            @endif
                            @if($siswa->hasMorePages())
                                <a href="{{ $siswa->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Selanjutnya
                                </a>
                            @else
                                <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white">
                                    Selanjutnya
                                </span>
                            @endif
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan
                                    <span class="font-medium">{{ $siswa->firstItem() }}</span>
                                    sampai
                                    <span class="font-medium">{{ $siswa->lastItem() }}</span>
                                    dari
                                    <span class="font-medium">{{ $siswa->total() }}</span>
                                    hasil
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($siswa->onFirstPage())
                                        <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-300">
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @else
                                        <a href="{{ $siswa->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($siswa->getUrlRange(1, $siswa->lastPage()) as $page => $url)
                                        @if ($page == $siswa->currentPage())
                                            <span aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($siswa->hasMorePages())
                                        <a href="{{ $siswa->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @else
                                        <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-300">
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeImportModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Import Data Siswa</h3>
                <p class="text-sm text-gray-500 mb-4">
                    Pilih file Excel (.xlsx) yang berisi data siswa. 
                    <a href="{{ route('template.siswa.download') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        <i class="fas fa-file-excel mr-1"></i> Unduh Template Excel
                    </a>
                </p>
                
                <form id="importForm" action="{{ route('superadmin.siswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Pilih Kelas</option>
                            @foreach(\App\Models\Kelas::all() as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Unggah file</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only" accept=".xlsx" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">XLSX (maks. 5MB)</p>
                            </div>
                        </div>
                        <div id="file-info" class="mt-2 text-sm text-gray-700 hidden">
                            <p>File: <span id="file-name" class="font-medium"></span> <span id="file-size" class="text-gray-500"></span></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="submitImport()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Upload
                </button>
                <button type="button" onclick="closeImportModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Pastikan Alpine.js sudah dimuat sebelum menjalankan script
    document.addEventListener('alpine:init', () => {
        console.log('Alpine.js initialized');
    });

    // Tunggu DOM dan Alpine.js siap
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan SweetAlert2 tersedia
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 not loaded!');
            return;
        }

        // Fungsi modal dengan error handling
        window.openImportModal = function() {
            console.log('Opening import modal...');
            try {
                const modal = document.getElementById('importModal');
                console.log('Modal element:', modal);
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    console.log('Modal opened successfully');
                } else {
                    console.error('Modal element not found!');
                    Swal.fire({
                        title: 'Error',
                        text: 'Modal tidak ditemukan',
                        icon: 'error',
                        confirmButtonColor: '#3B82F6'
                    });
                }
            } catch (error) {
                console.error('Error opening modal:', error);
            }
        };

        window.closeImportModal = function() {
            try {
                const modal = document.getElementById('importModal');
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                    const importForm = document.getElementById('importForm');
                    if (importForm) {
                        importForm.reset();
                        const fileInfo = document.getElementById('file-info');
                        if (fileInfo) fileInfo.classList.add('hidden');
                    }
                }
            } catch (error) {
                console.error('Error closing modal:', error);
            }
        };

        window.submitImport = function() {
            console.log('Submit import called...');
            try {
                const fileInput = document.getElementById('file-upload');
                console.log('File input:', fileInput);
                console.log('Files selected:', fileInput?.files?.length);
                
                if (!fileInput || fileInput.files.length === 0) {
                    Swal.fire({
                        title: 'Peringatan',
                        text: 'Silakan pilih file terlebih dahulu',
                        icon: 'warning',
                        confirmButtonColor: '#3B82F6'
                    });
                    return;
                }
                
                const importForm = document.getElementById('importForm');
                console.log('Form element:', importForm);
                if (importForm) {
                    console.log('Submitting form...');
                    importForm.submit();
                } else {
                    console.error('Form element not found!');
                    Swal.fire({
                        title: 'Error',
                        text: 'Form tidak ditemukan',
                        icon: 'error',
                        confirmButtonColor: '#3B82F6'
                    });
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim form',
                    icon: 'error',
                    confirmButtonColor: '#3B82F6'
                });
            }
        };

        // File upload handler dengan error handling
        const fileUpload = document.getElementById('file-upload');
        if (fileUpload) {
            fileUpload.addEventListener('change', function(e) {
                try {
                    const fileInfo = document.getElementById('file-info');
                    const fileName = document.getElementById('file-name');
                    const fileSize = document.getElementById('file-size');
                    
                    if (!fileInfo || !fileName || !fileSize) {
                        console.warn('File info elements not found');
                        return;
                    }

                    if (this.files.length > 0) {
                        const file = this.files[0];
                        const fileSizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                        
                        // Validasi ukuran file
                        if (file.size > 5 * 1024 * 1024) {
                            Swal.fire({
                                title: 'File terlalu besar',
                                text: 'Ukuran file maksimal adalah 5MB',
                                icon: 'error',
                                confirmButtonColor: '#3B82F6'
                            });
                            this.value = '';
                            fileInfo.classList.add('hidden');
                            return;
                        }
                        
                        // Validasi format file
                        if (!file.name.endsWith('.xlsx')) {
                            Swal.fire({
                                title: 'Format file tidak didukung',
                                text: 'Hanya file Excel (.xlsx) yang didukung',
                                icon: 'error',
                                confirmButtonColor: '#3B82F6'
                            });
                            this.value = '';
                            fileInfo.classList.add('hidden');
                            return;
                        }
                        
                        fileName.textContent = file.name;
                        fileSize.textContent = `(${fileSizeInMB} MB)`;
                        fileInfo.classList.remove('hidden');
                    } else {
                        fileInfo.classList.add('hidden');
                    }
                } catch (error) {
                    console.error('Error handling file upload:', error);
                }
            });
        }

        // Filter dan search functionality
        const searchInput = document.getElementById('searchInput');
        const filterKelas = document.getElementById('filterKelas');
        const filterGender = document.getElementById('filterJenisKelamin');
        
        function filterTable() {
            try {
                if (!searchInput || !filterKelas || !filterGender) return;
                
                const searchTerm = searchInput.value.toLowerCase();
                const selectedKelas = filterKelas.value;
                const selectedGender = filterGender.value;
                const rows = document.querySelectorAll('tbody tr');
                let visibleCount = 0;

                rows.forEach(row => {
                    if (row.classList.contains('no-data')) return;
                    
                    const nameCell = row.querySelector('td:nth-child(2)');
                    const nisCell = row.querySelector('td:nth-child(3)');
                    
                    if (!nameCell || !nisCell) return;
                    
                    const name = nameCell.textContent?.toLowerCase() || '';
                    const nis = nisCell.textContent?.toLowerCase() || '';
                    const kelas = row.dataset.kelasId || '';
                    const gender = row.dataset.jenisKelamin || '';
                    
                    const matchesSearch = name.includes(searchTerm) || nis.includes(searchTerm);
                    const matchesKelas = !selectedKelas || kelas === selectedKelas;
                    const matchesGender = !selectedGender || gender === selectedGender;
                    
                    if (matchesSearch && matchesKelas && matchesGender) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                updateDataInfo(visibleCount);
            } catch (error) {
                console.error('Error filtering table:', error);
            }
        }
        
        function updateDataInfo(visibleCount) {
            try {
                const tbody = document.querySelector('tbody');
                const totalRows = tbody ? tbody.querySelectorAll('tr:not(.no-data)').length : 0;
                const noDataRow = tbody ? tbody.querySelector('tr.no-data') : null;
                const paginationInfo = document.getElementById('pagination-info');
                const table = tbody ? tbody.closest('table') : null;
                const colspan = table ? table.querySelectorAll('th').length : 6;
                
                if (noDataRow) noDataRow.remove();
                
                if (visibleCount === 0 && totalRows > 0) {
                    if (tbody) {
                        const tr = document.createElement('tr');
                        tr.className = 'no-data';
                        tr.innerHTML = `
                            <td colspan="${colspan}" class="px-6 py-12 text-center">
                                <div class="empty-state">
                                    <i class="fas fa-search text-4xl text-gray-300 mb-3"></i>
                                    <h5 class="text-lg font-medium text-gray-900">Data tidak ditemukan</h5>
                                    <p class="text-gray-500">Coba gunakan kata kunci atau filter yang berbeda</p>
                                </div>
                            </td>`;
                        tbody.appendChild(tr);
                    }
                    if (paginationInfo) paginationInfo.style.display = 'none';
                } else {
                    if (paginationInfo) paginationInfo.style.display = 'flex';
                }
            } catch (error) {
                console.error('Error updating data info:', error);
            }
        }
        
        // Event listeners dengan error handling
        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterKelas) filterKelas.addEventListener('change', filterTable);
        if (filterGender) filterGender.addEventListener('change', filterTable);

        // Delete confirmation dengan error handling
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                try {
                    const btn = e.target.closest('.delete-btn');
                    const id = btn.dataset.id;
                    const name = btn.dataset.name;
                    
                    Swal.fire({
                        title: 'Hapus Data Siswa',
                        text: `Apakah Anda yakin ingin menghapus data ${name}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/superadmin/siswa/${id}`;
                            form.style.display = 'none';
                            form.innerHTML = `
                                @csrf
                                @method('DELETE')
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                } catch (error) {
                    console.error('Error handling delete:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menghapus data',
                        icon: 'error',
                        confirmButtonColor: '#3B82F6'
                    });
                }
            }
        });

        // Inisialisasi awal
        filterTable();
    });
</script>
@endpush

@endsection
