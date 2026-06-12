<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilais';

    protected $primaryKey = 'nim';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'kode_mk',
        'teamwork',
        'keaktifan',
        'laporan',
        'proyek',
        'tugas',
        'kuis',
        'uts',
        'uas',
        'nilai_akhir',
        'nilai_huruf',
        'index_nilai'
    ];
}