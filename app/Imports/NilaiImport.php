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

            $nilaiAkhir =
                ($row[1] * 0.15) +
                ($row[2] * 0.15) +
                ($row[3] * 0.10) +
                ($row[4] * 0.30) +
                ($row[5] * 0.05) +
                ($row[6] * 0.05) +
                ($row[7] * 0.10) +
                ($row[8] * 0.10);

            if ($nilaiAkhir >= 85) {
                $huruf = 'A';
                $index = 4.00;
            } elseif ($nilaiAkhir >= 80) {
                $huruf = 'A-';
                $index = 3.75;
            } elseif ($nilaiAkhir >= 75) {
                $huruf = 'B+';
                $index = 3.50;
            } elseif ($nilaiAkhir >= 70) {
                $huruf = 'B';
                $index = 3.00;
            } elseif ($nilaiAkhir >= 65) {
                $huruf = 'C+';
                $index = 2.50;
            } elseif ($nilaiAkhir >= 60) {
                $huruf = 'C';
                $index = 2.00;
            } elseif ($nilaiAkhir >= 50) {
                $huruf = 'D';
                $index = 1.00;
            } else {
                $huruf = 'E';
                $index = 0.00;
            }

            Nilai::updateOrCreate(
    [
        'nim' => $row[0],
        'kode_mk' => $this->kodeMk
    ],
    [
        'teamwork' => $row[1],
        'keaktifan' => $row[2],
        'laporan' => $row[3],
        'proyek' => $row[4],
        'tugas' => $row[5],
        'kuis' => $row[6],
        'uts' => $row[7],
        'uas' => $row[8],
        'nilai_akhir' => $nilaiAkhir,
        'nilai_huruf' => $huruf,
        'index_nilai' => $index,

        'nama_dosen' => 'Hilda Widyastuti, S.T., M.T.'
    ]
);
        }
    }
}