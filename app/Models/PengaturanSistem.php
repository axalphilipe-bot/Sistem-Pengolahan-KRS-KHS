<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSistem extends Model
{
    protected $table = 'pengaturan_sistem';

    protected $fillable = [
        'nama_sistem',
        'nama_institusi',
        'tahun_akademik',
        'semester_aktif',
        'maks_sks',
        'batas_krs',
        'status_sistem',
    ];

    protected $casts = [
        'batas_krs' => 'date',
        'maks_sks' => 'integer',
    ];

    public static function current(): self
    {
        return static::firstOrCreate([], [
            'nama_sistem' => 'Sistem KRS & KHS',
            'nama_institusi' => 'Politeknik Negeri Batam',
            'tahun_akademik' => '2025/2026',
            'semester_aktif' => 'Genap',
            'maks_sks' => 24,
            'batas_krs' => null,
            'status_sistem' => 'aktif',
        ]);
    }
}
