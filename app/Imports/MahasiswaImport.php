<?php



namespace App\Imports;



use App\Models\Dosen;

use App\Models\Mahasiswa;

use App\Models\Prodi;

use Illuminate\Validation\ValidationException;

use Maatwebsite\Excel\Concerns\OnEachRow;

use Maatwebsite\Excel\Row;



class MahasiswaImport implements OnEachRow

{

    /** Alias kode prodi yang sering dipakai di Excel kampus. */

    private const PRODI_ALIASES = [

        'TI' => 'IF',

    ];



    public function onRow(Row $row): void

    {

        $row = $row->toArray();



        $nim = strtolower(trim((string) ($row[0] ?? '')));



        if (in_array($nim, ['nim', ''], true)) {

            return;

        }



        $kodeProdi = $this->normalizeKodeProdi($row[7] ?? '');

        $nuptkWali = $this->normalizeNuptkWali($row[8] ?? null);



        Mahasiswa::updateOrCreate(

            ['nim' => $row[0]],

            [

                'nama'         => $row[1],

                'email'        => $row[2],

                'kelas'        => $row[3],

                'kelas_huruf'  => $row[4] ?? null,

                'jenjang'      => $row[5] ?? 'D3',

                'semester'     => $row[6] ?? 1,

                'kode_prodi'   => $kodeProdi,

                'nuptk_wali'   => $nuptkWali,

            ]

        );

    }



    private function normalizeKodeProdi(?string $kode): string

    {

        $original = trim((string) $kode);

        $kode = strtoupper($original);

        $kode = self::PRODI_ALIASES[$kode] ?? $kode;



        if ($kode === '' || ! Prodi::where('kode_prodi', $kode)->exists()) {

            throw ValidationException::withMessages([

                'kode_prodi' => "Kode prodi '{$original}' tidak ditemukan. Gunakan kode yang terdaftar (IF, RPL, GM, AN, KS, TP, TRM, MTK).",

            ]);

        }



        return $kode;

    }



    private function normalizeNuptkWali(mixed $nuptk): ?string

    {

        $nuptk = trim((string) $nuptk);



        if ($nuptk === '' || strtolower($nuptk) === 'nuptk_wali') {

            return null;

        }



        if (! Dosen::where('nuptk', $nuptk)->exists()) {

            throw ValidationException::withMessages([

                'nuptk_wali' => "NUPTK dosen wali '{$nuptk}' tidak ditemukan.",

            ]);

        }



        return $nuptk;

    }

}


