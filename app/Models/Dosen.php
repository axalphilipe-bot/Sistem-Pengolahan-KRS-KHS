<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'jabatan',
        'prodi_id'
    ];
protected $primaryKey = 'nidn';
public $incrementing = false;
protected $keyType = 'string';
    /*
    |--------------------------------------------------------------------------
    | RELASI PRODI
    |--------------------------------------------------------------------------
    */

     public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}