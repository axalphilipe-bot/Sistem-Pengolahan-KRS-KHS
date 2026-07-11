<?php

namespace App\Imports;

use App\Models\Nilai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiImport implements ToCollection
{
    protected $kodeMk;

    public function __construct($kodeMk)
    {
        $this->kodeMk = $kodeMk;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {
            $nim = trim((string) ($row[0] ?? ''));

            if ($nim === '') {
                continue;
            }

            $teamwork = (float) ($row[1] ?? 0);
            $keaktifan = (float) ($row[2] ?? 0);
            $laporan = (float) ($row[3] ?? 0);
            $proyek = (float) ($row[4] ?? 0);
            $tugas = (float) ($row[5] ?? 0);
            $kuis = (float) ($row[6] ?? 0);
            $uts = (float) ($row[7] ?? 0);
            $uas = (float) ($row[8] ?? 0);

            $nilaiAkhir =
                ($teamwork * 0.15) +
                ($keaktifan * 0.15) +
                ($laporan * 0.10) +
                ($proyek * 0.30) +
                ($tugas * 0.05) +
                ($kuis * 0.05) +
                ($uts * 0.10) +
                ($uas * 0.10);

            $grade = $this->konversiNilai($nilaiAkhir);

            Nilai::updateOrCreate(
                [
                    'nim' => $nim,
                    'kode_mk' => $this->kodeMk,
                ],
                [
                    'teamwork' => $teamwork,
                    'keaktifan' => $keaktifan,
                    'laporan' => $laporan,
                    'proyek' => $proyek,
                    'tugas' => $tugas,
                    'kuis' => $kuis,
                    'uts' => $uts,
                    'uas' => $uas,
                    'nilai_akhir' => round($nilaiAkhir, 2),
                    'nilai_huruf' => $grade['huruf'],
                    'index_nilai' => $grade['index'],
                    'status' => 'Pending',
                    'kunci_nilai' => 0,
                ]
            );
        }
    }

    private function konversiNilai(float $nilaiAkhir): array
    {
        if ($nilaiAkhir >= 85) {
            return ['huruf' => 'A', 'index' => 4.00];
        }

        if ($nilaiAkhir >= 80) {
            return ['huruf' => 'A-', 'index' => 3.75];
        }

        if ($nilaiAkhir >= 75) {
            return ['huruf' => 'B+', 'index' => 3.50];
        }

        if ($nilaiAkhir >= 70) {
            return ['huruf' => 'B', 'index' => 3.00];
        }

        if ($nilaiAkhir >= 65) {
            return ['huruf' => 'C+', 'index' => 2.50];
        }

        if ($nilaiAkhir >= 60) {
            return ['huruf' => 'C', 'index' => 2.00];
        }

        if ($nilaiAkhir >= 50) {
            return ['huruf' => 'D', 'index' => 1.00];
        }

        return ['huruf' => 'E', 'index' => 0.00];
    }
}
