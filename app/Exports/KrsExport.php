<?php

namespace App\Exports;

use App\Models\Krs;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KrsExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected ?string $search = null,
        protected ?string $status = null,
    ) {}

    public function collection(): Collection
    {
        $query = Krs::with(['mahasiswa', 'mataKuliah']);

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhereHas('mahasiswa', function ($m) use ($search) {
                        $m->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->latest()->get()->map(function ($item) {
            return [
                $item->nim,
                $item->mahasiswa->nama ?? '-',
                $item->kode_mk,
                $item->mataKuliah->nama_mk ?? '-',
                $item->status,
                $item->created_at->format('d-m-Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Kode MK',
            'Mata Kuliah',
            'Status',
            'Tanggal',
        ];
    }
}
