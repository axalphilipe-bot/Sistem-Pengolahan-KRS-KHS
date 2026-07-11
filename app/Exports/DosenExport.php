<?php

namespace App\Exports;

use App\Models\Dosen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DosenExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected ?string $search = null
    ) {}

    public function collection(): Collection
    {
        return Dosen::with('prodi')
            ->when($this->search, function ($query) {
                $search = $this->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nuptk', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('kode_prodi', 'like', "%{$search}%")
                        ->orWhere('jabatan', 'like', "%{$search}%");
                });
            })
            ->orderBy('nuptk')
            ->get()
            ->map(function ($d) {
                return [
                    $d->nuptk,
                    $d->nama,
                    $d->email,
                    $d->jabatan,
                    $d->kode_prodi,
                    $d->prodi->nama_prodi ?? $d->kode_prodi,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NUPTK',
            'Nama',
            'Email',
            'Jabatan',
            'Kode Prodi',
            'Program Studi',
        ];
    }
}
