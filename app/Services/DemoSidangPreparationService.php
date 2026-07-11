<?php

namespace App\Services;

use App\Models\Krs;
use App\Models\Nilai;
use App\Support\DemoConfig;
use Illuminate\Support\Facades\DB;

class DemoSidangPreparationService
{
    /**
     * @return array{krs_reset: int, nilai_reset: int, krs_upserted: int, nilai_upserted: int}
     */
    public function prepare(): array
    {
        return DB::transaction(function () {
            $demoNim = DemoConfig::NIM_MHS_LOGIN;
            $seederNims = DemoConfig::seederNims();
            $mataKuliah = DemoConfig::MATA_KULIAH_DEMO;

            $krsReset = Krs::query()->where('nim', $demoNim)->delete();
            $nilaiReset = Nilai::query()->where('nim', $demoNim)->delete();

            $krsUpserted = 0;
            $nilaiUpserted = 0;

            foreach ($seederNims as $studentIndex => $nim) {
                foreach ($mataKuliah as $mkIndex => $kodeMk) {
                    Krs::query()->updateOrCreate(
                        ['nim' => $nim, 'kode_mk' => $kodeMk],
                        ['status' => 'Disetujui']
                    );
                    $krsUpserted++;

                    $komponen = DemoConfig::komponenNilaiDeterministik($studentIndex, $mkIndex);
                    $nilaiAkhir = DemoConfig::hitungNilaiAkhir(...array_values($komponen));
                    $konversi = DemoConfig::konversiNilaiHuruf($nilaiAkhir);

                    Nilai::query()->updateOrCreate(
                        ['nim' => $nim, 'kode_mk' => $kodeMk],
                        [
                            'teamwork' => $komponen['keaktifan'],
                            'keaktifan' => $komponen['keaktifan'],
                            'laporan' => $komponen['tugas'],
                            'proyek' => $komponen['proyek'],
                            'tugas' => $komponen['tugas'],
                            'kuis' => $komponen['kuis'],
                            'uts' => $komponen['uts'],
                            'uas' => $komponen['uas'],
                            'nilai_akhir' => $nilaiAkhir,
                            'nilai_huruf' => $konversi['huruf'],
                            'index_nilai' => $konversi['index'],
                            'status' => 'Disetujui',
                            'kunci_nilai' => 1,
                            'tanggal_kunci' => DemoConfig::SIDANG_LOCKED_AT,
                        ]
                    );
                    $nilaiUpserted++;
                }
            }

            return [
                'krs_reset' => $krsReset,
                'nilai_reset' => $nilaiReset,
                'krs_upserted' => $krsUpserted,
                'nilai_upserted' => $nilaiUpserted,
            ];
        });
    }
}
