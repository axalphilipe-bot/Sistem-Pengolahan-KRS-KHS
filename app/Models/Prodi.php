<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    protected $fillable = [
        'kode_prodi',
        'nama_prodi'
    ];
protected $primaryKey = 'kode_prodi';
public $incrementing = false;
protected $keyType = 'string';
    public function mahasiswa()
{
    return $this->hasMany(
        Mahasiswa::class,
        'kode_prodi',
        'kode_prodi'
    );
}

public function dosen()
{
    return $this->hasMany(
        Dosen::class,
        'kode_prodi',
        'kode_prodi'
    );
}

    public function matkul()
    {
        return $this->hasMany(MataKuliah::class);
    }
}