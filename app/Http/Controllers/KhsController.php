<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;

class KhsController extends Controller
{
    public function index()
    {
        // Sementara masih menggunakan NIM statis
        $nim = '3312511057';

        // Data mahasiswa
        $mahasiswa = Mahasiswa::with('prodi')
            ->where('nim', $nim)
            ->first();

        // Data nilai
        $nilai = Nilai::with('matkul')
            ->where('nim', $nim)
            ->get();

        // Total SKS
        $totalSks = $nilai->sum(function ($item) {
            return $item->matkul->sks ?? 0;
        });

        // IPS (sementara menggunakan rata-rata nilai akhir)
        $ips = $nilai->count()
            ? round($nilai->avg('nilai_akhir') / 25, 2)
            : 0;

        return view(
            'mahasiswa.khs',
            compact(
                'mahasiswa',
                'nilai',
                'totalSks',
                'ips'
            )
        );
    }
}