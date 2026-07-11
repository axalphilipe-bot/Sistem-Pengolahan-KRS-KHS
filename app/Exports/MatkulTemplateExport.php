<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatkulTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                'IF101',
                'Contoh Mata Kuliah',
                '3',
                'Nama Dosen Pengampu',
                'IF',
                '1',
                'wajib',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'kode_mk',
            'nama_mk',
            'sks',
            'dosen',
            'kode_prodi',
            'semester',
            'jenis',
        ];
    }
}
