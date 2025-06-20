<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="mb-6">
                        <a href="{{ route('superadmin.siswa.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← Kembali ke Daftar Siswa
                        </a>
                    </div>

                    <div class="mb-6">
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Petunjuk Upload</p>
                            <p>1. Download template Excel terlebih dahulu</p>
                            <p>2. Isi data sesuai format yang ditentukan</p>
                            <p>3. Upload file Excel yang sudah diisi</p>
                            <p>4. Pastikan format file adalah .xlsx</p>
                        </div>
                        
                        <a href="{{ route('template.siswa.download') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-block mb-4">
                            Download Template
                        </a>
                    </div>

                    <form method="POST" action="{{ route('superadmin.siswa.import') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">File Excel (.xlsx)</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full" required accept=".xlsx">
                        </div>

                        <div class="mb-4">
                            <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 mt-1">*Opsional, jika tidak dipilih akan menggunakan kelas dari file Excel</p>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>