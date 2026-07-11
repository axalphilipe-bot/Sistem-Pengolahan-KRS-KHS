<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Dosen;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Nilai;
use App\Models\PengaturanSistem;
use App\Models\Prodi;
use App\Models\User;
use App\Support\DemoConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DosenImport;
use App\Imports\MatkulImport;
use PhpOffice\PhpSpreadsheet\IOFactory;

$paths = [
    'dosen' => 'C:/Users/HP/OneDrive/Desktop/Dosen_Final_v2_KRS_KHS_Polibatam.xlsx',
    'mahasiswa_final' => 'C:/Users/HP/OneDrive/Desktop/Mahasiswa_Final_KRS_KHS_Polibatam.xlsx',
    'mahasiswa_if2b' => 'C:/Users/HP/Downloads/data mahasiswa IF2B MALAM.xlsx',
    'mahasiswa_export' => 'C:/Users/HP/Downloads/Data_Mahasiswa_2026-07-05.xlsx',
    'matkul' => 'C:/Users/HP/OneDrive/Desktop/MataKuliah_Final_KRS_KHS_Polibatam.xlsx',
    'krs' => 'C:/Users/HP/OneDrive/Desktop/KRS_Final_v2_KRS_KHS_Polibatam.xlsx',
    'nilai' => 'C:/Users/HP/OneDrive/Desktop/Nilai_Final_v2_KRS_KHS_Polibatam.xlsx',
];

foreach ($paths as $label => $file) {
    if (! file_exists($file)) {
        echo "GAGAL: file {$label} tidak ditemukan: {$file}\n";
        exit(1);
    }
}

$prodiList = [
    'IF' => 'D3 Teknik Informatika',
    'GM' => 'D3 Teknik Geomatika',
    'AN' => 'D4 Animasi',
    'TRM' => 'D4 Teknologi Rekayasa Multimedia',
    'KS' => 'D4 Keamanan Siber',
    'RPL' => 'D4 Rekayasa Perangkat Lunak',
    'TP' => 'D4 Teknologi Permainan',
    'MTK' => 'Magister Terapan Teknik Komputer',
];

function normalizeProdi(?string $kode): string
{
    $kode = strtoupper(trim((string) $kode));

    return $kode === 'TI' ? 'IF' : $kode;
}

function importMahasiswaRows(string $file, callable $mapper): int
{
    $sheet = IOFactory::load($file)->getActiveSheet();
    $count = 0;

    for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
        $data = $mapper($sheet, $row);

        if ($data === null) {
            continue;
        }

        Mahasiswa::updateOrCreate(['nim' => $data['nim']], $data);
        $count++;
    }

    return $count;
}

echo "=== RESTORE DATA ASLI DARI BACKUP EXCEL ===\n";

DB::transaction(function () use ($paths, $prodiList) {
    foreach ($prodiList as $kode => $nama) {
        Prodi::updateOrCreate(['kode_prodi' => $kode], ['nama_prodi' => $nama]);
    }

    DB::table('nilais')->delete();
    DB::table('krs')->delete();
    Mahasiswa::query()->delete();
    MataKuliah::query()->delete();
    Dosen::query()->delete();

    Excel::import(new DosenImport(), $paths['dosen']);
    Excel::import(new MatkulImport(), $paths['matkul']);

    Dosen::updateOrCreate(
        ['nuptk' => DemoConfig::NUPTK_DOSEN],
        [
            'nama' => 'Cyntia Lasmi Andesti',
            'email' => 'cyntia.lasmi@polibatam.ac.id',
            'jabatan' => 'Lektor',
            'kode_prodi' => DemoConfig::KODE_PRODI,
        ]
    );

    $mhsFinal = importMahasiswaRows($paths['mahasiswa_final'], function ($sheet, $row) {
        $nim = trim((string) $sheet->getCellByColumnAndRow(1, $row)->getValue());

        if ($nim === '' || strtolower($nim) === 'nim') {
            return null;
        }

        return [
            'nim' => $nim,
            'nama' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
            'email' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
            'kelas' => $sheet->getCellByColumnAndRow(4, $row)->getValue(),
            'kelas_huruf' => null,
            'jenjang' => $sheet->getCellByColumnAndRow(5, $row)->getValue() ?: 'D3',
            'semester' => (int) $sheet->getCellByColumnAndRow(6, $row)->getValue() ?: 1,
            'kode_prodi' => normalizeProdi($sheet->getCellByColumnAndRow(7, $row)->getValue()),
            'nuptk_wali' => null,
        ];
    });

    $mhsIf2b = importMahasiswaRows($paths['mahasiswa_if2b'], function ($sheet, $row) {
        $nim = trim((string) $sheet->getCellByColumnAndRow(1, $row)->getValue());

        if ($nim === '' || strtolower($nim) === 'nim') {
            return null;
        }

        return [
            'nim' => $nim,
            'nama' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
            'email' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
            'kelas' => $sheet->getCellByColumnAndRow(4, $row)->getValue(),
            'kelas_huruf' => $sheet->getCellByColumnAndRow(5, $row)->getValue(),
            'jenjang' => $sheet->getCellByColumnAndRow(6, $row)->getValue() ?: 'D3',
            'semester' => (int) $sheet->getCellByColumnAndRow(7, $row)->getValue() ?: 1,
            'kode_prodi' => normalizeProdi($sheet->getCellByColumnAndRow(8, $row)->getValue()),
            'nuptk_wali' => DemoConfig::NUPTK_DOSEN,
        ];
    });

    $mhsExport = importMahasiswaRows($paths['mahasiswa_export'], function ($sheet, $row) {
        $nim = trim((string) $sheet->getCellByColumnAndRow(1, $row)->getValue());

        if ($nim === '' || strtolower($nim) === 'nim') {
            return null;
        }

        return [
            'nim' => $nim,
            'nama' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
            'email' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
            'kelas' => $sheet->getCellByColumnAndRow(4, $row)->getValue(),
            'kelas_huruf' => $sheet->getCellByColumnAndRow(5, $row)->getValue(),
            'jenjang' => $sheet->getCellByColumnAndRow(6, $row)->getValue() ?: 'D3',
            'semester' => (int) $sheet->getCellByColumnAndRow(7, $row)->getValue() ?: 1,
            'kode_prodi' => normalizeProdi($sheet->getCellByColumnAndRow(8, $row)->getValue()),
            'nuptk_wali' => DemoConfig::NUPTK_DOSEN,
        ];
    });

    $krsCount = 0;
    $krsSheet = IOFactory::load($paths['krs'])->getActiveSheet();

    for ($row = 2; $row <= $krsSheet->getHighestRow(); $row++) {
        $nim = trim((string) $krsSheet->getCellByColumnAndRow(1, $row)->getValue());
        $kodeMk = trim((string) $krsSheet->getCellByColumnAndRow(2, $row)->getValue());
        $status = trim((string) $krsSheet->getCellByColumnAndRow(3, $row)->getValue());

        if ($nim === '' || $kodeMk === '') {
            continue;
        }

        Krs::updateOrCreate(
            ['nim' => $nim, 'kode_mk' => $kodeMk],
            ['status' => $status !== '' ? $status : 'Pending']
        );
        $krsCount++;
    }

    $nilaiCount = 0;
    $nilaiSheet = IOFactory::load($paths['nilai'])->getActiveSheet();
    $hasNamaDosen = Schema::hasColumn('nilais', 'nama_dosen');

    for ($row = 2; $row <= $nilaiSheet->getHighestRow(); $row++) {
        $nim = trim((string) $nilaiSheet->getCellByColumnAndRow(1, $row)->getValue());
        $kodeMk = trim((string) $nilaiSheet->getCellByColumnAndRow(2, $row)->getValue());

        if ($nim === '' || $kodeMk === '') {
            continue;
        }

        $kunciText = trim((string) $nilaiSheet->getCellByColumnAndRow(15, $row)->getValue());

        $payload = [
            'teamwork' => (int) $nilaiSheet->getCellByColumnAndRow(3, $row)->getValue(),
            'keaktifan' => (int) $nilaiSheet->getCellByColumnAndRow(4, $row)->getValue(),
            'laporan' => (int) $nilaiSheet->getCellByColumnAndRow(5, $row)->getValue(),
            'proyek' => (int) $nilaiSheet->getCellByColumnAndRow(6, $row)->getValue(),
            'tugas' => (int) $nilaiSheet->getCellByColumnAndRow(7, $row)->getValue(),
            'kuis' => (int) $nilaiSheet->getCellByColumnAndRow(8, $row)->getValue(),
            'uts' => (int) $nilaiSheet->getCellByColumnAndRow(9, $row)->getValue(),
            'uas' => (int) $nilaiSheet->getCellByColumnAndRow(10, $row)->getValue(),
            'nilai_akhir' => (float) $nilaiSheet->getCellByColumnAndRow(11, $row)->getValue(),
            'nilai_huruf' => $nilaiSheet->getCellByColumnAndRow(12, $row)->getValue(),
            'index_nilai' => (float) $nilaiSheet->getCellByColumnAndRow(13, $row)->getValue(),
            'status' => $nilaiSheet->getCellByColumnAndRow(14, $row)->getValue() ?: 'Pending',
            'kunci_nilai' => stripos($kunciText, 'terkunci') !== false && stripos($kunciText, 'belum') === false ? 1 : 0,
        ];

        if ($hasNamaDosen) {
            $payload['nama_dosen'] = DemoConfig::NAMA_DOSEN;
        }

        Nilai::updateOrCreate(
            ['nim' => $nim, 'kode_mk' => $kodeMk],
            $payload
        );
        $nilaiCount++;
    }

    PengaturanSistem::current();

    echo "Mahasiswa final : {$mhsFinal}\n";
    echo "Mahasiswa IF2B  : {$mhsIf2b}\n";
    echo "Mahasiswa export: {$mhsExport}\n";
    echo "KRS             : {$krsCount}\n";
    echo "Nilai           : {$nilaiCount}\n";
});

$password = Hash::make('12345678');

User::updateOrCreate(['role' => 'admin', 'email' => 'admin@gmail.com'], ['name' => 'Admin', 'password' => $password]);
User::updateOrCreate(['role' => 'kps', 'email' => 'kps@gmail.com'], ['name' => 'KPS', 'password' => $password]);
User::updateOrCreate(['role' => 'mahasiswa', 'nim' => DemoConfig::NIM_MHS_LOGIN], ['name' => 'Ananda Shadiva Wansa', 'password' => $password]);
User::updateOrCreate(['role' => 'dosen', 'nuptk' => DemoConfig::NUPTK_DOSEN], ['name' => DemoConfig::NAMA_DOSEN, 'password' => $password, 'status' => 'aktif']);
User::whereNull('role')->delete();

$tables = ['prodi', 'dosen', 'mahasiswa', 'mata_kuliahs', 'krs', 'nilais', 'users'];
foreach ($tables as $table) {
    echo str_pad($table, 14) . DB::table($table)->count() . "\n";
}

echo "=== RESTORE SELESAI ===\n";
