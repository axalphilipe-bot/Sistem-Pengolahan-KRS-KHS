<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'nuptk',
        'nama',
        'email',
        'jabatan',
        'kode_prodi'
    ];

    protected $primaryKey = 'nuptk';
    public $incrementing = false;
    protected $keyType = 'string';

    public function prodi()
    {
        return $this->belongsTo(
            Prodi::class,
            'kode_prodi',
            'kode_prodi'
        );
    }

    public function mahasiswaWali()
    {
        return $this->hasMany(
            Mahasiswa::class,
            'nuptk_wali',
            'nuptk'
        );
    }
}