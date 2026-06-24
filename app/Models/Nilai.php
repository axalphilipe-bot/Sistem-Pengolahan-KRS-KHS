<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

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
    'index_nilai',
    'nama_dosen'
];
    public function mahasiswa()
{
    return $this->belongsTo(
        Mahasiswa::class,
        'nim',
        'nim'
    );
}
public function matkul()
{
    return $this->belongsTo(
        MataKuliah::class,
        'kode_mk',
        'kode_mk'
    );
}
}

