<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NilaiImport;
use App\Models\Dosen;
use App\Models\Nilai;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\LogAktivitas;
use Barryvdh\DomPDF\Facade\Pdf;
class DosenController extends Controller
{
    public function dashboard()
{
    $dosen = auth()->user();

$matkul = $this->matkulQueryFor($dosen)->get();

    $jumlahKelas = $matkul->count();

$kodeMk = $matkul->pluck('kode_mk');

$totalMahasiswa = $dosen->nuptk
    ? Mahasiswa::where('nuptk_wali', $dosen->nuptk)->count()
    : 0;

$krsDisetujui = Krs::whereIn('kode_mk', $kodeMk)
    ->where('status', 'Disetujui')
    ->count();

$menunggu = Krs::whereIn('kode_mk', $kodeMk)
    ->where('status', 'Pending')
    ->count();

    foreach ($matkul as $m) {

    $m->jumlah_mahasiswa =
        Krs::where('kode_mk', $m->kode_mk)
            ->where('status', 'Disetujui')
            ->count();
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
  $dosen = auth()->user();

$matkul = $this->matkulQueryFor($dosen)->get();

$kodeMk = $matkul->pluck('kode_mk');
$jumlahKelas = $matkul->count();

$totalMahasiswa = $dosen->nuptk
    ? Mahasiswa::where('nuptk_wali', $dosen->nuptk)->count()
    : 0;

    $menunggu = Krs::whereIn('kode_mk', $kodeMk)
    ->where('status', 'Pending')
    ->count();

    foreach ($matkul as $m) {

    $m->jumlah_mahasiswa = Krs::where('kode_mk', $m->kode_mk)
        ->where('status', 'Disetujui')
        ->count();

}

    return view(
        'dosen.kelas',
        compact(
            'matkul',
            'jumlahKelas',
            'totalMahasiswa',
            'menunggu'
        )
    );
}
            public function validasi(Request $request)
        {
            $nuptk = auth()->user()->nuptk;

            $baseQuery = Krs::with(['mahasiswa', 'mataKuliah'])
                ->when($nuptk, function ($query) use ($nuptk) {
                    $query->whereHas('mahasiswa', function ($q) use ($nuptk) {
                        $q->where('nuptk_wali', $nuptk);
                    });
                }, function ($query) {
                    $query->whereRaw('1 = 0');
                });

            $totalPengajuan = (clone $baseQuery)->count();
            $pending = (clone $baseQuery)->where('status', 'Pending')->count();
            $disetujui = (clone $baseQuery)->where('status', 'Disetujui')->count();
            $ditolak = (clone $baseQuery)->where('status', 'Ditolak')->count();

            $query = clone $baseQuery;

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nim', 'like', "%{$search}%")
                        ->orWhereHas('mahasiswa', function ($q) use ($search) {
                            $q->where('nama', 'like', "%{$search}%");
                        })
                        ->orWhereHas('mataKuliah', function ($q) use ($search) {
                            $q->where('nama_mk', 'like', "%{$search}%");
                        });
                });
            }

            if ($request->filled('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            $krs = $query->orderByDesc('created_at')
                ->paginate(10)
                ->withQueryString();

            return view(
                'dosen.validasi',
                compact(
                    'krs',
                    'totalPengajuan',
                    'pending',
                    'disetujui',
                    'ditolak'
                )
            );
        }

        public function approve($id)
{
    $krs = Krs::with('mataKuliah')->findOrFail($id);
    $nuptk = auth()->user()->nuptk;

    $mahasiswa = Mahasiswa::find($krs->nim);

    if (!$nuptk || !$mahasiswa || $mahasiswa->nuptk_wali !== $nuptk) {
        abort(403);
    }

    if ($krs->status !== 'Pending') {
        return back()->with('error', 'Pengajuan KRS ini sudah diproses.');
    }

    $krs->update(['status' => 'Disetujui']);

    LogAktivitas::catat(
        'Menyetujui KRS '
        . ($krs->mataKuliah->nama_mk ?? $krs->kode_mk)
        . ' mahasiswa '
        . ($mahasiswa->nama ?? $krs->nim)
    );

    return back();
}

public function reject($id)
{
    $krs = Krs::with('mataKuliah')->findOrFail($id);
    $nuptk = auth()->user()->nuptk;

    $mahasiswa = Mahasiswa::find($krs->nim);

    if (!$nuptk || !$mahasiswa || $mahasiswa->nuptk_wali !== $nuptk) {
        abort(403);
    }

    if ($krs->status !== 'Pending') {
        return back()->with('error', 'Pengajuan KRS ini sudah diproses.');
    }

    $krs->update(['status' => 'Ditolak']);

    LogAktivitas::catat(
        'Menolak KRS '
        . ($krs->mataKuliah->nama_mk ?? $krs->kode_mk)
        . ' mahasiswa '
        . ($mahasiswa->nama ?? $krs->nim)
    );

    return back();
}

public function detailKelas($kode)
{
    $dosen = auth()->user();

    $matkul = $this->matkulQueryFor($dosen)
        ->where('kode_mk', $kode)
        ->firstOrFail();

    $peserta = Krs::with('mahasiswa')
        ->where('kode_mk', $kode)
        ->where('status', 'Disetujui')
        ->whereHas('mahasiswa', function ($q) use ($dosen) {
            if ($dosen->nuptk) {
                $q->where('nuptk_wali', $dosen->nuptk);
            }
        })
        ->get();

    return view(
        'dosen.detail_kelas',
        compact(
            'matkul',
            'peserta'
        )
    );
}
    public function nilaiIndex(Request $request)
    {
        $dosen = auth()->user();

        $matkul = $this->matkulQueryFor($dosen)
            ->when($request->search, function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('kode_mk', 'like', "%{$search}%")
                        ->orWhere('nama_mk', 'like', "%{$search}%");
                });
            })
            ->orderBy('kode_mk')
            ->get();

        foreach ($matkul as $m) {
            $nims = Krs::where('kode_mk', $m->kode_mk)
                ->where('status', 'Disetujui')
                ->when($dosen->nuptk, function ($query) use ($dosen) {
                    $query->whereHas('mahasiswa', function ($q) use ($dosen) {
                        $q->where('nuptk_wali', $dosen->nuptk);
                    });
                })
                ->pluck('nim');

            $m->jumlah_mahasiswa = $nims->count();

            $nilais = Nilai::where('kode_mk', $m->kode_mk)
                ->whereIn('nim', $nims)
                ->get();

            $m->status_nilai = $this->resolveNilaiMkStatus($nims, $nilais, $m->kode_prodi);
        }

        if ($matkul->count() === 1 && ! $request->filled('search')) {
            return redirect('/dosen/nilai/' . $matkul->first()->kode_mk);
        }

        return view('dosen.nilai_index', compact('matkul'));
    }

    public function inputNilai($kode)
{
    $dosen = auth()->user();

    $matkul = MataKuliah::where(
        'kode_mk',
        $kode
    )->firstOrFail();

    $peserta = Krs::with('mahasiswa')
        ->where('kode_mk', $kode)
        ->where('status', 'Disetujui')
        ->when($dosen->nuptk, function ($query) use ($dosen) {
            $query->whereHas('mahasiswa', function ($q) use ($dosen) {
                $q->where('nuptk_wali', $dosen->nuptk);
            });
        }, function ($query) {
            $query->whereRaw('1 = 0');
        })
        ->get();

    if ($peserta->count() == 0) {
        return redirect('/dosen/nilai')
            ->with(
                'error',
                'Belum ada mahasiswa yang KRS-nya disetujui.'
            );
    }

    $nilaiMap = Nilai::where('kode_mk', $kode)
        ->whereIn('nim', $peserta->pluck('nim'))
        ->get()
        ->keyBy('nim');

    foreach ($peserta as $item) {
        $nilai = $nilaiMap->get($item->nim);

        if ($nilai && $this->isNilaiRowAllZero([
            'keaktifan' => $nilai->keaktifan,
            'proyek'    => $nilai->proyek,
            'tugas'     => $nilai->tugas,
            'kuis'      => $nilai->kuis,
            'uts'       => $nilai->uts,
            'uas'       => $nilai->uas,
        ])) {
            $nilai = null;
        }

        $item->nilaiMk = $nilai;
    }

    $isSaved = $peserta->contains(fn ($item) => $item->nilaiMk !== null);

    $prodiLocked = Nilai::isProdiFullyLocked($matkul->kode_prodi);
    $hasLockedNilai = $prodiLocked
        || $nilaiMap->contains(fn ($nilai) => $nilai->isLocked());
    $allNilaiLocked = $prodiLocked
        || ($nilaiMap->isNotEmpty()
            && $nilaiMap->every(fn ($nilai) => $nilai->isLocked()));

    return view(
        'dosen.input_nilai',
        compact(
            'matkul',
            'peserta',
            'isSaved',
            'hasLockedNilai',
            'allNilaiLocked'
        )
    );
}

public function simpanNilai(Request $request)
{
    $matkul = MataKuliah::where('kode_mk', $request->kode_mk)->first();

    if ($matkul && Nilai::isProdiFullyLocked($matkul->kode_prodi)) {
        return back()->with(
            'error',
            'Nilai program studi ini telah dikunci oleh KPS.'
        );
    }

    if (Nilai::where('kode_mk', $request->kode_mk)
        ->whereIn('nim', $request->nim ?? [])
        ->get()
        ->contains(fn ($nilai) => $nilai->isLocked())) {
        return back()->with(
            'error',
            'Nilai telah dikunci oleh KPS.'
        );
    }

    $wasSaved = Nilai::where('kode_mk', $request->kode_mk)
        ->whereIn('nim', $request->nim ?? [])
        ->exists();

    $savedCount = 0;

    foreach ($request->nim as $i => $nim) {
        $components = [
            'keaktifan' => $this->parseNilaiComponent($request->keaktifan[$i] ?? null),
            'proyek'    => $this->parseNilaiComponent($request->proyek[$i] ?? null),
            'tugas'     => $this->parseNilaiComponent($request->tugas[$i] ?? null),
            'kuis'      => $this->parseNilaiComponent($request->kuis[$i] ?? null),
            'uts'       => $this->parseNilaiComponent($request->uts[$i] ?? null),
            'uas'       => $this->parseNilaiComponent($request->uas[$i] ?? null),
        ];

        if ($this->isNilaiRowEmpty($components)) {
            Nilai::where('nim', $nim)
                ->where('kode_mk', $request->kode_mk)
                ->where(function ($query) {
                    $query->where('kunci_nilai', 0)
                        ->orWhereNull('kunci_nilai');
                })
                ->delete();

            continue;
        }

        $grade = $this->hitungNilai($components);

        $existing = Nilai::where('nim', $nim)
            ->where('kode_mk', $request->kode_mk)
            ->first();

        $payload = array_merge($grade, [
            'nim' => $nim,
            'kode_mk' => $request->kode_mk,
        ]);

        if (! $existing) {
            $payload['status'] = 'Pending';
            $payload['kunci_nilai'] = 0;
        } elseif ($this->nilaiBerubah($existing, $grade)) {
            $payload['status'] = 'Pending';
            $payload['kunci_nilai'] = 0;
        }

        Nilai::updateOrCreate(
            [
                'nim' => $nim,
                'kode_mk' => $request->kode_mk,
            ],
            $payload
        );

        $savedCount++;
    }

    if ($savedCount === 0) {
        return back()->with(
            'error',
            'Tidak ada nilai yang disimpan. Isi minimal satu komponen nilai pada baris mahasiswa.'
        );
    }

    $matkul = MataKuliah::where('kode_mk', $request->kode_mk)->first();
    LogAktivitas::catat(
        'Menginput nilai mahasiswa — ' . ($matkul->nama_mk ?? $request->kode_mk)
    );

    $message = $wasSaved
        ? 'Perubahan nilai berhasil disimpan.'
        : 'Nilai berhasil disimpan.';

    return back()->with('success', $message);
}

    public function hapusNilai($nim)
    {
        // Nonaktif untuk dosen — rollback: hapus blok guard ini
        return back()->with(
            'error',
            'Penghapusan nilai tidak diizinkan. Gunakan Edit Nilai untuk memperbaiki data.'
        );

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

        $matkul = MataKuliah::where('kode_mk', $request->kode_mk)->first();

        if ($matkul && Nilai::isProdiFullyLocked($matkul->kode_prodi)) {
            return back()->with(
                'error',
                'Nilai program studi ini telah dikunci oleh KPS.'
            );
        }

        if (Nilai::where('kode_mk', $request->kode_mk)
            ->get()
            ->contains(fn ($nilai) => $nilai->isLocked())) {
            return back()->with(
                'error',
                'Nilai telah dikunci oleh KPS.'
            );
        }

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
    $dosen = auth()->user();

$matkul = $this->matkulQueryFor($dosen)->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'dosen.pdf_kelas',
        compact('matkul')
    );

    return $pdf->download('Daftar_Kelas_Dosen.pdf');
}

    private function parseNilaiComponent(mixed $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (float) $value;
    }

    private function isNilaiRowEmpty(array $components): bool
    {
        return collect($components)->every(fn ($value) => $value === null);
    }

    private function isNilaiRowAllZero(array $components): bool
    {
        return collect($components)->every(fn ($value) => (float) $value === 0.0);
    }

    private function nilaiBerubah(Nilai $existing, array $grade): bool
    {
        foreach (['keaktifan', 'proyek', 'tugas', 'kuis', 'uts', 'uas'] as $field) {
            if ((float) $existing->{$field} !== (float) $grade[$field]) {
                return true;
            }
        }

        return false;
    }

    private function hitungNilai(array $components): array
    {
        $keaktifan = $components['keaktifan'] ?? 0;
        $proyek    = $components['proyek'] ?? 0;
        $tugas     = $components['tugas'] ?? 0;
        $kuis      = $components['kuis'] ?? 0;
        $uts       = $components['uts'] ?? 0;
        $uas       = $components['uas'] ?? 0;

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

        return [
            'teamwork'    => $keaktifan,
            'keaktifan'   => $keaktifan,
            'laporan'     => $tugas,
            'proyek'      => $proyek,
            'tugas'       => $tugas,
            'kuis'        => $kuis,
            'uts'         => $uts,
            'uas'         => $uas,
            'nilai_akhir' => round($nilaiAkhir, 2),
            'nilai_huruf' => $huruf,
            'index_nilai' => $index,
        ];
    }

    private function resolveNilaiMkStatus($nims, $nilais, ?string $kodeProdi = null): string
    {
        if ($nims->isEmpty()) {
            return 'belum_peserta';
        }

        if ($kodeProdi && Nilai::isProdiFullyLocked($kodeProdi)) {
            return 'terkunci';
        }

        if ($nilais->isNotEmpty() && $nilais->every(fn ($nilai) => $nilai->isLocked())) {
            return 'terkunci';
        }

        if ($nilais->count() < $nims->count()) {
            return 'belum_input';
        }

        if ($nilais->contains(fn ($nilai) => $nilai->status === 'Ditolak')) {
            return 'ditolak';
        }

        if ($nilais->contains(fn ($nilai) => in_array($nilai->status, ['Pending', 'Menunggu Approval'], true))) {
            return 'pending';
        }

        if ($nilais->every(fn ($nilai) => $nilai->status === 'Disetujui')) {
            return 'disetujui';
        }

        return 'pending';
    }

    private function matkulQueryFor($dosen)
    {
        $aliases = array_unique(array_filter([
            $dosen->name,
            rtrim(trim((string) $dosen->name), '.'),
        ]));

        if ($dosen->nuptk) {
            $namaDosen = Dosen::where('nuptk', $dosen->nuptk)->value('nama');

            if ($namaDosen) {
                $aliases[] = $namaDosen;
            }
        }

        return MataKuliah::query()->where(function ($query) use ($aliases) {
            foreach ($aliases as $alias) {
                $query->orWhere('dosen', $alias)
                    ->orWhere('dosen', 'like', $alias . '%');
            }
        });
    }
}