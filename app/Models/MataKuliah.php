<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = [
    'kode',
    'nama',
    'sks',
    'semester',
    'jenis',
    'prodi',
    'dosen'
];
public function prodi()
{
    return $this->belongsTo(Prodi::class);
}
}


