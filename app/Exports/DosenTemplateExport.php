<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DosenTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '166558900007',
                'Contoh Nama Dosen',
                'contoh@polibatam.ac.id',
                'Lektor',
                'IF',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'nuptk',
            'nama',
            'email',
            'jabatan',
            'kode_prodi',
        ];
    }
}
