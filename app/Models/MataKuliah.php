<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $primaryKey = 'kode_mk';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'dosen',
        'kode_prodi',
        'semester',
        'jenis'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
    public function krs()
{
    return $this->hasMany(
        Krs::class,
        'kode_mk',
        'kode_mk'
    );
}
}



