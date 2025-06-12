@auth
    @if(auth()->user()->isSuperadmin())
        <x-nav-link href="{{ route('superadmin.dashboard') }}" :active="request()->routeIs('superadmin.dashboard')">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </x-nav-link>

        <!-- Data Peserta -->
        <div class="space-y-1 mb-4">
            @php $dataPesertaId = 'data-peserta-dropdown'; @endphp
            <x-nav-dropdown-button :id="$dataPesertaId">
                <x-slot name="icon">
                    <i class="fas fa-users"></i>
                </x-slot>
                Data Peserta
            </x-nav-dropdown-button>

            <x-nav-dropdown-content :id="$dataPesertaId">
                <x-nav-dropdown-link href="{{ route('superadmin.siswa.index') }}">
                    <i class="fas fa-user-graduate mr-2"></i> Data Siswa
                </x-nav-dropdown-link>
                <!-- <x-nav-dropdown-link href="{{ route('superadmin.siswa.create') }}">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Siswa
                </x-nav-dropdown-link> -->
<!-- 
                <x-nav-dropdown-link href="{{ route('superadmin.siswa.upload') }}">
                    <i class="fas fa-upload mr-2"></i> Upload Data Siswa
                </x-nav-dropdown-link> -->

                <x-nav-dropdown-link href="{{ route('superadmin.kelas.index') }}">
                    <i class="fas fa-school mr-2"></i> Tambah Kelas
                </x-nav-dropdown-link>

                <x-nav-dropdown-link href="{{ route('superadmin.jurusan.index') }}">
                    <i class="fas fa-graduation-cap mr-2"></i> Tambah Jurusan
                </x-nav-dropdown-link>
                
                <x-nav-dropdown-link href="{{ route('superadmin.users.index') }}">
                    <i class="fas fa-user-tie mr-2"></i> Tambah Akun Guru
                </x-nav-dropdown-link>
            </x-nav-dropdown-content>
        </div>

        <!-- Data Pelajaran -->
        <div class="space-y-1 mb-4">
            @php $dataPelajaranId = 'data-pelajaran-dropdown'; @endphp
            <x-nav-dropdown-button :id="$dataPelajaranId">
                <x-slot name="icon">
                    <i class="fas fa-book"></i>
                </x-slot>
                Data Pelajaran
            </x-nav-dropdown-button>

            <x-nav-dropdown-content :id="$dataPelajaranId">
                <x-nav-dropdown-link href="{{ route('superadmin.mapel.index', 'A') }}">
                    <i class="fas fa-book-open mr-2"></i> Mapel Kelompok A
                </x-nav-dropdown-link>
                <x-nav-dropdown-link href="{{ route('superadmin.mapel.index', 'B') }}">
                    <i class="fas fa-book-open mr-2"></i> Mapel Kelompok B
                </x-nav-dropdown-link>
                <x-nav-dropdown-link href="{{ route('superadmin.mapel.index', 'C') }}">
                    <i class="fas fa-book-open mr-2"></i> Mapel Kelompok C
                </x-nav-dropdown-link>
            </x-nav-dropdown-content>
        </div>

        <!-- Cetak -->
        <x-nav-link href="{{ route('superadmin.cetak.index') }}" :active="request()->routeIs('superadmin.cetak.*')">
            <i class="fas fa-print mr-2"></i> Cetak Laporan
        </x-nav-link>
    @endif

    @if(auth()->user()->isWakaKurikulum())
        <x-nav-link href="{{ route('wakakurikulum.dashboard') }}" :active="request()->routeIs('wakakurikulum.dashboard')">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </x-nav-link>
        <x-nav-link href="{{ route('wakakurikulum.mata-pelajaran.index') }}" :active="request()->routeIs('wakakurikulum.mata-pelajaran.*')">
            <i class="fas fa-book mr-2"></i> Mata Pelajaran
        </x-nav-link>
    @endif

    @if(auth()->user()->isGuruMapel())
        <x-nav-link href="{{ route('gurumapel.dashboard') }}" :active="request()->routeIs('gurumapel.dashboard')">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </x-nav-link>
        <x-nav-link href="{{ route('gurumapel.nilai.index') }}" :active="request()->routeIs('gurumapel.nilai.*')">
            <i class="fas fa-clipboard-check mr-2"></i> Input Nilai
        </x-nav-link>
    @endif

    @if(auth()->user()->isWaliKelas())
        <x-nav-link href="{{ route('walikelas.dashboard') }}" :active="request()->routeIs('walikelas.dashboard')">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </x-nav-link>
        <x-nav-link href="{{ route('walikelas.siswa.index') }}" :active="request()->routeIs('walikelas.siswa.*')">
            <i class="fas fa-user-graduate mr-2"></i> Data Siswa
        </x-nav-link>
        <x-nav-link href="{{ route('walikelas.rapor.index') }}" :active="request()->routeIs('walikelas.rapor.*')">
            <i class="fas fa-file-alt mr-2"></i> Rapor
        </x-nav-link>
    @endif
@endauth