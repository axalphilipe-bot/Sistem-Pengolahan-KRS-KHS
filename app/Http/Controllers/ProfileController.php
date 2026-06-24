<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where(
            'nim',
            '3312511057'
        )->first();

        return view(
            'mahasiswa.profil',
            compact('mahasiswa')
        );
    }

    public function update(Request $request)
{
    $mahasiswa = \App\Models\Mahasiswa::where(
        'nim',
        '3312511057'
    )->first();

    $mahasiswa->update([
        'nama'  => $request->name,
        'email' => $request->email,
    ]);

    return back()->with(
        'success',
        'Profil berhasil diupdate'
    );
}
}