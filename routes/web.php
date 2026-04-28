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

Route::get('/welcome', function () {
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
    // 🔥 BARU
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

   
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');


    
});