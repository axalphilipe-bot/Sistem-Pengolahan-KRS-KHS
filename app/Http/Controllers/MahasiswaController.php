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
        'kelas_huruf' => $request->kelas_huruf,
        'jenjang' => $request->jenjang,
        'semester' => $request->semester,
        'kode_prodi' => $request->kode_prodi,
    ]);

    return redirect('/admin/mahasiswa');
}
   public function show($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);

    return view(
        'admin.detail_mahasiswa',
        compact('mahasiswa')
    );
}

public function edit($nim)
{
    $mahasiswa = Mahasiswa::findOrFail($nim);

    return view(
        'admin.edit_mahasiswa',
        compact('mahasiswa')
    );
}

public function update(Request $request, $nim)
{
    $mahasiswa = Mahasiswa::findOrFail($nim);

    $mahasiswa->update([
    'nim' => $request->nim,
    'nama' => $request->nama,
    'email' => $request->email,
    'kelas' => $request->kelas,
    'kelas_huruf' => $request->kelas_huruf,
    'jenjang' => $request->jenjang,
    'semester' => $request->semester,
    'kode_prodi' => $request->kode_prodi,
]);

    return redirect('/admin/mahasiswa');
}
public function destroy($nim)
{
    $mahasiswa = Mahasiswa::findOrFail($nim);

    $mahasiswa->delete();

    return redirect('/admin/mahasiswa');
}
public function home()
{
    $mahasiswa = Mahasiswa::where(
        'nim',
        '3312511057'
    )->first();

    $totalKrs = \App\Models\Krs::where(
        'nim',
        $mahasiswa->nim
    )->count();

    $totalSks = \App\Models\Krs::where(
        'nim',
        $mahasiswa->nim
    )
    ->join(
        'mata_kuliahs',
        'krs.kode_mk',
        '=',
        'mata_kuliahs.kode_mk'
    )
    ->sum('mata_kuliahs.sks');

    $ips = \App\Models\Nilai::where(
        'nim',
        $mahasiswa->nim
    )->avg('index_nilai');

    return view(
        'mahasiswa.home',
        compact(
            'mahasiswa',
            'totalKrs',
            'totalSks',
            'ips'
        )
    );
}
}