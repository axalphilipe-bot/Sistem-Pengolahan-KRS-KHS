<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanNilaiExport implements FromCollection
{
    public function collection()
    {
        return DB::table('nilais')
            ->join('mata_kuliahs', 'nilais.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->join('mahasiswa', 'nilais.nim', '=', 'mahasiswa.nim')
            ->join('prodi', 'mahasiswa.kode_prodi', '=', 'prodi.kode_prodi')
            ->where('nilais.status', 'Disetujui')
            ->select(
                'mata_kuliahs.nama_mk',
                'nilais.nama_dosen',
                'prodi.nama_prodi',
                'mata_kuliahs.semester',
                'nilais.kunci_nilai'
            )
            ->get();
    }
    public function headings(): array
{
    return [
        'Mata Kuliah',
        'Dosen',
        'Program Studi',
        'Semester',
        'Status'
    ];
}
}