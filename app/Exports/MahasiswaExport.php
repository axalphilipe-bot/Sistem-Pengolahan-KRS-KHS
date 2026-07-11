<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected ?string $search = null,
        protected ?string $prodi = null
    ) {}

    public function collection(): Collection
    {
        return Mahasiswa::with('prodi')
            ->when($this->prodi, fn ($query) => $query->where('kode_prodi', $this->prodi))
            ->when($this->search, function ($query) {
                $search = $this->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nim', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('kode_prodi', 'like', "%{$search}%")
                        ->orWhere('kelas', 'like', "%{$search}%");
                });
            })
            ->orderBy('nim')
            ->get()
            ->map(function ($m) {
                return [
                    $m->nim,
                    $m->nama,
                    $m->email,
                    $m->kelas,
                    $m->kelas_huruf,
                    $m->jenjang,
                    $m->semester,
                    $m->kode_prodi,
                    $m->prodi->nama_prodi ?? $m->kode_prodi,
                    $m->nuptk_wali ?? '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Email',
            'Kelas',
            'Kelas Huruf',
            'Jenjang',
            'Semester',
            'Kode Prodi',
            'Program Studi',
            'NUPTK Wali',
        ];
    }
}
