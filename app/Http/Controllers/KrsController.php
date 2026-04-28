<?php

namespace App\Http\Controllers;     

use Illuminate\Http\Request;
use App\Models\MataKuliah;
class KrsController extends Controller
{
public function index(Request $request)
{
    $mataKuliah = [];

    if ($request->semester && $request->prodi) {
        $mataKuliah = MataKuliah::where('semester', $request->semester)
            ->where('prodi', $request->prodi)
            ->get();
    }

    return view('mahasiswa.krs', compact('mataKuliah'));
}
public function dashboard()
    {
        $matkul = \App\Models\MataKuliah::all();

        return view('dosen.dashboard', [
            'matkul' => $matkul,
            'jumlahKelas' => $matkul->count(),
            'totalMahasiswa' => 96,
            'krsDisetujui' => 84,
            'menunggu' => 17
        ]);
    }
}

