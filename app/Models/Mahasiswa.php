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
    'kode_prodi',
    'nuptk_wali',
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

    public function dosenWali()
    {
        return $this->belongsTo(
            Dosen::class,
            'nuptk_wali',
            'nuptk'
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

    public static function forAuthenticatedUser(): ?self
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'mahasiswa' || empty($user->nim)) {
            return null;
        }

        $mahasiswa = static::with('prodi')
            ->where('nim', $user->nim)
            ->first();

        if (!$mahasiswa && !empty($user->email)) {
            $mahasiswa = static::with('prodi')
                ->where('email', $user->email)
                ->first();
        }

        if (!$mahasiswa) {
            $kodeProdi = Prodi::query()->value('kode_prodi');

            if (!$kodeProdi) {
                return null;
            }

            $mahasiswa = static::create([
                'nim' => $user->nim,
                'nama' => mb_substr($user->name, 0, 50),
                'email' => mb_substr($user->email ?? ($user->nim . '@polibatam.ac.id'), 0, 100),
                'kelas' => mb_substr($user->kelas ?? 'TI-3A', 0, 10),
                'jenjang' => 'D4',
                'semester' => 5,
                'kode_prodi' => $kodeProdi,
            ]);

            $mahasiswa->load('prodi');
        }

        return $mahasiswa;
    }
}