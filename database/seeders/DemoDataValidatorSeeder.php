<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Support\DemoConfig;
use Illuminate\Database\Seeder;
use RuntimeException;

class DemoDataValidatorSeeder extends Seeder
{
    public function run(): void
    {
        $this->validateAkunLogin();
        $this->validateDosen();
        $this->validateMahasiswa();
        $this->validateMataKuliahDemo();

        $this->command?->info('[DemoDataValidator] Semua prasyarat data demo terpenuhi.');
    }

    private function validateAkunLogin(): void
    {
        if (! User::where('role', 'admin')->exists()) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: akun Admin tidak ditemukan. Buat user dengan role admin terlebih dahulu.'
            );
        }

        if (! User::where('role', 'kps')->exists()) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: akun KPS tidak ditemukan. Buat user dengan role kps terlebih dahulu.'
            );
        }

        $dosenUser = User::where('role', 'dosen')
            ->where('nuptk', DemoConfig::NUPTK_DOSEN)
            ->first();

        if (! $dosenUser) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: akun dosen demo (NUPTK '
                . DemoConfig::NUPTK_DOSEN
                . ') tidak ditemukan.'
            );
        }

        if ($dosenUser->name !== DemoConfig::NAMA_DOSEN) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: nama user dosen demo harus "' . DemoConfig::NAMA_DOSEN
                . '", ditemukan "' . $dosenUser->name . '".'
            );
        }

        $mahasiswaUser = User::where('role', 'mahasiswa')
            ->where('nim', DemoConfig::NIM_MHS_LOGIN)
            ->first();

        if (! $mahasiswaUser) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: akun mahasiswa demo (NIM '
                . DemoConfig::NIM_MHS_LOGIN
                . ') tidak ditemukan.'
            );
        }
    }

    private function validateDosen(): void
    {
        if (! Dosen::where('nuptk', DemoConfig::NUPTK_DOSEN)->exists()) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: data dosen NUPTK '
                . DemoConfig::NUPTK_DOSEN
                . ' tidak ditemukan di tabel dosen.'
            );
        }
    }

    private function validateMahasiswa(): void
    {
        $jumlahBimbingan = DemoConfig::mahasiswaWaliQuery()->count();

        if ($jumlahBimbingan < DemoConfig::TOTAL_MHS) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: ditemukan ' . $jumlahBimbingan
                . ' mahasiswa bimbingan IF2B Reguler Malam, dibutuhkan '
                . DemoConfig::TOTAL_MHS
                . '. Import Excel mahasiswa terlebih dahulu.'
            );
        }

        if (! Mahasiswa::where('nim', DemoConfig::NIM_MHS_LOGIN)->exists()) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: data akademik mahasiswa demo NIM '
                . DemoConfig::NIM_MHS_LOGIN
                . ' tidak ditemukan di tabel mahasiswa.'
            );
        }
    }

    private function validateMataKuliahDemo(): void
    {
        $existing = MataKuliah::whereIn('kode_mk', DemoConfig::MATA_KULIAH_DEMO)
            ->pluck('kode_mk')
            ->all();

        $missing = array_diff(DemoConfig::MATA_KULIAH_DEMO, $existing);

        if ($missing !== []) {
            throw new RuntimeException(
                '[DemoDataValidator] Gagal: mata kuliah demo belum lengkap. Tidak ditemukan: '
                . implode(', ', $missing)
            );
        }
    }
}
