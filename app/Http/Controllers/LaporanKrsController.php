<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KrsExport;

class LaporanKrsController extends Controller
{
    public function index(Request $request)
{
    $query = Krs::with('mahasiswa');

    if($request->search){
        $query->where('nim','like','%'.$request->search.'%');
    }

    if($request->status){
        $query->where('status',$request->status);
    }

    $krs = $query->latest()->get();

    $totalKrs = Krs::count();

    $disetujui = Krs::where(
        'status',
        'Disetujui'
    )->count();

    $ditolak = Krs::where(
        'status',
        'Ditolak'
    )->count();

    $menunggu = Krs::where(
        'status',
        'Menunggu Approval'
    )->count();

    return view(
        'admin.laporan_krs',
        compact(
            'krs',
            'totalKrs',
            'disetujui',
            'ditolak',
            'menunggu'
        )
    );
}
public function exportPdf()
{
    $krs = Krs::with('mahasiswa')->get();

    $pdf = PDF::loadView(
    'admin.laporan_krs_pdf',
    compact('krs')
);

    return $pdf->download('laporan-krs.pdf');
}

public function exportExcel()
{
    return Excel::download(
        new KrsExport,
        'laporan-krs.xlsx'
    );
}
}