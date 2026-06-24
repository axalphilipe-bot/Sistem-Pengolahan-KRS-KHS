<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
    'nim',
    'nama',
    'email',
    'kelas',
    'kelas_huruf',
    'jenjang',
    'semester',
    'kode_prodi'
];
    
protected $primaryKey = 'nim';
public $incrementing = false;
protected $keyType = 'string';
    /*
    |--------------------------------------------------------------------------
    | RELASI PRODI
    |--------------------------------------------------------------------------
    */

    public function prodi()
{
    return $this->belongsTo(
        Prodi::class,
        'kode_prodi',
        'kode_prodi'
    );
}
public function nilai()
{
    return $this->hasOne(
        Nilai::class,
        'nim',
        'nim'
    );
}
public function krs()
{
    return $this->hasMany(
        Krs::class,
        'nim',
        'nim'
    );
}
}