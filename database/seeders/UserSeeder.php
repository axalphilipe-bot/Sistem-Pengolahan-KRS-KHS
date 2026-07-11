<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

 
        User::create([
            'name' => 'Mahasiswa 1',
            'nim' => '22101123',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Dosen 1',
            'nuptk' => '1987654321',
            'password' => Hash::make('12345678'),
            'role' => 'dosen',
            'status' => 'aktif',
        ]);
    }
}