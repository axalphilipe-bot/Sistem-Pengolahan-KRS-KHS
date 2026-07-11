<?php

namespace App\Exports;

use App\Models\MataKuliah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatkulExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected ?string $search = null,
        protected ?string $prodi = null,
        protected ?string $semester = null,
        protected ?string $jenis = null,
    ) {}

    public function collection(): Collection
    {
        return MataKuliah::with('prodi')
            ->when($this->search, function ($query) {
                $search = $this->search;
                $query->where(function ($q) use ($search) {
                    $q->where('kode_mk', 'like', "%{$search}%")
                        ->orWhere('nama_mk', 'like', "%{$search}%");
                });
            })
            ->when($this->prodi, fn ($q) => $q->where('kode_prodi', $this->prodi))
            ->when($this->semester, fn ($q) => $q->where('semester', $this->semester))
            ->when($this->jenis, fn ($q) => $q->where('jenis', $this->jenis))
            ->orderBy('kode_mk')
            ->get()
            ->map(function ($m) {
                return [
                    $m->kode_mk,
                    $m->nama_mk,
                    $m->sks,
                    $m->dosen,
                    $m->kode_prodi,
                    $m->prodi->nama_prodi ?? $m->kode_prodi,
                    $m->semester,
                    $m->jenis,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Kode MK',
            'Nama Mata Kuliah',
            'SKS',
            'Dosen',
            'Kode Prodi',
            'Program Studi',
            'Semester',
            'Jenis',
        ];
    }
}
