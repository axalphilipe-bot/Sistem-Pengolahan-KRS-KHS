<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KhsExport;

class LaporanKhsController extends Controller
{
    private function filteredQuery(Request $request)
    {
        $query = Nilai::with(['mahasiswa', 'matkul']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhereHas('mahasiswa', function ($m) use ($search) {
                        $m->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('nilai_huruf')) {
            $query->where('nilai_huruf', 'like', $request->nilai_huruf . '%');
        }

        return $query->latest();
    }

    public function index(Request $request)
    {
        $nilai = $this->filteredQuery($request)
            ->paginate(10)
            ->withQueryString();

        $totalKhs = Nilai::count();
        $nilaiA = Nilai::whereIn('nilai_huruf', ['A', 'A+', 'A-'])->count();
        $nilaiB = Nilai::whereIn('nilai_huruf', ['B', 'B+', 'B-'])->count();
        $nilaiCD = Nilai::whereIn('nilai_huruf', ['C', 'C+', 'C-', 'D', 'E'])->count();

        return view('admin.laporan_khs', compact(
            'nilai',
            'totalKhs',
            'nilaiA',
            'nilaiB',
            'nilaiCD'
        ));
    }

    public function exportPdf(Request $request)
    {
        $nilai = $this->filteredQuery($request)->get();

        $pdf = Pdf::loadView(
            'admin.laporan_khs_pdf',
            compact('nilai')
        );

        return $pdf->download('laporan-khs.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new KhsExport($request->search, $request->nilai_huruf),
            'laporan-khs.xlsx'
        );
    }
}
