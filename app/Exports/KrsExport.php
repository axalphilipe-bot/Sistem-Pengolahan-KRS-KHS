<?php

namespace App\Exports;

use App\Models\Krs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KrsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Krs::select(
            'nim',
            'kode_mk',
            'status',
            'created_at'
        )
        ->get()
        ->map(function ($item) {
            return [
                "'" . $item->nim,
                $item->kode_mk,
                $item->status,
                $item->created_at->format('d-m-Y H:i:s')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Kode MK',
            'Status',
            'Tanggal'
        ];
    }
}