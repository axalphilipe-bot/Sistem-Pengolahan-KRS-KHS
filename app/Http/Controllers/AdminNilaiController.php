<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class AdminNilaiController extends Controller
{
    public function index(Request $request)
{
    $query = Nilai::with('mahasiswa');

    // Filter Status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // Search NIM atau Nama
    if ($request->search) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('nim', 'like', "%{$search}%")

              ->orWhereHas('mahasiswa', function ($m) use ($search) {

                    $m->where('nama', 'like', "%{$search}%");

              });

        });
    }

    $nilai = $query->get();

    return view(
        'admin.nilai_validasi',
        compact('nilai')
    );
}

    public function setujui($nim)
{
    $nilai = Nilai::find($nim);

    if ($nilai) {
        $nilai->status = 'Disetujui';
        $nilai->save();
    }

    return redirect('/admin/validasi')
        ->with('success', 'Nilai berhasil disetujui');
}

public function tolak($nim)
{
    $nilai = Nilai::find($nim);

    if ($nilai) {
        $nilai->status = 'Ditolak';
        $nilai->save();
    }

    return redirect('/admin/validasi')
        ->with('success', 'Nilai berhasil ditolak');
}
}