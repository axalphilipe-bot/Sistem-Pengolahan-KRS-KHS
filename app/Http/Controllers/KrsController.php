<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Krs;

class KrsController extends Controller
{
    public function index(Request $request)
    {
        $mataKuliah = [];

        if ($request->semester && $request->prodi) {
            $mataKuliah = MataKuliah::where('semester', $request->semester)
                ->where('kode_prodi', $request->prodi)
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

    public function store(Request $request)
    {
        if (!$request->has('mata_kuliah')) {
            return back()->with('error', 'Pilih mata kuliah terlebih dahulu');
        }

        $nim = '3312511057';

        foreach ($request->mata_kuliah as $kodeMk) {

            Krs::create([
                'nim' => $nim,
                'kode_mk' => $kodeMk
            ]);
        }

        return back()->with('success', 'KRS berhasil disimpan');
    }
}