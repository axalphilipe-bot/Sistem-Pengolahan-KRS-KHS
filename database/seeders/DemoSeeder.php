<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Support\DemoConfig;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->command?->info('=== Memulai seed data demo IF2B Reguler Malam ===');

        $this->call([
            DemoDataValidatorSeeder::class,
            DemoMahasiswaSeeder::class,
            DemoKrsSeeder::class,
            DemoNilaiSeeder::class,
        ]);

        $this->tampilkanRingkasan();

        $this->command?->info('=== Seed data demo selesai ===');
    }

    private function tampilkanRingkasan(): void
    {
        $nims = DemoConfig::mahasiswaWaliQuery()
            ->limit(DemoConfig::TOTAL_MHS)
            ->pluck('nim');

        $krsPending = Krs::whereIn('nim', $nims)
            ->whereIn('kode_mk', DemoConfig::MATA_KULIAH_DEMO)
            ->where('status', 'Pending')
            ->count();

        $krsDisetujui = Krs::whereIn('nim', $nims)
            ->whereIn('kode_mk', DemoConfig::MATA_KULIAH_DEMO)
            ->where('status', 'Disetujui')
            ->count();

        $nilaiCount = Nilai::whereIn('nim', $nims)
            ->whereIn('kode_mk', DemoConfig::MATA_KULIAH_DEMO)
            ->count();

        $mahasiswaBimbingan = Mahasiswa::where('nuptk_wali', DemoConfig::NUPTK_DOSEN)->count();

        $this->command?->info('--- Ringkasan Demo ---');
        $this->command?->info("Mahasiswa bimbingan : {$mahasiswaBimbingan}");
        $this->command?->info("KRS Pending        : {$krsPending}");
        $this->command?->info("KRS Disetujui      : {$krsDisetujui}");
        $this->command?->info("Record nilai demo  : {$nilaiCount}");
        $this->command?->info('Mata kuliah demo   : ' . implode(', ', DemoConfig::MATA_KULIAH_DEMO));
    }
}
