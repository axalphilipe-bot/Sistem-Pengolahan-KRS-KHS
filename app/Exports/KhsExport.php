<?php

namespace App\Exports;

use App\Models\Nilai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KhsExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected ?string $search = null,
        protected ?string $nilaiHuruf = null,
    ) {}

    public function collection(): Collection
    {
        $query = Nilai::with(['mahasiswa', 'matkul']);

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhereHas('mahasiswa', function ($m) use ($search) {
                        $m->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        if ($this->nilaiHuruf) {
            $query->where('nilai_huruf', 'like', $this->nilaiHuruf . '%');
        }

        return $query->latest()->get()->map(function ($item) {
            return [
                $item->nim,
                $item->mahasiswa->nama ?? '-',
                $item->kode_mk,
                $item->matkul->nama_mk ?? '-',
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
            'Mata Kuliah',
            'Nilai Akhir',
            'Nilai Huruf',
            'Index',
        ];
    }
}
