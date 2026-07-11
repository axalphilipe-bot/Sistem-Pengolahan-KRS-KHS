<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $logs = LogAktivitas::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pengguna', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")
                        ->orWhere('aktivitas', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.log', [
            'logs' => $logs,
            'search' => $search,
            'totalAktivitas' => LogAktivitas::count(),
            'hariIni' => LogAktivitas::whereDate('created_at', today())->count(),
            'totalDosen' => LogAktivitas::where('role', 'dosen')->count(),
            'totalMahasiswa' => LogAktivitas::where('role', 'mahasiswa')->count(),
        ]);
    }
}
