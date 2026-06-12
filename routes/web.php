<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| WELCOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::view('/', 'admin.dashboard');

    Route::get('/mahasiswa',
        [MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/create',
        [MahasiswaController::class, 'create']);
    Route::post('/mahasiswa/store',
    [MahasiswaController::class, 'store']);
    Route::view('/dosen', 'admin.dosen');
    Route::view('/matkul', 'admin.matkul');
    Route::view('/krs', 'admin.krs_pengajuan');
    Route::view('/krs-approve', 'admin.krs_persetujuan');
    Route::view('/nilai', 'admin.nilai_input');
    Route::view('/validasi', 'admin.nilai_validasi');
    Route::view('/laporan-krs', 'admin.laporan_krs');
    Route::view('/laporan-khs', 'admin.laporan_khs');
    Route::view('/pengaturan', 'admin.pengaturan');
    Route::view('/pengguna', 'admin.pengguna');
    Route::view('/log', 'admin.log');
});

/*
|--------------------------------------------------------------------------
| DOSEN
|--------------------------------------------------------------------------
*/

Route::prefix('dosen')->group(function () {
    Route::get('/', [DosenController::class, 'dashboard']);
    Route::get('/kelas', [DosenController::class, 'kelas']);
    Route::get('/validasi', function () {
        return view('dosen.validasi');
    });
    Route::get('/panduan', function () {
        return view('dosen.panduan');
    });
    Route::get('/kelas/{kode}', [DosenController::class, 'detailKelas']);
    Route::get('/nilai/{kode}', [DosenController::class, 'inputNilai']);
    Route::get('/dosen/nilai/{kode}', [DosenController::class, 'inputNilai']);
Route::post('/nilai/simpan',
    [DosenController::class, 'simpanNilai'])
    ->name('nilai.simpan');

Route::get('/nilai/hapus/{id}',
    [DosenController::class, 'hapusNilai'])
    ->name('nilai.hapus');
    Route::get('/dosen', [DosenController::class, 'dashboard']);
});
Route::get('/dosen/template-nilai', [DosenController::class, 'downloadTemplate'])
    ->name('nilai.template');
Route::post(
    '/dosen/nilai/import',
    [DosenController::class, 'importNilai']
)->name('nilai.import');
Route::get(
    '/nilai/hapus/{nim}',
    [DosenController::class, 'hapusNilai']
)->name('nilai.hapus');
    /*
|--------------------------------------------------------------------------
| MAHASISWA
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    return view('mahasiswa.home');
});

Route::get('/krs', [KrsController::class, 'index']);

Route::post('/krs/store', [KrsController::class, 'store'])
    ->name('krs.store');

Route::get('/khs', function () {
    return view('mahasiswa.khs');
});

Route::get('/profil', function () {
    return view('mahasiswa.profil');
});

Route::get('/panduan', function () {
    return view('mahasiswa.panduan');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::post(
    '/profile/update',
    [ProfileController::class, 'update']
)->name('profile.update');

Route::post(
    '/profile/password',
    [ProfileController::class, 'updatePassword']
)->name('profile.password');