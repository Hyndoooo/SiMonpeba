<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Guru Controller
use App\Http\Controllers\Guru\DataSiswaController;
use App\Http\Controllers\Guru\DetailDataSiswaController;
use App\Http\Controllers\Guru\DetailPerkembanganSiswaController;
use App\Http\Controllers\Guru\DownloadController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Guru\HistoriController;
use App\Http\Controllers\Guru\PerkembanganSiswaController;
use App\Http\Controllers\Guru\PesanController;

// Ortu Controller
use App\Http\Controllers\Ortu\BuktiMediaController;
use App\Http\Controllers\Ortu\DetailPerkembanganSiswaOrtuController;
use App\Http\Controllers\Ortu\DownloadControllerOrtu;
use App\Http\Controllers\Ortu\HistoriOrtuController;
use App\Http\Controllers\Ortu\OrtuDashboardController;
use App\Http\Controllers\Ortu\PesanOrtuController;


// Redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Alias bawaan Laravel agar tidak error Route [login] not defined
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// =======================
// LOGIN DAN LOGOUT MULTIUSER
// =======================
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Grup middleware untuk autentikasi dan verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // =======================
    // GURU AREA (Hanya setelah autentikasi dan verifikasi login guru)
    // =======================
    Route::middleware('role:guru')->group(function () {
        Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
        Route::get('/data-siswa/{nis}', [DetailDataSiswaController::class, 'show'])->name('data_siswa.detail');
        Route::put('/data-siswa/{nis}', [DetailDataSiswaController::class, 'update'])->name('data_siswa.update');
        
        // Data Siswa routes
        Route::resource('data_siswa', DataSiswaController::class)->only([
            'create', 'store', 'edit', 'update',
        ]);

        // Perkembangan siswa routes
        Route::get('/perkembangan-siswa/guru', [PerkembanganSiswaController::class, 'index'])->name('perkembangan-siswa');
        Route::get('/perkembangan_siswa/detail/{nis}', [DetailPerkembanganSiswaController::class, 'index'])->name('perkembangan_siswa.detail');
        Route::post('/perkembangan_siswa/store', [DetailPerkembanganSiswaController::class, 'store'])->name('perkembangan_siswa.store');

        // Histori routes
        Route::get('/perkembangan_siswa/{nis}/histori', [HistoriController::class, 'index'])->name('histori.index');
        Route::delete('/perkembangan_siswa/{id_perkembangan}', [HistoriController::class, 'destroy'])->name('perkembangan_siswa.destroy');
        Route::get('/histori/download/{nis}', [DownloadController::class, 'downloadPDF'])->name('histori.download');

        // Pesan
        Route::get('pesan/{nis}', [PesanController::class, 'index'])->name('pesan.index');
        Route::post('pesan/{nis}/store', [PesanController::class, 'store'])->name('pesan.store');
        Route::delete('/pesan/{id_pesan}', [PesanController::class, 'destroy'])->name('pesan.destroy');
        Route::put('/pesan/{id_pesan}', [PesanController::class, 'update'])->name('pesan.update');

    });

    // =======================
    // ORTU AREA (Hanya setelah autentikasi dan verifikasi login ortu)
    // =======================
    Route::middleware('role:ortu')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('/ortu/dashboard', [OrtuDashboardController::class, 'index'])->name('ortu.dashboard');
        Route::get('/ortu/detail/{nis}', [DetailPerkembanganSiswaOrtuController::class, 'index'])->name('ortu.detail');
        Route::get('/ortu/{nis}/histori', [HistoriOrtuController::class, 'index'])->name('histori.ortu');
        Route::get('/ortu/download/{nis}', [DownloadControllerOrtu::class, 'downloadPDF'])->name('histori.ortu.download');

        // Bukti Media
        Route::get('/ortu/{nis}/bukti-media', [BuktiMediaController::class, 'show'])->name('bukti.media');
        Route::get('/ortu/{nis}/download-bukti', [BuktiMediaController::class, 'download'])->name('ortu.download.bukti');

        // Pesan
        Route::get('pesan', [PesanOrtuController::class, 'index'])->name('ortu.pesan.index');
        Route::post('pesan/store/{id_penerima}', [PesanOrtuController::class, 'store'])->name('ortu.pesan.store');
        Route::delete('/ortu/pesan/{id_pesan}', [PesanOrtuController::class, 'destroy'])->name('ortu.pesan.destroy');
        Route::put('/ortu/pesan/{id_pesan}', [PesanOrtuController::class, 'update'])->name('ortu.pesan.update');
        });
});