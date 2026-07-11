<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Nilai extends Model
{
    protected $table = 'nilais';

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
        'status',
        'kunci_nilai',
        'tanggal_kunci',
    ];

    protected $casts = [
        'kunci_nilai' => 'boolean',
    ];

    public static function isLockedValue(mixed $value): bool
    {
        return (int) $value === 1;
    }

    public function isLocked(): bool
    {
        return self::isLockedValue($this->kunci_nilai);
    }

    public function isPublished(): bool
    {
        return $this->status === 'Disetujui' && $this->isLocked();
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', 'Disetujui')
            ->where('kunci_nilai', 1);
    }

    public function scopeApprovedUnlocked($query)
    {
        return $query
            ->where('status', 'Disetujui')
            ->where(function ($q) {
                $q->where('kunci_nilai', 0)
                    ->orWhereNull('kunci_nilai');
            });
    }

    public static function isProdiFullyLocked(?string $kodeProdi): bool
    {
        if (! $kodeProdi) {
            return false;
        }

        $hasApproved = static::query()
            ->join('mahasiswa', 'nilais.nim', '=', 'mahasiswa.nim')
            ->where('mahasiswa.kode_prodi', $kodeProdi)
            ->where('nilais.status', 'Disetujui')
            ->exists();

        if (! $hasApproved) {
            return false;
        }

        return ! static::query()
            ->join('mahasiswa', 'nilais.nim', '=', 'mahasiswa.nim')
            ->where('mahasiswa.kode_prodi', $kodeProdi)
            ->where('nilais.status', 'Disetujui')
            ->where(function ($query) {
                $query->where('nilais.kunci_nilai', 0)
                    ->orWhereNull('nilais.kunci_nilai');
            })
            ->exists();
    }

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
