@auth
    @if(auth()->user()->isSuperAdmin())
        <x-nav-link href="{{ route('superadmin.dashboard') }}" :active="request()->routeIs('superadmin.dashboard')">
            Dashboard
        </x-nav-link>

        <!-- Data Peserta -->
        <div class="space-y-1">
            <x-nav-dropdown-button>
                <x-slot name="icon">
                    <i class="fas fa-users"></i>
                </x-slot>
                Data Peserta
            </x-nav-dropdown-button>

            <x-nav-dropdown-content>
                <x-nav-dropdown-link href="{{ route('siswa.index') }}">
                    Tambah Siswa
                </x-nav-dropdown-link>
                <x-nav-dropdown-link href="{{ route('kelas.index') }}">
                    Tambah Kelas
                </x-nav-dropdown-link>
                <x-nav-dropdown-link href="{{ route('jurusan.index') }}">
                    Tambah Jurusan
                </x-nav-dropdown-link>
                <x-nav-dropdown-link href="{{ route('guru.index') }}">
                    Tambah Akun Guru
                </x-nav-dropdown-link>
            </x-nav-dropdown-content>
        </div>

        <!-- Data Pelajaran -->
        <div class="space-y-1">
            <x-nav-dropdown-button>
                <x-slot name="icon">
                    <i class="fas fa-book"></i>
                </x-slot>
                Data Pelajaran
            </x-nav-dropdown-button>

            <x-nav-dropdown-content>
                <x-nav-dropdown-link href="{{ route('superadmin.mapel.index', 'A') }}">
                    Mapel Kelompok A
                </x-nav-dropdown-link>
                <x-nav-dropdown-link href="{{ route('superadmin.mapel.index', 'B') }}">
                    Mapel Kelompok B
                </x-nav-dropdown-link>
                <x-nav-dropdown-link href="{{ route('superadmin.mapel.index', 'C') }}">
                    Mapel Kelompok C
                </x-nav-dropdown-link>
            </x-nav-dropdown-content>
        </div>
    @endif

    @if(auth()->user()->isWakaKurikulum())
        <x-nav-link href="{{ route('wakakurikulum.dashboard') }}" :active="request()->routeIs('wakakurikulum.dashboard')">
            Dashboard
        </x-nav-link>
        <x-nav-link href="{{ route('mata-pelajaran.index') }}" :active="request()->routeIs('mata-pelajaran.*')">
            Mata Pelajaran
        </x-nav-link>
    @endif

    @if(auth()->user()->isGuruMapel())
        <x-nav-link href="{{ route('gurumapel.dashboard') }}" :active="request()->routeIs('gurumapel.dashboard')">
            Dashboard
        </x-nav-link>
        <x-nav-link href="{{ route('nilai.index') }}" :active="request()->routeIs('nilai.*')">
            Input Nilai
        </x-nav-link>
    @endif

    @if(auth()->user()->isWaliKelas())
        <x-nav-link href="{{ route('walikelas.dashboard') }}" :active="request()->routeIs('walikelas.dashboard')">
            Dashboard
        </x-nav-link>
        <x-nav-link href="{{ route('siswa.index') }}" :active="request()->routeIs('siswa.*')">
            Data Siswa
        </x-nav-link>
        <x-nav-link href="{{ route('walikelas.rapor.index') }}" :active="request()->routeIs('walikelas.rapor.*')">
            Rapor
        </x-nav-link>
    @endif
@endauth