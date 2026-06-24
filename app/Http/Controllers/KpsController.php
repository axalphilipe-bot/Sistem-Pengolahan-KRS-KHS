<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanNilaiExport;
class KpsController extends Controller
{

public function dashboard()
{
    $menunggu = DB::table('nilais')
        ->where('status', 'Menunggu Approval')
        ->count();

    $disetujui = DB::table('nilais')
        ->where('status', 'Disetujui')
        ->count();

    $terkunci = DB::table('nilais')
        ->where('kunci_nilai', 'Terkunci')
        ->count();

    $aktivitas = DB::table('nilais')
        ->join(
            'mata_kuliahs',
            'nilais.kode_mk',
            '=',
            'mata_kuliahs.kode_mk'
        )
        ->select(
            'nilais.*',
            'mata_kuliahs.nama_mk'
        )
        ->where('nilais.status', 'Disetujui')
        ->latest('nilais.updated_at')
        ->take(5)
        ->get();

    return view(
        'kps.dashboard',
        compact(
            'menunggu',
            'disetujui',
            'terkunci',
            'aktivitas'
        )
    );
}
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
    public function laporan(Request $request)
{
    $query = DB::table('nilais')
        ->join('mata_kuliahs', 'nilais.kode_mk', '=', 'mata_kuliahs.kode_mk')
        ->join('mahasiswa', 'nilais.nim', '=', 'mahasiswa.nim')
        ->join('prodi', 'mahasiswa.kode_prodi', '=', 'prodi.kode_prodi')
        ->where('nilais.status', 'Disetujui');

    if(
    $request->semester != '' &&
    $request->semester != 'Semua Semester'
){
    $query->where(
        'mata_kuliahs.semester',
        strtolower($request->semester)
    );
}

if(
    $request->prodi != '' &&
    $request->prodi != 'Semua Program Studi'
){
    $query->where(
        'prodi.nama_prodi',
        $request->prodi
    );
}

    $data = $query->select(
        'nilais.*',
        'mata_kuliahs.nama_mk',
        'prodi.nama_prodi'
    )->get();

    $total = $data->count();

    $disetujui = $data->count();

    $terkunci = $data
        ->where('kunci_nilai', 'Terkunci')
        ->count();

    return view('kps.laporan', compact(
        'data',
        'total',
        'disetujui',
        'terkunci'
    ));
}
public function exportPdf()
{
    $data = DB::table('nilais')
        ->join('mata_kuliahs', 'nilais.kode_mk', '=', 'mata_kuliahs.kode_mk')
        ->join('mahasiswa', 'nilais.nim', '=', 'mahasiswa.nim')
        ->join('prodi', 'mahasiswa.kode_prodi', '=', 'prodi.kode_prodi')
        ->where('nilais.status', 'Disetujui')
        ->select(
            'mata_kuliahs.nama_mk',
            'nilais.nama_dosen',
            'prodi.nama_prodi',
            'mata_kuliahs.semester',
            'nilais.kunci_nilai'
        )
        ->get();

    $pdf = Pdf::loadView('kps.pdf_laporan', compact('data'));

    return $pdf->download('laporan_nilai.pdf');
}
public function exportExcel()
{
    return Excel::download(
        new LaporanNilaiExport,
        'laporan_nilai.xlsx'
    );
}
public function detailNilai($nim, $kode_mk)
{
    $nilai = DB::table('nilais')
        ->join(
            'mata_kuliahs',
            'nilais.kode_mk',
            '=',
            'mata_kuliahs.kode_mk'
        )
        ->join(
            'mahasiswa',
            'nilais.nim',
            '=',
            'mahasiswa.nim'
        )
        ->where('nilais.nim', $nim)
        ->where('nilais.kode_mk', $kode_mk)
        ->select(
            'nilais.*',
            'mata_kuliahs.nama_mk',
            'mahasiswa.nama'
        )
        ->first();

    return view(
        'kps.detail_nilai',
        compact('nilai')
    );
}
}