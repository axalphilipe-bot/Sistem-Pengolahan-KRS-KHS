<?php

namespace App\Imports;

use App\Models\MataKuliah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MatkulImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return MataKuliah::updateOrCreate(
            ['kode_mk' => $row['kode_mk']],
            [
                'nama_mk' => $row['nama_mk'],
                'sks' => $row['sks'],
                'dosen' => $row['dosen'],
                'kode_prodi' => $row['kode_prodi'],
                'semester' => $row['semester'],
                'jenis' => $row['jenis'],
            ]
        );
    }
}