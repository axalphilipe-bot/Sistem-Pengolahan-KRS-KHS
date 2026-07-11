<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\PengaturanSistem;
use App\Support\DemoConfig;
use Illuminate\Database\Seeder;

class DemoMasterDataSeeder extends Seeder
{
    /** @var array<string, array{0: string, 1: int}> */
    private const MATA_KULIAH = [
        'IF102' => ['Struktur Data', 3],
        'IF104' => ['Pemrograman Web', 3],
        'IF106' => ['Jaringan Komputer', 3],
        'IF108' => ['Pemrograman Python', 3],
        'IF110' => ['Data Mining', 3],
        'IF112' => ['Keamanan Sistem', 3],
    ];

    public function run(): void
    {
        PengaturanSistem::current();

        foreach (self::MATA_KULIAH as $kodeMk => [$namaMk, $sks]) {
            MataKuliah::updateOrCreate(
                ['kode_mk' => $kodeMk],
                [
                    'nama_mk' => $namaMk,
                    'sks' => $sks,
                    'dosen' => DemoConfig::NAMA_DOSEN,
                    'kode_prodi' => DemoConfig::KODE_PRODI,
                    'semester' => 'genap',
                    'jenis' => 'wajib',
                ]
            );
        }

        $this->seedMahasiswaKelasDemo();

        $this->command?->info(
            '[DemoMasterData] '
            . MataKuliah::count() . ' mata kuliah, '
            . Mahasiswa::count() . ' mahasiswa.'
        );
    }

    private function seedMahasiswaKelasDemo(): void
    {
        $startNim = 3312511030;
        $endNim = 3312511057;

        for ($nim = $startNim; $nim <= $endNim; $nim++) {
            $nimStr = (string) $nim;
            $nama = $nimStr === DemoConfig::NIM_MHS_LOGIN
                ? 'Ananda Shadiva Wansa'
                : 'Mahasiswa ' . substr($nimStr, -2);

            Mahasiswa::updateOrCreate(
                ['nim' => $nimStr],
                [
                    'nama' => $nama,
                    'email' => strtolower($nimStr) . '@student.polibatam.ac.id',
                    'kelas' => DemoConfig::KELAS,
                    'kelas_huruf' => DemoConfig::KELAS_HURUF,
                    'jenjang' => 'D3',
                    'semester' => 2,
                    'kode_prodi' => DemoConfig::KODE_PRODI,
                    'nuptk_wali' => DemoConfig::NUPTK_DOSEN,
                ]
            );
        }
    }
}
