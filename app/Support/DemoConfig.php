<?php

namespace App\Support;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder;

class DemoConfig
{
    public const NUPTK_DOSEN = '166558900112';

    public const NAMA_DOSEN = 'Cyntia Lasmi Andesti, S.Kom., M.Kom';

    public const NIM_MHS_LOGIN = '3312511057';

    public const KODE_PRODI = 'IF';

    public const KELAS = 'Reguler Malam';

    public const KELAS_HURUF = 'B';

    public const TOTAL_MHS = 28;

    public const MHS_PENDING = 20;

    public const MHS_DISETUJUI = 8;

    public const MHS_DENGAN_NILAI = 5;

    public const MHS_TANPA_NILAI = 3;

    /** Timestamp tetap untuk kunci nilai seeder sidang (deterministik). */
    public const SIDANG_LOCKED_AT = '2026-07-01 08:00:00';

    /** Paket mata kuliah demo kelas IF2B Reguler Malam (semester genap). */
    public const MATA_KULIAH_DEMO = [
        'IF102',
        'IF104',
        'IF106',
        'IF108',
        'IF110',
        'IF112',
    ];

    public static function mahasiswaWaliQuery(): Builder
    {
        return Mahasiswa::query()
            ->where('nuptk_wali', self::NUPTK_DOSEN)
            ->where('kode_prodi', self::KODE_PRODI)
            ->where('kelas', self::KELAS)
            ->where('kelas_huruf', self::KELAS_HURUF)
            ->orderBy('nim');
    }

    /**
     * @return string[]
     */
    public static function scopeNims(): array
    {
        return self::mahasiswaWaliQuery()
            ->limit(self::TOTAL_MHS)
            ->pluck('nim')
            ->all();
    }

    /**
     * Mahasiswa seeder sidang: seluruh scope demo kecuali akun yang didemokan live.
     *
     * @return string[]
     */
    public static function seederNims(): array
    {
        return array_values(array_filter(
            self::scopeNims(),
            fn (string $nim) => $nim !== self::NIM_MHS_LOGIN
        ));
    }

    /**
     * @return array{pending: string[], disetujui: string[]}
     */
    public static function splitMahasiswaByStatus(array $nims): array
    {
        $loginNim = self::NIM_MHS_LOGIN;
        $others = array_values(array_filter($nims, fn (string $nim) => $nim !== $loginNim));

        $disetujui = array_merge(
            [$loginNim],
            array_slice($others, 0, self::MHS_DISETUJUI - 1)
        );

        $pending = array_slice($others, self::MHS_DISETUJUI - 1, self::MHS_PENDING);

        return [
            'pending' => $pending,
            'disetujui' => $disetujui,
        ];
    }

    /**
     * Komponen nilai deterministik berdasarkan indeks mahasiswa dan mata kuliah.
     *
     * @return array{keaktifan: int, proyek: int, tugas: int, kuis: int, uts: int, uas: int}
     */
    public static function komponenNilaiDeterministik(int $studentIndex, int $mkIndex): array
    {
        $base = 62 + (($studentIndex * 3 + $mkIndex * 2) % 24);

        return [
            'keaktifan' => min(95, $base + 4),
            'proyek' => min(95, $base + 8),
            'tugas' => min(95, $base + 2),
            'kuis' => min(95, $base + 1),
            'uts' => min(95, $base + 6),
            'uas' => min(95, $base + 5),
        ];
    }

    public static function hitungNilaiAkhir(
        int $keaktifan,
        int $proyek,
        int $tugas,
        int $kuis,
        int $uts,
        int $uas
    ): float {
        return round(
            ($keaktifan * 0.15)
            + ($proyek * 0.35)
            + ($tugas * 0.10)
            + ($kuis * 0.10)
            + ($uts * 0.15)
            + ($uas * 0.15),
            2
        );
    }

    /**
     * @return array{huruf: string, index: float}
     */
    public static function konversiNilaiHuruf(float $nilaiAkhir): array
    {
        if ($nilaiAkhir >= 85) {
            return ['huruf' => 'A', 'index' => 4.0];
        }

        if ($nilaiAkhir >= 80) {
            return ['huruf' => 'A-', 'index' => 3.75];
        }

        if ($nilaiAkhir >= 75) {
            return ['huruf' => 'B+', 'index' => 3.5];
        }

        if ($nilaiAkhir >= 70) {
            return ['huruf' => 'B', 'index' => 3.0];
        }

        if ($nilaiAkhir >= 65) {
            return ['huruf' => 'C+', 'index' => 2.5];
        }

        if ($nilaiAkhir >= 60) {
            return ['huruf' => 'C', 'index' => 2.0];
        }

        if ($nilaiAkhir >= 50) {
            return ['huruf' => 'D', 'index' => 1.0];
        }

        return ['huruf' => 'E', 'index' => 0.0];
    }
}
