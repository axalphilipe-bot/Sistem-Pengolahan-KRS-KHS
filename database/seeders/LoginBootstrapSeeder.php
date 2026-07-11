<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Support\DemoConfig;
use Illuminate\Database\Seeder;

class LoginBootstrapSeeder extends Seeder
{
    public function run(): void
    {
        Prodi::updateOrCreate(
            ['kode_prodi' => DemoConfig::KODE_PRODI],
            ['nama_prodi' => 'Teknik Informatika']
        );

        Dosen::updateOrCreate(
            ['nuptk' => DemoConfig::NUPTK_DOSEN],
            [
                'nama' => 'Cyntia Lasmi Andesti',
                'email' => 'cyntia.lasmi@polibatam.ac.id',
                'jabatan' => 'Lektor',
                'kode_prodi' => DemoConfig::KODE_PRODI,
            ]
        );

        Dosen::updateOrCreate(
            ['nuptk' => '1987654321'],
            [
                'nama' => 'Dosen 1',
                'email' => 'dosen1@polibatam.ac.id',
                'jabatan' => 'Lektor',
                'kode_prodi' => DemoConfig::KODE_PRODI,
            ]
        );

        Mahasiswa::updateOrCreate(
            ['nim' => DemoConfig::NIM_MHS_LOGIN],
            [
                'nama' => 'Ananda Shadiva Wansa',
                'email' => 'ananda.shadiva@student.polibatam.ac.id',
                'kelas' => DemoConfig::KELAS,
                'kelas_huruf' => DemoConfig::KELAS_HURUF,
                'jenjang' => 'D3',
                'semester' => 2,
                'kode_prodi' => DemoConfig::KODE_PRODI,
                'nuptk_wali' => DemoConfig::NUPTK_DOSEN,
            ]
        );

        Mahasiswa::updateOrCreate(
            ['nim' => '22101123'],
            [
                'nama' => 'Mahasiswa 1',
                'email' => 'mhs1@student.polibatam.ac.id',
                'kelas' => DemoConfig::KELAS,
                'kelas_huruf' => DemoConfig::KELAS_HURUF,
                'jenjang' => 'D3',
                'semester' => 2,
                'kode_prodi' => DemoConfig::KODE_PRODI,
                'nuptk_wali' => DemoConfig::NUPTK_DOSEN,
            ]
        );

        $this->command?->info('[LoginBootstrap] Prodi, dosen, dan mahasiswa dasar siap untuk login.');
    }
}
