<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;

class AdminDosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();

        return view(
            'admin.dosen',
            compact('dosen')
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
    $dosen = Dosen::where(
        'nuptk',
        $nuptk
    )->first();

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
}