<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class DosenController extends Controller
{
    public function dashboard()
{
    $matkul = MataKuliah::all();

    return view('dosen.dashboard', [
        'jumlahKelas' => $matkul->count(),
        'totalMahasiswa' => 96,
        'krsDisetujui' => 84,
        'menunggu' => 17,
        'matkul' => $matkul
    ]);
}

    public function kelas()
    {
        return view('dosen.kelas');
    }

    public function validasi()
    {
        return view('dosen.validasi');
    }

    public function detailKelas($kode)
    {
        $matkul = MataKuliah::where('kode', $kode)->first();

        return view('dosen.detail_kelas', compact('matkul'));
    }

    public function inputNilai($kode)
    {
        $matkul = MataKuliah::where('kode_mk', $kode)->first();

        return view('dosen.input_nilai', compact('matkul'));
    }
}