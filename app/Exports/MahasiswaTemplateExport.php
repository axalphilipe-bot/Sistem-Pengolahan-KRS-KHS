<?php



namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\WithHeadings;



class MahasiswaTemplateExport implements FromArray, WithHeadings

{

    public function array(): array

    {

        return [

            [

                '3312511001',

                'Contoh Nama Mahasiswa',

                'contoh@student.polibatam.ac.id',

                'Reguler Malam',

                'A',

                'D3',

                '2',

                'IF',

                '166558900112',

            ],

        ];

    }



    public function headings(): array

    {

        return [

            'nim',

            'nama',

            'email',

            'kelas',

            'kelas_huruf',

            'jenjang',

            'semester',

            'kode_prodi',

            'nuptk_wali',

        ];

    }

}


