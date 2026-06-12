<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        return view('admin.mahasiswa', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.tambah_mahasiswa');
    }

    public function store(Request $request)
    {
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'jenjang' => $request->jenjang,
            'semester' => $request->semester,
            'kode_prodi' => $request->kode_prodi,
        ]);

        return redirect('/admin/mahasiswa');
    }
}