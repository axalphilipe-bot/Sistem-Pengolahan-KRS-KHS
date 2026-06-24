<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NilaiImport;
use App\Models\Nilai;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Krs;
use Barryvdh\DomPDF\Facade\Pdf;
class DosenController extends Controller
{
    public function dashboard()
{
    $matkul = MataKuliah::all();

    $jumlahKelas = $matkul->count();

    $totalMahasiswa = Krs::count();

    $krsDisetujui = Krs::where(
        'status',
        'Disetujui'
    )->count();

    $menunggu = Krs::where(
        'status',
        'Pending'
    )->count();

    foreach ($matkul as $m) {

        $m->jumlah_mahasiswa =
            Krs::where(
                'kode_mk',
                $m->kode_mk
            )->count();
    }

    return view(
        'dosen.dashboard',
        compact(
            'jumlahKelas',
            'totalMahasiswa',
            'krsDisetujui',
            'menunggu',
            'matkul'
        )
    );
}


public function kelas()
{
    $matkul = MataKuliah::all();

    foreach ($matkul as $m) {
        $m->jumlah_mahasiswa = Krs::where(
            'kode_mk',
            $m->kode_mk
        )->count();
    }

    return view(
        'dosen.kelas',
        compact('matkul')
    );
}
            public function validasi()
        {
            $krs = Krs::with([
                'mahasiswa',
                'mataKuliah'
            ])->get();

            return view(
                'dosen.validasi',
                compact('krs')
            );
        }

        public function approve($id)
{
    Krs::findOrFail($id)
        ->update([
            'status' => 'Disetujui'
        ]);

    return back();
}

public function reject($id)
{
    Krs::findOrFail($id)
        ->update([
            'status' => 'Ditolak'
        ]);

    return back();
}

public function detailKelas($kode)
{
    $matkul = MataKuliah::where(
        'kode_mk',
        $kode
    )->firstOrFail();

    $peserta = Krs::with('mahasiswa')
        ->where('kode_mk', $kode)
        ->where('status', 'disetujui')
        ->get();

    return view(
        'dosen.detail_kelas',
        compact(
            'matkul',
            'peserta'
        )
    );
}
    public function inputNilai($kode)
{
    $matkul = MataKuliah::where(
        'kode_mk',
        $kode
    )->firstOrFail();

    $peserta = Krs::with([
        'mahasiswa',
        'mahasiswa.nilai'
    ])
    ->where('kode_mk', $kode)
    ->where('status', 'disetujui')
    ->get();

    return view(
        'dosen.input_nilai',
        compact(
            'matkul',
            'peserta'
        )
    );
}

public function simpanNilai(Request $request)
{
    foreach ($request->nim as $i => $nim) {

        $teamwork  = $request->teamwork[$i] ?? 0;
        $keaktifan = $request->keaktifan[$i] ?? 0;
        $laporan   = $request->laporan[$i] ?? 0;
        $proyek    = $request->proyek[$i] ?? 0;
        $tugas     = $request->tugas[$i] ?? 0;
        $kuis      = $request->kuis[$i] ?? 0;
        $uts       = $request->uts[$i] ?? 0;
        $uas       = $request->uas[$i] ?? 0;

        $nilaiAkhir =
    ($keaktifan * 0.15) +
    ($proyek * 0.35) +
    ($tugas * 0.10) +
    ($kuis * 0.10) +
    ($uts * 0.15) +
    ($uas * 0.15);

        if ($nilaiAkhir >= 85) {
            $huruf = 'A';
            $index = 4;
        } elseif ($nilaiAkhir >= 80) {
            $huruf = 'A-';
            $index = 3.75;
        } elseif ($nilaiAkhir >= 75) {
            $huruf = 'B+';
            $index = 3.50;
        } elseif ($nilaiAkhir >= 70) {
            $huruf = 'B';
            $index = 3.00;
        } elseif ($nilaiAkhir >= 65) {
            $huruf = 'C+';
            $index = 2.50;
        } elseif ($nilaiAkhir >= 60) {
            $huruf = 'C';
            $index = 2.00;
        } elseif ($nilaiAkhir >= 50) {
            $huruf = 'D';
            $index = 1.00;
        } else {
            $huruf = 'E';
            $index = 0;
        }

        $data = [
            'nim'          => $nim,
            'kode_mk'      => $request->kode_mk,
            'keaktifan'    => $keaktifan,
            'proyek'       => $proyek,
            'tugas'        => $tugas,
            'kuis'         => $kuis,
            'uts'          => $uts,
            'uas'          => $uas,
            'nilai_akhir'  => round($nilaiAkhir, 2),
            'nilai_huruf'  => $huruf,
            'index_nilai'  => $index
        ];

        Nilai::updateOrCreate(
            [
                'nim' => $nim,
                'kode_mk' => $request->kode_mk
            ],
            $data
        );
    }

    return back()->with('success', 'BERHASIL SIMPAN');
}

    public function hapusNilai($nim)
    {
        Nilai::where('nim', $nim)->delete();

        return back()->with(
            'success',
            'Nilai berhasil dihapus'
        );
    }

    public function downloadTemplate()
    {
        return response()->download(
            public_path('template_nilai.xlsx')
        );
    }

    public function importNilai(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(
            new NilaiImport($request->kode_mk),
            $request->file('file')
        );

        return back()->with(
            'success',
            'File Excel berhasil diimport!'
        );
    }
    public function exportKelasPdf()
{
    $matkul = MataKuliah::all();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'dosen.pdf_kelas',
        compact('matkul')
    );

    return $pdf->download('Daftar_Kelas_Dosen.pdf');
}
}