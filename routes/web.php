<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\OrtuDashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BuktiMediaController;
use App\Http\Controllers\DetailDataSiswaController;
use App\Http\Controllers\DetailPerkembanganSiswaController;
use App\Http\Controllers\DetailPerkembanganSiswaOrtuController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DownloadControllerOrtu;
use App\Http\Controllers\PerkembanganSiswaController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\HistoriOrtuController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Grup middleware untuk autentikasi
Route::middleware(['auth'])->group(function () {

    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data Siswa routes
    Route::resource('data_siswa', DataSiswaController::class)->only([
        'create', 'store', 'edit', 'update',
    ]);
});

// Grup middleware untuk autentikasi dan verifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Grup middleware untuk role guru
    Route::middleware('role:guru')->group(function () {
        Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
        Route::get('/data_siswa/detail/{nis}', [DetailDataSiswaController::class, 'index'])->name('data_siswa.detail');
        
        // Perkembangan siswa routes
        Route::get('/perkembangan-siswa/guru', [PerkembanganSiswaController::class, 'index'])->name('perkembangan-siswa');
        Route::get('/perkembangan_siswa/detail/{nis}', [DetailPerkembanganSiswaController::class, 'index'])->name('perkembangan_siswa.detail');
        Route::post('/perkembangan_siswa/store', [DetailPerkembanganSiswaController::class, 'store'])->name('perkembangan_siswa.store');

        // Histori routes
        Route::get('/perkembangan_siswa/{nis}/histori', [HistoriController::class, 'index'])->name('histori.index');
        Route::delete('/perkembangan_siswa/{id_perkembangan}', [HistoriController::class, 'destroy'])->name('perkembangan_siswa.destroy');
        Route::get('/histori/download/{nis}', [DownloadController::class, 'downloadPDF'])->name('histori.download');

    });

    // Grup middleware untuk role ortu
    Route::middleware('role:ortu')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('/ortu/dashboard', [OrtuDashboardController::class, 'index'])->name('ortu.dashboard');
        Route::get('/ortu/detail/{nis}', [DetailPerkembanganSiswaOrtuController::class, 'index'])->name('ortu.detail');
        Route::get('/ortu/{nis}/histori', [HistoriOrtuController::class, 'index'])->name('histori.ortu');
        Route::get('/ortu/download/{nis}', [DownloadControllerOrtu::class, 'downloadPDF'])->name('histori.download');

        //Bukti Media
        Route::get('/ortu/{nis}/bukti-media', [BuktiMediaController::class, 'show'])->name('bukti.media');
        Route::get('/ortu/{nis}/download-bukti', [BuktiMediaController::class, 'download'])->name('ortu.download.bukti');
    });
});

use App\Http\Controllers\PesanController;

Route::middleware(['auth'])->group(function () {
    // Route untuk menampilkan pesan yang dikirim dan diterima
    Route::get('pesan', [PesanController::class, 'index'])->name('pesan.index');
    
    // Route untuk form kirim pesan
    Route::get('pesan/create/{id_penerima}', [PesanController::class, 'create'])->name('pesan.create');
    
    // Route untuk menyimpan pesan
    Route::post('pesan/store/{id_penerima}', [PesanController::class, 'store'])->name('pesan.store');
});
