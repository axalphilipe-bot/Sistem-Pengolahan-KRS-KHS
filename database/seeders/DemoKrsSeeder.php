<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Support\DemoConfig;
use Illuminate\Database\Seeder;
use RuntimeException;

class DemoKrsSeeder extends Seeder
{
    public function run(): void
    {
        $nims = DemoConfig::mahasiswaWaliQuery()
            ->limit(DemoConfig::TOTAL_MHS)
            ->pluck('nim')
            ->all();

        if (count($nims) < DemoConfig::TOTAL_MHS) {
            throw new RuntimeException(
                '[DemoKrs] Gagal: hanya ditemukan ' . count($nims)
                . ' mahasiswa demo, dibutuhkan ' . DemoConfig::TOTAL_MHS . '.'
            );
        }

        $groups = DemoConfig::splitMahasiswaByStatus($nims);

        if (count($groups['pending']) !== DemoConfig::MHS_PENDING) {
            throw new RuntimeException(
                '[DemoKrs] Gagal: pembagian Pending tidak sesuai ('
                . count($groups['pending']) . ' dari ' . DemoConfig::MHS_PENDING . ').'
            );
        }

        if (count($groups['disetujui']) !== DemoConfig::MHS_DISETUJUI) {
            throw new RuntimeException(
                '[DemoKrs] Gagal: pembagian Disetujui tidak sesuai ('
                . count($groups['disetujui']) . ' dari ' . DemoConfig::MHS_DISETUJUI . ').'
            );
        }

        $pendingCount = 0;
        $disetujuiCount = 0;

        foreach ($groups['pending'] as $nim) {
            foreach (DemoConfig::MATA_KULIAH_DEMO as $kodeMk) {
                Krs::updateOrCreate(
                    ['nim' => $nim, 'kode_mk' => $kodeMk],
                    ['status' => 'Pending']
                );
                $pendingCount++;
            }
        }

        foreach ($groups['disetujui'] as $nim) {
            foreach (DemoConfig::MATA_KULIAH_DEMO as $kodeMk) {
                Krs::updateOrCreate(
                    ['nim' => $nim, 'kode_mk' => $kodeMk],
                    ['status' => 'Disetujui']
                );
                $disetujuiCount++;
            }
        }

        $this->command?->info(
            "[DemoKrs] KRS demo: {$pendingCount} Pending, {$disetujuiCount} Disetujui "
            . '(' . DemoConfig::MHS_PENDING . ' + ' . DemoConfig::MHS_DISETUJUI . ' mahasiswa).'
        );
    }
}
