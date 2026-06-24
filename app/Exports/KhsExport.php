<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KhsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Nilai::with('mahasiswa')
            ->get()
            ->map(function ($item) {

                return [
                    $item->nim,
                    $item->mahasiswa->nama ?? '-',
                    $item->kode_mk,
                    $item->nilai_akhir,
                    $item->nilai_huruf,
                    $item->index_nilai,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Kode MK',
            'Nilai Akhir',
            'Nilai Huruf',
            'Index'
        ];
    }
}