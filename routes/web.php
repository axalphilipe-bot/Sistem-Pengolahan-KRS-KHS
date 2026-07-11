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
use App\Http\Controllers\LaporanKrsController;
use App\Http\Controllers\LaporanKhsController;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AdminPenggunaController;
use App\Http\Controllers\LogAktivitasController;
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
    Route::get('/mahasiswa',[MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/create',[MahasiswaController::class, 'create']);
    Route::post('/mahasiswa/store',[MahasiswaController::class, 'store']);
    Route::post('/mahasiswa/import',[MahasiswaController::class, 'import'])->name('admin.mahasiswa.import');
    Route::get('/mahasiswa/export', [MahasiswaController::class, 'export'])->name('admin.mahasiswa.export');
    Route::get('/mahasiswa/template', [MahasiswaController::class, 'downloadTemplate'])->name('admin.mahasiswa.template');
    Route::get('/mahasiswa/{nim}/edit',
    [MahasiswaController::class, 'edit']);
    Route::post('/mahasiswa/{nim}/update',
    [MahasiswaController::class, 'update']);
    Route::get('/mahasiswa/{nim}/hapus',[MahasiswaController::class, 'destroy']);
    Route::get('/dosen',[AdminDosenController::class, 'index']);
    Route::get('/dosen/create',[AdminDosenController::class, 'create']);
    Route::post('/dosen/store',[AdminDosenController::class, 'store']);
    Route::post('/dosen/import',[AdminDosenController::class,'import'])->name('admin.dosen.import');
    Route::get('/dosen/export',[AdminDosenController::class, 'export'])->name('admin.dosen.export');
    Route::get('/dosen/template',[AdminDosenController::class, 'downloadTemplate'])->name('admin.dosen.template');
    Route::get('/dosen/{nuptk}/edit',[AdminDosenController::class,'edit']);
    Route::post('/dosen/{nuptk}/update',[AdminDosenController::class,'update']);
    Route::get('/dosen/{nuptk}/hapus',[AdminDosenController::class,'destroy']);
    Route::get('/dosen/{nuptk}',[AdminDosenController::class,'show']);
    Route::get('/matkul',[AdminMatkulController::class,'index']);
    Route::get('/matkul/export',[AdminMatkulController::class,'export'])->name('admin.matkul.export');
    Route::get('/matkul/template',[AdminMatkulController::class,'downloadTemplate'])->name('admin.matkul.template');
    Route::get('/krs',[KrsController::class, 'pengajuan']);
    Route::get('/krs/{nim}',[KrsController::class, 'detail']);
    Route::get('/matkul/create',[AdminMatkulController::class,'create']);
    Route::post('/matkul/store',[AdminMatkulController::class,'store']);
    Route::post('/matkul/import',[AdminMatkulController::class,'import'])->name('admin.matkul.import');
    Route::get('/matkul/{kode_mk}/edit',[AdminMatkulController::class,'edit']);
    Route::post('/matkul/{kode_mk}/update',[AdminMatkulController::class,'update']);
    Route::get('/matkul/{kode_mk}/hapus',[AdminMatkulController::class,'destroy']);
    Route::get('/matkul/{kode_mk}',[AdminMatkulController::class,'show']);
    Route::get('/krs-approve',[KrsController::class, 'persetujuan']);
    Route::get('/krs/setujui/{id}',[KrsController::class, 'setujui']);
    Route::get('/krs/tolak/{id}',[KrsController::class, 'tolak']);
    Route::view('/nilai', 'admin.nilai_input');
    Route::get('/laporan-krs',[LaporanKrsController::class,'index']);
    Route::get('/laporan-khs',[LaporanKhsController::class, 'index']);
    Route::get('/laporan-khs/pdf',[LaporanKhsController::class, 'exportPdf']);
    Route::get('/laporan-khs/excel',[LaporanKhsController::class, 'exportExcel']);
    Route::get('/laporan-krs/pdf',[LaporanKrsController::class,'exportPdf']);
    Route::get('/laporan-krs/excel',[LaporanKrsController::class,'exportExcel']);
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('admin.pengaturan.update');
    Route::get('/pengguna', [AdminPenggunaController::class, 'index'])->name('admin.pengguna.index');
    Route::get('/pengguna/create', [AdminPenggunaController::class, 'create'])->name('admin.pengguna.create');
    Route::post('/pengguna/store', [AdminPenggunaController::class, 'store'])->name('admin.pengguna.store');
    Route::get('/pengguna/{id}/edit', [AdminPenggunaController::class, 'edit'])->name('admin.pengguna.edit');
    Route::post('/pengguna/{id}/update', [AdminPenggunaController::class, 'update'])->name('admin.pengguna.update');
    Route::get('/pengguna/{id}/hapus', [AdminPenggunaController::class, 'destroy'])->name('admin.pengguna.destroy');
    Route::get('/log', [LogAktivitasController::class, 'index'])->name('admin.log.index');
});

/*
|--------------------------------------------------------------------------
| DOSEN
|--------------------------------------------------------------------------
*/

    Route::prefix('dosen')->middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/', [DosenController::class, 'dashboard']);
    Route::get('/kelas', [DosenController::class, 'kelas']);
    Route::get('/validasi', [DosenController::class, 'validasi']);
    Route::get('/krs/approve/{id}', [DosenController::class, 'approve']);
    Route::get('/krs/reject/{id}', [DosenController::class, 'reject']);
    Route::get('/panduan', function () {return view('dosen.panduan');});
    Route::get('/kelas/{kode}', [DosenController::class, 'detailKelas']);
    Route::get('/nilai', [DosenController::class, 'nilaiIndex']);
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

Route::middleware('auth')->group(function () {

Route::get(
    '/home',
    [MahasiswaController::class, 'home']
);

Route::get('/krs', [KrsController::class, 'index']);

Route::post('/krs/store', [KrsController::class, 'store'])
    ->name('krs.store');

Route::get('/khs', [KrsController::class, 'khs']);

Route::get('/khs/pdf', [KrsController::class, 'exportKhsPdf'])
    ->name('khs.pdf');

Route::get('/profil', [ProfileController::class, 'index']);

Route::get('/panduan', function () {
    return view('mahasiswa.panduan');
});

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


Route::prefix('kps')->middleware(['auth', 'role:kps'])->group(function () {

    Route::get('/',
    [KpsController::class, 'dashboard']
);

    Route::get('/approve',
        [KpsController::class, 'approve']);

    Route::get('/approve/setujui/{nim}/{kode_mk}',
        [KpsController::class, 'setujui']);

    Route::get('/approve/tolak/{nim}/{kode_mk}',
        [KpsController::class, 'tolak']);

    Route::post('/approve/kunci-semua',
        [KpsController::class, 'kunciSemua']);

    Route::get('/kunci',
    [KpsController::class, 'kunci']);

    Route::get('/kunci/lock/{kode_prodi}',
        [KpsController::class, 'lock']);

    Route::get('/kunci/unlock/{kode_prodi}',
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