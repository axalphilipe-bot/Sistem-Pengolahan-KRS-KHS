<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;

use App\Imports\MatkulImport;
use App\Exports\MatkulExport;
use App\Exports\MatkulTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class AdminMatkulController extends Controller
{
    public function index(Request $request)
{
    $query = MataKuliah::query();

    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('kode_mk', 'like', '%' . $request->search . '%')
              ->orWhere('nama_mk', 'like', '%' . $request->search . '%');

        });
    }

    if ($request->filled('prodi')) {

        $query->where(
            'kode_prodi',
            $request->prodi
        );

    }

    if ($request->filled('semester')) {

        $query->where(
            'semester',
            $request->semester
        );

    }

    if ($request->filled('jenis')) {

        $query->where(
            'jenis',
            $request->jenis
        );

    }

    $matkul = $query->with('prodi')->paginate(10)->withQueryString();

    $prodi = Prodi::all();
    $totalMatkul = MataKuliah::count();
    $totalSks = MataKuliah::sum('sks');

    return view(
        'admin.matkul',
        compact('matkul', 'prodi', 'totalMatkul', 'totalSks')
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
        $matkul = MataKuliah::with('prodi')->where('kode_mk', $kode_mk)->firstOrFail();

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
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(
        new MatkulImport,
        $request->file('file')
    );

    return redirect()
        ->back()
        ->with('success', 'Data mata kuliah berhasil diimport.');
}
public function export(Request $request)
{
    return Excel::download(
        new MatkulExport(
            $request->search,
            $request->prodi,
            $request->semester,
            $request->jenis,
        ),
        'Data_Mata_Kuliah.xlsx'
    );
}

public function downloadTemplate()
{
    return Excel::download(
        new MatkulTemplateExport,
        'Template_Import_Mata_Kuliah.xlsx'
    );
}
}