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
        'semester',
        'prodi_id'
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
}