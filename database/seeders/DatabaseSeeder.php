<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\DemoConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        $password = Hash::make('12345678');

        User::updateOrCreate(
            ['role' => 'kps', 'email' => 'kps@gmail.com'],
            ['name' => 'KPS', 'password' => $password]
        );

        User::updateOrCreate(
            ['role' => 'mahasiswa', 'nim' => DemoConfig::NIM_MHS_LOGIN],
            ['name' => 'Ananda Shadiva Wansa', 'password' => $password]
        );

        User::updateOrCreate(
            ['role' => 'dosen', 'nuptk' => DemoConfig::NUPTK_DOSEN],
            ['name' => DemoConfig::NAMA_DOSEN, 'password' => $password, 'status' => 'aktif']
        );

        $this->call(LoginBootstrapSeeder::class);

        User::whereNull('role')->delete();

        // Restore data asli dari backup Excel (Desktop/Downloads):
        // php restore_master_data.php
    }
}
