<?php

namespace App\Services;

use App\Models\Krs;
use App\Models\Nilai;
use App\Support\DemoConfig;
use App\Support\DemoSidangVerificationResult;

class DemoSidangVerificationService
{
    private const EXPECTED_SEEDER_KRS = 162;

    private const EXPECTED_SEEDER_NILAI = 162;

    public function verify(): DemoSidangVerificationResult
    {
        $checks = [];
        $failedStudents = [];

        $scopeNims = DemoConfig::scopeNims();
        $seederNims = DemoConfig::seederNims();
        $demoNim = DemoConfig::NIM_MHS_LOGIN;
        $mataKuliah = DemoConfig::MATA_KULIAH_DEMO;

        $checks[] = $this->check(
            'Jumlah mahasiswa dalam scope demo',
            count($scopeNims) === DemoConfig::TOTAL_MHS,
            (string) DemoConfig::TOTAL_MHS,
            (string) count($scopeNims)
        );

        $demoKrsTotal = Krs::query()->where('nim', $demoNim)->count();
        $demoNilaiTotal = Nilai::query()->where('nim', $demoNim)->count();

        $checks[] = $this->check(
            'Demo user — total KRS',
            $demoKrsTotal === 0,
            '0',
            (string) $demoKrsTotal
        );

        $checks[] = $this->check(
            'Demo user — total nilai',
            $demoNilaiTotal === 0,
            '0',
            (string) $demoNilaiTotal
        );

        $seederKrsDisetujui = Krs::query()
            ->whereIn('nim', $seederNims)
            ->whereIn('kode_mk', $mataKuliah)
            ->where('status', 'Disetujui')
            ->count();

        $checks[] = $this->check(
            'Seeder — KRS Disetujui (6 MK × 27 mhs)',
            $seederKrsDisetujui === self::EXPECTED_SEEDER_KRS,
            (string) self::EXPECTED_SEEDER_KRS,
            (string) $seederKrsDisetujui
        );

        $seederKrsPending = Krs::query()
            ->whereIn('nim', $seederNims)
            ->whereIn('kode_mk', $mataKuliah)
            ->where('status', 'Pending')
            ->count();

        $checks[] = $this->check(
            'Seeder — KRS Pending (harus 0)',
            $seederKrsPending === 0,
            '0',
            (string) $seederKrsPending
        );

        $seederNilaiTotal = Nilai::query()
            ->whereIn('nim', $seederNims)
            ->whereIn('kode_mk', $mataKuliah)
            ->count();

        $checks[] = $this->check(
            'Seeder — total record nilai (6 MK × 27 mhs)',
            $seederNilaiTotal === self::EXPECTED_SEEDER_NILAI,
            (string) self::EXPECTED_SEEDER_NILAI,
            (string) $seederNilaiTotal
        );

        $seederNilaiPublished = Nilai::query()
            ->whereIn('nim', $seederNims)
            ->whereIn('kode_mk', $mataKuliah)
            ->where('status', 'Disetujui')
            ->where('kunci_nilai', 1)
            ->count();

        $checks[] = $this->check(
            'Seeder — nilai Disetujui & terkunci',
            $seederNilaiPublished === self::EXPECTED_SEEDER_NILAI,
            (string) self::EXPECTED_SEEDER_NILAI,
            (string) $seederNilaiPublished
        );

        $seederNilaiPending = Nilai::query()
            ->whereIn('nim', $seederNims)
            ->whereIn('kode_mk', $mataKuliah)
            ->where('status', 'Pending')
            ->count();

        $checks[] = $this->check(
            'Seeder — nilai Pending (harus 0)',
            $seederNilaiPending === 0,
            '0',
            (string) $seederNilaiPending
        );

        $seederNilaiUnlocked = Nilai::query()
            ->whereIn('nim', $seederNims)
            ->whereIn('kode_mk', $mataKuliah)
            ->where(function ($query) {
                $query->where('kunci_nilai', 0)
                    ->orWhereNull('kunci_nilai');
            })
            ->count();

        $checks[] = $this->check(
            'Seeder — nilai belum terkunci (harus 0)',
            $seederNilaiUnlocked === 0,
            '0',
            (string) $seederNilaiUnlocked
        );

        foreach ($seederNims as $nim) {
            $issues = $this->collectStudentIssues($nim, $mataKuliah);

            if ($issues !== []) {
                $failedStudents[] = [
                    'nim' => $nim,
                    'issues' => $issues,
                ];
            }
        }

        $checks[] = $this->check(
            'Seeder — setiap mahasiswa memenuhi target per-NIM',
            $failedStudents === [],
            '27/27 lengkap',
            $failedStudents === []
                ? '27/27 lengkap'
                : (string) (count($seederNims) - count($failedStudents)).'/'.count($seederNims).' lengkap'
        );

        $passed = collect($checks)->every(fn (array $check) => $check['passed']);

        return new DemoSidangVerificationResult(
            passed: $passed,
            checks: $checks,
            failedStudents: $failedStudents,
        );
    }

    /**
     * @param  string[]  $mataKuliah
     * @return string[]
     */
    private function collectStudentIssues(string $nim, array $mataKuliah): array
    {
        $issues = [];

        foreach ($mataKuliah as $kodeMk) {
            $krs = Krs::query()
                ->where('nim', $nim)
                ->where('kode_mk', $kodeMk)
                ->first();

            if (! $krs) {
                $issues[] = "KRS {$kodeMk} tidak ada";

                continue;
            }

            if ($krs->status !== 'Disetujui') {
                $issues[] = "KRS {$kodeMk} status {$krs->status} (harus Disetujui)";
            }

            $nilai = Nilai::query()
                ->where('nim', $nim)
                ->where('kode_mk', $kodeMk)
                ->first();

            if (! $nilai) {
                $issues[] = "Nilai {$kodeMk} tidak ada";

                continue;
            }

            if ($nilai->status !== 'Disetujui') {
                $issues[] = "Nilai {$kodeMk} status {$nilai->status} (harus Disetujui)";
            }

            if (! Nilai::isLockedValue($nilai->kunci_nilai)) {
                $issues[] = "Nilai {$kodeMk} belum terkunci";
            }
        }

        return $issues;
    }

    /**
     * @return array{label: string, passed: bool, expected: string, actual: string}
     */
    private function check(string $label, bool $passed, string $expected, string $actual): array
    {
        return [
            'label' => $label,
            'passed' => $passed,
            'expected' => $expected,
            'actual' => $actual,
        ];
    }
}
