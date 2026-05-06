<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DosenController; //

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);


Route::get('/dosen', [KrsController::class, 'dashboard'])
    ->middleware(['auth', 'role:dosen']);

Route::prefix('dosen')->middleware(['auth','role:dosen'])->group(function () {

    Route::get('/', [DosenController::class, 'dashboard']);

    Route::get('/kelas', [DosenController::class, 'kelas']);
    Route::get('/validasi', [DosenController::class, 'validasi']);

    Route::get('/panduan', function () {
     return view('dosen.panduan');
    });
Route::get('/validasi', function () {
    return view('dosen.validasi');
});

    Route::get('/kelas/{kode}', [DosenController::class, 'detailKelas']);
    Route::get('/nilai/{kode}', [DosenController::class, 'inputNilai']);

});
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {

    Route::get('/home', function () {
        return view('mahasiswa.home');
    })->name('home');

    Route::get('/krs', [KrsController::class, 'index'])->name('krs');
    Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');

    Route::get('/khs', function () {
        return view('mahasiswa.khs');
    })->name('khs');

    Route::get('/profil', function () {
        return view('mahasiswa.profil');
    })->name('profil');

    Route::get('/panduan', function () {
        return view('mahasiswa.panduan');
    })->name('panduan');
Route::prefix('admin')->group(function () {

    Route::view('/', 'admin.dashboard');

    Route::view('/mahasiswa', 'admin.mahasiswa');
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
   
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');


    
});