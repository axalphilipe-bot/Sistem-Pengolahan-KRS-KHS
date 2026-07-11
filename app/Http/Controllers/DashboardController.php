<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Krs;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMatkul = MataKuliah::count();
        $totalKrs = Krs::count();
        $krsPending = Krs::where('status', 'Pending')->count();
        $krsDisetujui = Krs::where('status', 'Disetujui')->count();

        $recentKrs = Krs::with(['mahasiswa', 'mataKuliah'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMatkul',
            'totalKrs',
            'krsPending',
            'krsDisetujui',
            'recentKrs'
        ));
    }
}