<?php

namespace Database\Seeders;

use App\Support\DemoConfig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoNilaiSeeder extends Seeder
{
    public function run(): void
    {
        $nims = DemoConfig::mahasiswaWaliQuery()
            ->limit(DemoConfig::TOTAL_MHS)
            ->pluck('nim')
            ->all();

        $groups = DemoConfig::splitMahasiswaByStatus($nims);
        $denganNilai = array_slice($groups['disetujui'], 0, DemoConfig::MHS_DENGAN_NILAI);
        $tanpaNilai = array_slice($groups['disetujui'], DemoConfig::MHS_DENGAN_NILAI);

        $nilaiCount = 0;

        foreach ($denganNilai as $index => $nim) {
            // Tabel nilais memakai PRIMARY KEY (nim) — satu record per mahasiswa.
            // Sebar nilai ke MK demo berbeda agar tiap kelas punya contoh terisi.
            $kodeMk = DemoConfig::MATA_KULIAH_DEMO[$index % count(DemoConfig::MATA_KULIAH_DEMO)];
            $komponen = DemoConfig::komponenNilaiDeterministik($index, 0);
            $nilaiAkhir = DemoConfig::hitungNilaiAkhir(...array_values($komponen));
            $konversi = DemoConfig::konversiNilaiHuruf($nilaiAkhir);

            $this->upsertNilai($nim, $kodeMk, [
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
                'status' => 'Pending',
                'kunci_nilai' => 0,
            ]);

            $nilaiCount++;
        }

        $this->command?->info(
            '[DemoNilai] ' . $nilaiCount . ' nilai dibuat/diperbarui untuk '
            . count($denganNilai) . ' mahasiswa (1 record per NIM). '
            . count($tanpaNilai) . ' mahasiswa Disetujui tanpa nilai (form kosong untuk demo input).'
        );
    }

    /**
     * Upsert berdasarkan NIM — sesuai PRIMARY KEY tabel nilais di database.
     */
    private function upsertNilai(string $nim, string $kodeMk, array $data): void
    {
        $now = now();
        $payload = array_merge($data, [
            'kode_mk' => $kodeMk,
            'updated_at' => $now,
        ]);

        $exists = DB::table('nilais')->where('nim', $nim)->exists();

        if ($exists) {
            DB::table('nilais')->where('nim', $nim)->update($payload);

            return;
        }

        DB::table('nilais')->insert(array_merge(
            ['nim' => $nim],
            $payload,
            ['created_at' => $now]
        ));
    }
}
