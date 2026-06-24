<?php

namespace App\Http\Controllers;

use App\Models\Nilai;

class KhsController extends Controller
{
    public function index()
    {
        $nim = '3312511057'; // sementara dulu

        $nilai = Nilai::with('matkul')
            ->where('nim', $nim)
            ->get();

        return view(
            'mahasiswa.khs',
            compact('nilai')
        );
    }


}