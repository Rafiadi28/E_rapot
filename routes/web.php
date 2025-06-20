<?php

use App\Http\Controllers\GuruMapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\WakaKurikulumController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\KelasController;

// Auth Routes
Auth::routes(['register' => false]);

// Route untuk download template
Route::get('/download/template/siswa', [\App\Http\Controllers\DownloadController::class, 'downloadTemplateSiswa'])
    ->name('template.siswa.download');

// Redirect root ke login atau dashboard sesuai role
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        switch($user->role) {
            case 'superadmin':
                return redirect()->route('superadmin.dashboard');
            case 'waka_kurikulum':
                return redirect()->route('wakakurikulum.dashboard');
            case 'guru_mapel':
                return redirect()->route('gurumapel.dashboard');
            case 'walikelas':
                return redirect()->route('walikelas.dashboard');
            default:
                return redirect()->route('login');
        }
    }
    return redirect()->route('login');
});

// Superadmin Routes
Route::middleware(['auth', 'user.role:superadmin'])->group(function () {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [SuperadminController::class, 'dashboard'])->name('dashboard');
        
        // Siswa Routes
        Route::prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/', [SiswaController::class, 'index'])->name('index');
            Route::get('/create', [SiswaController::class, 'create'])->name('create');
            Route::post('/', [SiswaController::class, 'store'])->name('store');
            Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');
            Route::put('/{siswa}', [SiswaController::class, 'update'])->name('update');
            Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('destroy');
            
            // Import/Export Routes
            Route::get('/upload', [SiswaController::class, 'upload'])->name('upload');
            Route::post('/import', [SiswaController::class, 'import'])->name('import');
            
            // Route untuk download template
            Route::get('/template/download', [SiswaController::class, 'downloadTemplate'])->name('template.download');
        });
        
        // Master Data
        Route::resource('users', UserController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('jurusan', JurusanController::class);
        
        
        // Mata Pelajaran Routes
        Route::prefix('mapel')->name('mapel.')->group(function () {
            Route::get('/', [MapelController::class, 'index'])->name('index');
            Route::get('/create', [MapelController::class, 'create'])->name('create');
            Route::post('/', [MapelController::class, 'store'])->name('store');
            Route::get('/{mapel}/edit', [MapelController::class, 'edit'])->name('edit');
            Route::put('/{mapel}', [MapelController::class, 'update'])->name('update');
            Route::delete('/{mapel}', [MapelController::class, 'destroy'])->name('destroy');
        });
        
        // Cetak Routes
        Route::prefix('cetak')->name('cetak.')->group(function () {
            Route::get('/', [CetakController::class, 'index'])->name('index');
            Route::get('/kelas/{kelas}', [CetakController::class, 'kelas'])->name('kelas');
            Route::get('/siswa/{siswa}', [CetakController::class, 'siswa'])->name('siswa');
            Route::get('/rapor/{siswa}', [CetakController::class, 'cetakRapor'])->name('rapor');
        });
    });
});

// Waka Kurikulum Routes
Route::middleware(['auth', 'user.role:waka_kurikulum'])->group(function () {
    Route::prefix('wakakurikulum')->name('wakakurikulum.')->group(function () {
        Route::get('/dashboard', [WakaKurikulumController::class, 'dashboard'])->name('dashboard');
        Route::resource('mata-pelajaran', MataPelajaranController::class);
    });
});

// Guru Mapel Routes
Route::middleware(['auth', 'user.role:guru_mapel'])->group(function () {
    Route::prefix('gurumapel')->name('gurumapel.')->group(function () {
        Route::get('/dashboard', [GuruMapelController::class, 'dashboard'])->name('dashboard');
        Route::resource('nilai', NilaiController::class);
    });
});

// Route untuk download template
// Wali Kelas Routes
Route::middleware(['auth', 'user.role:walikelas'])->group(function () {
    Route::prefix('walikelas')->name('walikelas.')->group(function () {
        Route::get('/dashboard', [WaliKelasController::class, 'dashboard'])->name('dashboard');
        Route::get('/rapor/{siswa}', [WaliKelasController::class, 'rapor'])->name('rapor');
        Route::get('/rapor', [WaliKelasController::class, 'index'])->name('rapor.index');
        Route::resource('siswa', SiswaController::class);
    });
});

