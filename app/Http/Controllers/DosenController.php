<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NilaiImport;
use App\Models\Nilai;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;

class DosenController extends Controller
{
    public function dashboard()
    {
        $matkul = MataKuliah::all();

        return view('dosen.dashboard', [
            'jumlahKelas' => $matkul->count(),
            'totalMahasiswa' => 96,
            'krsDisetujui' => 84,
            'menunggu' => 17,
            'matkul' => $matkul
        ]);
    }

    public function kelas()
    {
        return view('dosen.kelas');
    }

    public function validasi()
    {
        return view('dosen.validasi');
    }

    public function detailKelas($kode)
    {
        $matkul = MataKuliah::where('kode', $kode)->first();

        return view('dosen.detail_kelas', compact('matkul'));
    }

    public function inputNilai($kode)
    {
        $matkul = MataKuliah::where('kode_mk', $kode)->first();

        $mahasiswa = Mahasiswa::with('nilai')->get();

        return view(
            'dosen.input_nilai',
            compact('matkul', 'mahasiswa')
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
            ($teamwork * 0.15) +
            ($keaktifan * 0.15) +
            ($laporan * 0.10) +
            ($proyek * 0.30) +
            ($tugas * 0.05) +
            ($kuis * 0.05) +
            ($uts * 0.10) +
            ($uas * 0.10);

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
            'teamwork'     => $teamwork,
            'keaktifan'    => $keaktifan,
            'laporan'      => $laporan,
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
}