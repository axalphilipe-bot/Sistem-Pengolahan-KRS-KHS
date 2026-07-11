<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KrsExport;

class LaporanKrsController extends Controller
{
    private function filteredQuery(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'mataKuliah']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhereHas('mahasiswa', function ($m) use ($search) {
                        $m->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->latest();
    }

    public function index(Request $request)
    {
        $krs = $this->filteredQuery($request)
            ->paginate(10)
            ->withQueryString();

        $totalKrs = Krs::count();
        $disetujui = Krs::where('status', 'Disetujui')->count();
        $ditolak = Krs::where('status', 'Ditolak')->count();
        $menunggu = Krs::where('status', 'Pending')->count();

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

    public function exportPdf(Request $request)
    {
        $krs = $this->filteredQuery($request)->get();

        $pdf = PDF::loadView(
            'admin.laporan_krs_pdf',
            compact('krs')
        );

        return $pdf->download('laporan-krs.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new KrsExport($request->search, $request->status),
            'laporan-krs.xlsx'
        );
    }
}
