<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\KpsController;
use App\Http\Controllers\AdminMatkulController;
use App\Http\Controllers\AdminNilaiController;
use App\Http\Controllers\LaporanKrsController;
use App\Http\Controllers\LaporanKhsController;
use App\Http\Controllers\KhsController;
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

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/mahasiswa',
        [MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/create',
        [MahasiswaController::class, 'create']);
    Route::post('/mahasiswa/store',
    [MahasiswaController::class, 'store']);
    Route::get('/mahasiswa/{nim}/edit',
    [MahasiswaController::class, 'edit']);
    Route::post('/mahasiswa/{nim}/update',
    [MahasiswaController::class, 'update']);
    Route::get('/mahasiswa/{nim}/hapus',[MahasiswaController::class, 'destroy']);
    Route::get('/dosen',[AdminDosenController::class, 'index']);
    Route::get('/dosen/create',[AdminDosenController::class, 'create']);
    Route::post('/dosen/store',[AdminDosenController::class, 'store']);
    Route::get('/dosen/{nuptk}/edit',[AdminDosenController::class,'edit']);
    Route::post('/dosen/{nuptk}/update',[AdminDosenController::class,'update']);
    Route::get('/dosen/{nuptk}/hapus',[AdminDosenController::class,'destroy']);
    Route::get('/dosen/{nuptk}',[AdminDosenController::class,'show']);
    Route::get('/matkul',[AdminMatkulController::class,'index']);
    Route::get('/krs',[KrsController::class, 'pengajuan']);
    Route::get('/krs/{nim}',[KrsController::class, 'detail']);
    Route::get('/matkul/create',[AdminMatkulController::class,'create']);
    Route::post('/matkul/store',[AdminMatkulController::class,'store']);
    Route::get('/matkul/{kode_mk}',[AdminMatkulController::class,'show']);
    Route::get('/matkul/{kode_mk}/edit',[AdminMatkulController::class,'edit']);
    Route::post('/matkul/{kode_mk}/update',[AdminMatkulController::class,'update']);
    Route::get('/matkul/{kode_mk}/hapus',[   AdminMatkulController::class,'destroy']);
    Route::get('/matkul', [AdminMatkulController::class, 'index']);
    Route::get('/krs-approve',[KrsController::class, 'persetujuan']);
    Route::get('/krs/setujui/{id}',[KrsController::class, 'setujui']);
    Route::get('/krs/tolak/{id}',[KrsController::class, 'tolak']);
    Route::view('/nilai', 'admin.nilai_input');
    Route::get(    '/validasi',    [AdminNilaiController::class, 'index']);
    Route::get('/validasi/setujui/{nim}',[AdminNilaiController::class,'setujui']);
    Route::get('/validasi/tolak/{nim}',[AdminNilaiController::class,'tolak']);
    Route::get('/laporan-krs',[LaporanKrsController::class,'index']);
    Route::get('/laporan-khs',[LaporanKhsController::class, 'index']);
    Route::get('/laporan-khs/pdf',[LaporanKhsController::class, 'exportPdf']);
    Route::get('/laporan-khs/excel',[LaporanKhsController::class, 'exportExcel']);
    Route::get('/laporan-krs/pdf',[LaporanKrsController::class,'exportPdf']);
    Route::get('/laporan-krs/excel',[LaporanKrsController::class,'exportExcel']);
    Route::view('/pengaturan', 'admin.pengaturan');
    Route::get( '/pengguna',[DashboardController::class,'pengguna']);
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
    Route::get('/validasi', [DosenController::class, 'validasi']);
    Route::get('/krs/approve/{id}', [DosenController::class, 'approve']);
    Route::get('/krs/reject/{id}', [DosenController::class, 'reject']);
    Route::get('/panduan', function () {return view('dosen.panduan');});
    Route::get('/kelas/{kode}', [DosenController::class, 'detailKelas']);
    Route::get('/nilai/{kode}', [DosenController::class, 'inputNilai']);
    Route::post('/nilai/simpan',[DosenController::class, 'simpanNilai'])->name('nilai.simpan');
    Route::get('/template-nilai',[DosenController::class, 'downloadTemplate'])->name('nilai.template');
    Route::post('/nilai/import',[DosenController::class,'importNilai'])->name('nilai.import');
    Route::get('/nilai/hapus/{nim}',[DosenController::class,'hapusNilai'])->name('nilai.hapus');
    Route::get('/export-kelas-pdf',[DosenController::class,'exportKelasPdf'])->name('dosen.export.pdf');});


    /*
|--------------------------------------------------------------------------
| MAHASISWA
|--------------------------------------------------------------------------
*/

Route::get(
    '/home',
    [MahasiswaController::class, 'home']
);

Route::get('/krs', [KrsController::class, 'index']);

Route::post('/krs/store', [KrsController::class, 'store'])
    ->name('krs.store');

Route::get('/khs',[KrsController::class, 'khs']);

Route::get('/profil', [ProfileController::class, 'index']);

Route::get('/panduan', function () {
    return view('mahasiswa.panduan');
});


Route::get(
    '/admin/mahasiswa/{id}',
    [MahasiswaController::class, 'show']
);

/*
|--------------------------------------------------------------------------
| KPS
|--------------------------------------------------------------------------
*/


Route::prefix('kps')->group(function () {

    Route::get('/',
    [KpsController::class, 'dashboard']
);

    Route::get('/approve',
        [KpsController::class, 'approve']);

    Route::get('/approve/setujui/{nim}',
        [KpsController::class, 'setujui']);

    Route::get('/approve/tolak/{nim}',
        [KpsController::class, 'tolak']);

    Route::get('/kunci',
    [KpsController::class, 'kunci']);

    Route::get('/kunci/lock/{nim}',
        [KpsController::class, 'lock']);

    Route::get('/kunci/unlock/{nim}',
        [KpsController::class, 'unlock']);

    Route::get('/laporan',
    [KpsController::class, 'laporan']);
    Route::get('/laporan/pdf',
    [KpsController::class, 'exportPdf']);
    Route::get('/laporan/excel',
    [KpsController::class, 'exportExcel']);
    Route::get(
    '/laporan/detail/{nim}/{kode_mk}',
    [KpsController::class, 'detailNilai']);
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
Route::get('/cek-login', function () {
    dd(
        auth()->check(),
        auth()->user()
    );
});