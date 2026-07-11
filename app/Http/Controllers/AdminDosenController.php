<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;

use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DosenExport;
use App\Exports\DosenTemplateExport;

class AdminDosenController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;
    $totalDosen = Dosen::count();

    $dosen = Dosen::with('prodi')
        ->when($search, function ($query) use ($search) {

            $query->where('nuptk', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('kode_prodi', 'like', "%{$search}%");

        })
        ->orderBy('nuptk')
        ->paginate(10)
        ->withQueryString();

    return view(
        'admin.dosen',
        compact('dosen', 'search', 'totalDosen')
    );
}

    public function create()
{
    $prodi = Prodi::all();

    return view(
        'admin.tambah_dosen',
        compact('prodi')
    );
}

    public function store(Request $request)
    {
        Dosen::create([
            'nuptk'      => $request->nuptk,
            'nama'       => $request->nama,
            'email'      => $request->email,
            'jabatan'    => $request->jabatan,
            'kode_prodi' => $request->kode_prodi
        ]);

        return redirect('/admin/dosen');
    }

    public function show($nuptk)
{
    $dosen = Dosen::with('prodi')->where('nuptk', $nuptk)->firstOrFail();

    return view(
        'admin.detail_dosen',
        compact('dosen')
    );
}

public function edit($nuptk)
{
    $dosen = Dosen::where(
        'nuptk',
        $nuptk
    )->first();

    $prodi = Prodi::all();

    return view(
        'admin.edit_dosen',
        compact('dosen', 'prodi')
    );
}

public function update(Request $request, $nuptk)
{
    $dosen = Dosen::where(
        'nuptk',
        $nuptk
    )->first();

    $dosen->update([
        'nama'       => $request->nama,
        'email'      => $request->email,
        'jabatan'    => $request->jabatan,
        'kode_prodi' => $request->kode_prodi
    ]);

    return redirect('/admin/dosen');
}
public function destroy($nuptk)
{
    $dosen = Dosen::where(
        'nuptk',
        $nuptk
    )->first();

    $dosen->delete();

    return redirect('/admin/dosen');
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(
        new DosenImport,
        $request->file('file')
    );

    return redirect('/admin/dosen')
        ->with('success', 'Data dosen berhasil diimport.');
}
public function export(Request $request)
{
    return Excel::download(
        new DosenExport($request->search),
        'Data_Dosen.xlsx'
    );
}

public function downloadTemplate()
{
    return Excel::download(
        new DosenTemplateExport,
        'Template_Import_Dosen.xlsx'
    );
}
}