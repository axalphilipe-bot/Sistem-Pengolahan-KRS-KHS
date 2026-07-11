<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Support\DemoConfig;
use Illuminate\Database\Seeder;

class DemoMahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $this->assignPengampuMataKuliahDemo();
        $this->normalisasiMahasiswaBimbingan();
        $this->pastikanMahasiswaLogin();

        $this->command?->info('[DemoMahasiswa] Pengampu MK demo & data mahasiswa siap.');
    }

    /**
     * Hanya mengubah pengampu pada paket MK demo IF2B Reguler Malam.
     * Mata kuliah di luar scope demo tidak disentuh.
     */
    private function assignPengampuMataKuliahDemo(): void
    {
        foreach (DemoConfig::MATA_KULIAH_DEMO as $kodeMk) {
            MataKuliah::updateOrCreate(
                ['kode_mk' => $kodeMk],
                ['dosen' => DemoConfig::NAMA_DOSEN]
            );
        }

        $this->command?->info(
            '[DemoMahasiswa] Pengampu diperbarui untuk '
            . count(DemoConfig::MATA_KULIAH_DEMO)
            . ' mata kuliah demo: '
            . implode(', ', DemoConfig::MATA_KULIAH_DEMO)
        );
    }

    private function normalisasiMahasiswaBimbingan(): void
    {
        $updated = 0;

        DemoConfig::mahasiswaWaliQuery()
            ->where(function ($query) {
                $query->whereNull('nuptk_wali')
                    ->orWhere('nuptk_wali', '!=', DemoConfig::NUPTK_DOSEN);
            })
            ->each(function (Mahasiswa $mahasiswa) use (&$updated) {
                $mahasiswa->update(['nuptk_wali' => DemoConfig::NUPTK_DOSEN]);
                $updated++;
            });

        if ($updated > 0) {
            $this->command?->info("[DemoMahasiswa] {$updated} mahasiswa dinormalisasi ke wali demo.");
        }
    }

    private function pastikanMahasiswaLogin(): void
    {
        $existing = Mahasiswa::where('nim', DemoConfig::NIM_MHS_LOGIN)->first();

        Mahasiswa::updateOrCreate(
            ['nim' => DemoConfig::NIM_MHS_LOGIN],
            [
                'nama' => $existing?->nama ?? 'Ananda Shadiva Wansa',
                'email' => $existing?->email ?? 'ananda.shadiva@student.polibatam.ac.id',
                'kelas' => DemoConfig::KELAS,
                'kelas_huruf' => DemoConfig::KELAS_HURUF,
                'jenjang' => $existing?->jenjang ?? 'D3',
                'semester' => $existing?->semester ?? 2,
                'kode_prodi' => DemoConfig::KODE_PRODI,
                'nuptk_wali' => DemoConfig::NUPTK_DOSEN,
            ]
        );
    }
}
