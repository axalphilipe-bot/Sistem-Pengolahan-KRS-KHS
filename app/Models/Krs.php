<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'nim',
        'kode_mk',
        'status'
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(
            Mahasiswa::class,
            'nim',
            'nim'
        );
    }

    // Relasi ke Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(
            MataKuliah::class,
            'kode_mk',
            'kode_mk'
        );
    }
}