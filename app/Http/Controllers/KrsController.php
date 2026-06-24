<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Nilai;

class KrsController extends Controller
{
   public function index(Request $request)
{
    $mataKuliah = collect();

    if ($request->semester && $request->prodi) {

        $mataKuliah = MataKuliah::where(
            'semester',
            $request->semester
        )
        ->where(
            'kode_prodi',
            $request->prodi
        )
        ->get();
    }

    return view(
        'mahasiswa.krs',
        compact('mataKuliah')
    );
}

    public function dashboard()
    {
        $matkul = MataKuliah::all();

        return view('dosen.dashboard', [
            'matkul' => $matkul,
            'jumlahKelas' => $matkul->count(),
            'totalMahasiswa' => 96,
            'krsDisetujui' => 84,
            'menunggu' => 17
        ]);
    }

    public function store(Request $request)
{
    if (!$request->has('mata_kuliah')) {
        return back()->with(
            'error',
            'Pilih mata kuliah terlebih dahulu'
        );
    }

    $nim = '3312511057';

    $berhasil = 0;

    foreach ($request->mata_kuliah as $kodeMk) {

        $sudahAda = Krs::where('nim', $nim)
            ->where('kode_mk', $kodeMk)
            ->exists();

        if ($sudahAda) {
            continue;
        }

        Krs::create([
            'nim' => $nim,
            'kode_mk' => $kodeMk,
            'status' => 'Pending'
        ]);

        $berhasil++;
    }

    if ($berhasil == 0) {
        return back()->with(
            'error',
            'Mata kuliah sudah pernah diambil'
        );
    }

    return back()->with(
        'success',
        'KRS berhasil disimpan'
    );
}

    public function pengajuan()
    {
        $krs = Krs::all();

        return view('admin.krs_pengajuan', compact('krs'));
    }

    public function detail($nim)
{
    $mahasiswa = Mahasiswa::findOrFail($nim);

    $krs = Krs::where('nim', $nim)->get();

    $totalSks = 0;

    foreach ($krs as $item) {

        $matkul = MataKuliah::where(
            'kode_mk',
            $item->kode_mk
        )->first();

        if ($matkul) {
            $totalSks += $matkul->sks;
        }

        $item->matkul = $matkul;
    }

    return view(
        'admin.detail_pengajuan_krs',
        compact(
            'mahasiswa',
            'krs',
            'totalSks'
        )
    );
}
public function persetujuan()
{
    $krs = Krs::with('mahasiswa')->get();

    return view(
        'admin.krs_persetujuan',
        compact('krs')
    );
}
public function setujui($id)
{
    $krs = Krs::findOrFail($id);

    $krs->update([
        'status' => 'Disetujui'
    ]);

    return back();
}
public function tolak($id)
{
    $krs = Krs::findOrFail($id);

    $krs->update([
        'status' => 'Ditolak'
    ]);

    return back();
}
public function khs()
{
    $nim = '3312511057';

    $nilai = Nilai::with('matkul')
        ->where('nim', $nim)
        ->get();

    $totalSks = 0;
    $totalMutu = 0;

    foreach ($nilai as $n) {

        $sks = $n->matkul->sks ?? 0;

        $totalSks += $sks;

        $totalMutu +=
            $sks * $n->index_nilai;
    }

    $ips =
        $totalSks > 0
        ? round($totalMutu / $totalSks, 2)
        : 0;

    return view(
    'mahasiswa.khs',
    compact(
        'nilai',
        'ips',
        'totalSks'
    )
);
}
}