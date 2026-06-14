<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpsController extends Controller
{
    public function approve()
    {
        $nilais = DB::table('nilais')->get();

        return view('kps.approve', compact('nilais'));
    }

    public function setujui($nim)
    {
        DB::table('nilais')
            ->where('nim', $nim)
            ->update([
                'status' => 'Disetujui'
            ]);

        return redirect()->back();
    }

    public function tolak($nim)
    {
        DB::table('nilais')
            ->where('nim', $nim)
            ->update([
                'status' => 'Ditolak'
            ]);

        return redirect()->back();
    }

public function kunci()
{
    $nilais = DB::table('nilais')
    ->join('mata_kuliahs', 'nilais.kode_mk', '=', 'mata_kuliahs.kode_mk')
    ->where('status', 'Disetujui')
    ->select(
        'nilais.*',
        'mata_kuliahs.nama_mk'
    )
    ->get();

    $terkunci = $nilais
        ->where('kunci_nilai', 'Terkunci')
        ->count();

    $belumTerkunci = $nilais
        ->where('kunci_nilai', 'Belum Terkunci')
        ->count();

    $total = $nilais->count();

    return view('kps.kunci', compact(
        'nilais',
        'terkunci',
        'belumTerkunci',
        'total'
    ));
}

    public function lock($nim)
    {
        DB::table('nilais')
->where('nim',$nim)
->update([
    'kunci_nilai' => 'Terkunci',
    'tanggal_kunci' => now()
]);

        return redirect()->back();
    }

    public function unlock($nim)
    {
        DB::table('nilais')
->where('nim',$nim)
->update([
    'kunci_nilai' => 'Belum Terkunci',
    'tanggal_kunci' => null
]);

        return redirect()->back();
    }
}