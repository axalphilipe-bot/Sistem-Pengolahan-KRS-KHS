<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMatkul = MataKuliah::count();
        $totalKrs = Krs::count();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMatkul',
            'totalKrs'
        ));
    }
    public function pengguna()
{
    $users = User::all();

    $totalUser = User::count();
    $totalAdmin = User::where('role','admin')->count();
    $totalDosen = User::where('role','dosen')->count();
    $totalMahasiswa = User::where('role','mahasiswa')->count();

    return view(
        'admin.pengguna',
        compact(
            'users',
            'totalUser',
            'totalAdmin',
            'totalDosen',
            'totalMahasiswa'
        )
    );
}
}