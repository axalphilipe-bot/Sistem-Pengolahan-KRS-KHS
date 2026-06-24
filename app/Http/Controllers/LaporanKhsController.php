<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KhsExport;

class LaporanKhsController extends Controller
{
    public function index(Request $request)
    {
        $query = Nilai::with('mahasiswa');

        if ($request->search) {
            $query->where(
                'nim',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->nilai_huruf) {
            $query->where(
                'nilai_huruf',
                $request->nilai_huruf
            );
        }

        $nilai = $query->latest()->get();

        $totalKhs = Nilai::count();

$nilaiA = Nilai::whereIn('nilai_huruf', [
    'A',
    'A+',
    'A-'
])->count();

$nilaiB = Nilai::whereIn('nilai_huruf', [
    'B',
    'B+',
    'B-'
])->count();

$nilaiCD = Nilai::whereIn('nilai_huruf', [
    'C',
    'C+',
    'C-',
    'D',
    'E'
])->count();

        return view(
            'admin.laporan_khs',
            compact(
                'nilai',
                'totalKhs',
                'nilaiA',
                'nilaiB',
                'nilaiCD'
            )
        );
    }
    public function exportPdf()
{
    $nilai = Nilai::with('mahasiswa')->get();

    $pdf = Pdf::loadView(
        'admin.laporan_khs_pdf',
        compact('nilai')
    );

    return $pdf->download('laporan_khs.pdf');
}

public function exportExcel()
{
    return Excel::download(
        new KhsExport,
        'laporan_khs.xlsx'
    );
}
}