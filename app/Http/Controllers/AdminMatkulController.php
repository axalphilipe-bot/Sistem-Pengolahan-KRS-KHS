<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class AdminMatkulController extends Controller
{
    public function index()
{
    $matkul = MataKuliah::all();
    $prodi  = Prodi::all();

    return view(
        'admin.matkul',
        compact('matkul', 'prodi')
    );
}

    public function create()
    {
        $prodi = Prodi::all();

        return view(
            'admin.tambah_matkul',
            compact('prodi')
        );
    }

    public function store(Request $request)
    {
        MataKuliah::create([
            'kode_mk'    => $request->kode_mk,
            'nama_mk'    => $request->nama_mk,
            'sks'        => $request->sks,
            'dosen'      => $request->dosen,
            'kode_prodi' => $request->kode_prodi,
            'semester'   => $request->semester,
            'jenis'      => $request->jenis
        ]);

        return redirect('/admin/matkul');
    }

    public function show($kode_mk)
    {
        $matkul = MataKuliah::where(
            'kode_mk',
            $kode_mk
        )->first();

        return view(
            'admin.detail_matkul',
            compact('matkul')
        );
    }

    public function edit($kode_mk)
    {
        $matkul = MataKuliah::where(
            'kode_mk',
            $kode_mk
        )->first();

        $prodi = Prodi::all();

        return view(
            'admin.edit_matkul',
            compact('matkul','prodi')
        );
    }

    public function update(Request $request, $kode_mk)
    {
        $matkul = MataKuliah::where(
            'kode_mk',
            $kode_mk
        )->first();

        $matkul->update([
            'nama_mk'    => $request->nama_mk,
            'sks'        => $request->sks,
            'dosen'      => $request->dosen,
            'kode_prodi' => $request->kode_prodi,
            'semester'   => $request->semester,
            'jenis'      => $request->jenis
        ]);

        return redirect('/admin/matkul');
    }

    public function destroy($kode_mk)
    {
        $matkul = MataKuliah::where(
            'kode_mk',
            $kode_mk
        )->first();

        $matkul->delete();

        return redirect('/admin/matkul');
    }
}