<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\LogAktivitas;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
   public function index(Request $request)
{
    $mataKuliah = collect();
    $prodiList = \App\Models\Prodi::orderBy('nama_prodi')->get();
    $mahasiswa = Mahasiswa::forAuthenticatedUser();
    $krsDiambil = collect();

    if ($mahasiswa) {
        $krsDiambil = Krs::where('nim', $mahasiswa->nim)
            ->get()
            ->keyBy('kode_mk');
    }

    $prodiMahasiswa = $mahasiswa?->kode_prodi;
    $semester = $request->semester;

    if ($semester && $prodiMahasiswa) {
        $mataKuliah = MataKuliah::where('semester', $semester)
            ->where('kode_prodi', $prodiMahasiswa)
            ->orderBy('kode_mk')
            ->get();
    }

    return response()
        ->view(
            'mahasiswa.krs',
            compact('mataKuliah', 'prodiList', 'mahasiswa', 'krsDiambil', 'prodiMahasiswa', 'semester')
        )
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
        ->header('Pragma', 'no-cache');
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

    $mahasiswa = Mahasiswa::forAuthenticatedUser();

    if (!$mahasiswa) {
        return back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    $nim = $mahasiswa->nim;

    $berhasil = 0;
    $sudahDiambil = [];
    $tidakSesuaiProdi = [];

    foreach ($request->mata_kuliah as $kodeMk) {

        $matkul = MataKuliah::where('kode_mk', $kodeMk)->first();

        if (!$matkul || $matkul->kode_prodi !== $mahasiswa->kode_prodi) {
            $tidakSesuaiProdi[] = $matkul->nama_mk ?? $kodeMk;
            continue;
        }

        $sudahAda = Krs::where('nim', $nim)
            ->where('kode_mk', $kodeMk)
            ->exists();

        if ($sudahAda) {
            $sudahDiambil[] = $matkul->nama_mk ?? $kodeMk;
            continue;
        }

        Krs::create([
            'nim' => $nim,
            'kode_mk' => $kodeMk,
            'status' => 'Pending',
        ]);

        $berhasil++;
    }

    if ($berhasil == 0 && count($tidakSesuaiProdi) > 0 && count($sudahDiambil) === 0) {
        return back()->with('error', 'Mata kuliah yang dipilih tidak sesuai dengan program studi Anda.');
    }

    if ($berhasil == 0 && count($sudahDiambil) > 0) {
        return back()->with([
            'warning_title' => 'Mata Kuliah Sudah Diambil',
            'warning_message' => 'Semua mata kuliah yang dipilih sudah pernah diajukan sebelumnya.',
            'warning_items' => $sudahDiambil,
        ]);
    }

    if ($berhasil > 0 && count($sudahDiambil) > 0) {
        LogAktivitas::catat("Mengajukan KRS ({$berhasil} mata kuliah)");

        return back()->with([
            'success' => "Berhasil mengajukan {$berhasil} mata kuliah.",
            'warning_title' => 'Beberapa Mata Kuliah Dilewati',
            'warning_message' => 'Mata kuliah berikut sudah pernah diambil dan tidak diajukan ulang:',
            'warning_items' => $sudahDiambil,
        ]);
    }

    if ($berhasil > 0 && count($tidakSesuaiProdi) > 0) {
        LogAktivitas::catat("Mengajukan KRS ({$berhasil} mata kuliah)");

        return back()->with([
            'success' => "Berhasil mengajukan {$berhasil} mata kuliah.",
            'warning_title' => 'Mata Kuliah Diabaikan',
            'warning_message' => 'Mata kuliah berikut tidak sesuai program studi Anda:',
            'warning_items' => $tidakSesuaiProdi,
        ]);
    }

    if ($berhasil == 0) {
        return back()->with('error', 'Pilih mata kuliah yang belum pernah diambil.');
    }

    LogAktivitas::catat("Mengajukan KRS ({$berhasil} mata kuliah)");

    return back()->with(
        'success',
        "KRS berhasil disimpan. {$berhasil} mata kuliah diajukan."
    );
}

    public function pengajuan(Request $request)
{
    $latestIds = Krs::selectRaw('MAX(id) as id')
        ->groupBy('nim')
        ->pluck('id');

    $totalPengajuan = $latestIds->count();
    $totalPending = Krs::whereIn('id', $latestIds)->where('status', 'Pending')->count();
    $totalDisetujui = Krs::whereIn('id', $latestIds)->where('status', 'Disetujui')->count();
    $totalDitolak = Krs::whereIn('id', $latestIds)->where('status', 'Ditolak')->count();

    $query = Krs::with(['mahasiswa.prodi'])
        ->whereIn('id', $latestIds);

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nim', 'like', '%' . $request->search . '%')
                ->orWhereHas('mahasiswa', function ($m) use ($request) {
                    $m->where('nama', 'like', '%' . $request->search . '%');
                });
        });
    }

    $krs = $query
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

    return view(
        'admin.krs_pengajuan',
        compact(
            'krs',
            'totalPengajuan',
            'totalPending',
            'totalDisetujui',
            'totalDitolak'
        )
    );
}

    public function detail($nim)
{
    $mahasiswa = Mahasiswa::with('prodi')->findOrFail($nim);

    $krs = Krs::with('mataKuliah')->where('nim', $nim)->get();

    $totalSks = $krs->sum(fn ($item) => $item->mataKuliah->sks ?? 0);
    $status = $krs->first()?->status ?? 'Pending';

    return view(
        'admin.detail_pengajuan_krs',
        compact(
            'mahasiswa',
            'krs',
            'totalSks',
            'status'
        )
    );
}
public function persetujuan(Request $request)
{
    $search = $request->search;

    $ids = Krs::where('status', 'Pending')
        ->selectRaw('MAX(id) as id')
        ->groupBy('nim')
        ->pluck('id');

    $krs = Krs::with('mahasiswa')
        ->whereIn('id', $ids);

    if ($search) {
        $krs->where(function ($q) use ($search) {
            $q->where('nim', 'like', "%{$search}%")
              ->orWhereHas('mahasiswa', function ($m) use ($search) {
                  $m->where('nama', 'like', "%{$search}%");
              });
        });
    }

    $krs = $krs->orderByDesc('created_at')->get();

    return view('admin.krs_persetujuan', compact('krs'));
}
public function setujui($id)
{
    // CP5: persetujuan KRS dialihkan ke Dosen Wali (rollback: hapus blok guard ini)
    return redirect('/admin/krs')
        ->with('error', 'Persetujuan KRS sekarang dilakukan oleh Dosen Wali.');

    $krs = Krs::findOrFail($id);

    Krs::where('nim', $krs->nim)
        ->where('status', 'Pending')
        ->update([
            'status' => 'Disetujui'
        ]);

    return redirect('/admin/krs-approve')
        ->with('success', 'Pengajuan berhasil disetujui.');
}
public function tolak($id)
{
    // CP5: persetujuan KRS dialihkan ke Dosen Wali (rollback: hapus blok guard ini)
    return redirect('/admin/krs')
        ->with('error', 'Persetujuan KRS sekarang dilakukan oleh Dosen Wali.');

    $krs = Krs::findOrFail($id);

    Krs::where('nim', $krs->nim)
        ->where('status', 'Pending')
        ->update([
            'status' => 'Ditolak'
        ]);

    return redirect('/admin/krs-approve')
        ->with('success', 'Pengajuan berhasil ditolak.');
}
public function khs()
{
    $data = $this->getKhsData();

    if (!$data['mahasiswa']) {
        return redirect('/login')->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    return view('mahasiswa.khs', $data);
}

public function exportKhsPdf()
{
    $data = $this->getKhsData();

    if (!$data['mahasiswa']) {
        return redirect('/login')->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    $pdf = Pdf::loadView('mahasiswa.khs_pdf', $data)
        ->setPaper('a4', 'portrait');

    return $pdf->download('KHS_' . $data['mahasiswa']->nim . '.pdf');
}

private function getKhsData(): array
{
    $mahasiswa = Mahasiswa::forAuthenticatedUser();
    $nilai = collect();
    $totalSks = 0;
    $ips = 0;
    $ipk = 0;

    if ($mahasiswa) {
        $nilai = Nilai::with('matkul')
            ->published()
            ->where('nim', $mahasiswa->nim)
            ->get();

        $totalMutu = 0;

        foreach ($nilai as $n) {
            $sks = $n->matkul->sks ?? 0;
            $totalSks += $sks;
            $totalMutu += $sks * ($n->index_nilai ?? 0);
        }

        $ips = $totalSks > 0
            ? round($totalMutu / $totalSks, 2)
            : 0;

        $ipk = $ips;
    }

    return compact('mahasiswa', 'nilai', 'totalSks', 'ips', 'ipk');
}
}