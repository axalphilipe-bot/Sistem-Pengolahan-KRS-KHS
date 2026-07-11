<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return Dosen::updateOrCreate(
            ['nuptk' => $row['nuptk']],
            [
                'nama' => $row['nama'],
                'email' => $row['email'],
                'jabatan' => $row['jabatan'],
                'kode_prodi' => $row['kode_prodi'],
            ]
        );
    }
}