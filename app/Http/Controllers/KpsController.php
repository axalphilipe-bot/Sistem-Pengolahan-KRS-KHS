<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanNilaiExport;

class KpsController extends Controller
{
    private function nilaiBelumDikunci($query)
    {
        return $query->where(function ($q) {
            $q->where('kunci_nilai', 0)
                ->orWhereNull('kunci_nilai');
        });
    }

    private function nilaiQuery()
    {
        return DB::table('nilais')
            ->join('mahasiswa', 'nilais.nim', '=', 'mahasiswa.nim')
            ->join('mata_kuliahs', 'nilais.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->select(
                'nilais.*',
                'mahasiswa.nama as nama_mahasiswa',
                'mata_kuliahs.nama_mk'
            )
            ->orderByDesc('nilais.updated_at');
    }

    public function dashboard()
    {
        $menunggu = DB::table('nilais')
            ->whereIn('status', ['Pending', 'Menunggu Approval'])
            ->count();

        $disetujui = DB::table('nilais')
            ->where('status', 'Disetujui')
            ->count();

        $terkunci = DB::table('nilais')
            ->where('kunci_nilai', 1)
            ->count();

        $aktivitas = $this->nilaiQuery()
            ->where('nilais.status', 'Disetujui')
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
        $nilais = $this->nilaiQuery()
            ->orderBy('mahasiswa.nama')
            ->orderBy('mata_kuliahs.nama_mk')
            ->get();

        $mahasiswaList = $nilais->groupBy('nim')->map(function ($group, $nim) {
            $first = $group->first();

            return (object) [
                'nim' => $nim,
                'nama' => $first->nama_mahasiswa ?? '-',
                'jumlah_mk' => $group->count(),
                'nilais' => $group,
                'status' => $this->resolveStudentValidationStatus($group),
                'can_act' => $group->contains(function ($item) {
                    if (Nilai::isLockedValue($item->kunci_nilai)) {
                        return false;
                    }

                    return in_array($item->status, ['Pending', 'Menunggu Approval', 'Ditolak'], true);
                }),
                'first_kode_mk' => $first->kode_mk,
                'ringkasan' => $group->map(fn ($item) => $item->nama_mk ?? $item->kode_mk)->implode(', '),
                'search_text' => strtolower(implode(' ', $group->flatMap(fn ($item) => [
                    $nim,
                    $first->nama_mahasiswa ?? '',
                    $item->nama_mk ?? '',
                    $item->kode_mk ?? '',
                ])->unique()->all())),
            ];
        })->values();

        $adaDisetujuiBelumDikunci = $nilais
            ->where('status', 'Disetujui')
            ->contains(fn ($item) => ! Nilai::isLockedValue($item->kunci_nilai));

        return view('kps.approve', compact(
            'nilais',
            'mahasiswaList',
            'adaDisetujuiBelumDikunci'
        ));
    }

    public function setujui(string $nim, string $kode_mk)
    {
        $updated = $this->nilaiBelumDikunci(
            DB::table('nilais')
                ->where('nim', $nim)
                ->whereIn('status', ['Pending', 'Menunggu Approval'])
        )->update([
                'status' => 'Disetujui',
                'updated_at' => now(),
            ]);

        if ($updated === 0) {
            return redirect('/kps/approve')
                ->with('error', 'Tidak ada nilai Pending yang dapat disetujui untuk mahasiswa ini.');
        }

        return redirect('/kps/approve')
            ->with('success', "Berhasil menyetujui {$updated} nilai mahasiswa.");
    }

    public function tolak(string $nim, string $kode_mk)
    {
        $updated = $this->nilaiBelumDikunci(
            DB::table('nilais')
                ->where('nim', $nim)
        )->update([
                'status' => 'Ditolak',
                'updated_at' => now(),
            ]);

        if ($updated === 0) {
            return redirect('/kps/approve')
                ->with('error', 'Nilai mahasiswa tidak dapat ditolak karena sudah terkunci atau tidak ditemukan.');
        }

        return redirect('/kps/approve')
            ->with('success', "Berhasil menolak {$updated} nilai mahasiswa.");
    }

    public function kunciSemua()
    {
        $updated = $this->nilaiBelumDikunci(
            DB::table('nilais')->where('status', 'Disetujui')
        )->update([
                'kunci_nilai' => 1,
                'tanggal_kunci' => now(),
                'updated_at' => now(),
            ]);

        if ($updated === 0) {
            return redirect('/kps/approve')
                ->with('error', 'Tidak ada nilai Disetujui yang siap dikunci.');
        }

        return redirect('/kps/approve')
            ->with('success', "Berhasil mengunci {$updated} nilai yang telah disetujui.");
    }

    public function kunci()
    {
        $prodis = DB::table('prodi')
            ->leftJoin('mahasiswa', 'prodi.kode_prodi', '=', 'mahasiswa.kode_prodi')
            ->leftJoin('nilais', function ($join) {
                $join->on('mahasiswa.nim', '=', 'nilais.nim')
                    ->where('nilais.status', 'Disetujui');
            })
            ->select(
                'prodi.kode_prodi',
                'prodi.nama_prodi',
                DB::raw('COUNT(nilais.id) as jumlah_nilai'),
                DB::raw('SUM(CASE WHEN nilais.kunci_nilai = 1 THEN 1 ELSE 0 END) as jumlah_terkunci')
            )
            ->groupBy('prodi.kode_prodi', 'prodi.nama_prodi')
            ->orderBy('prodi.nama_prodi')
            ->get()
            ->map(function ($prodi) {
                $prodi->jumlah_nilai = (int) $prodi->jumlah_nilai;
                $prodi->jumlah_terkunci = (int) $prodi->jumlah_terkunci;
                $prodi->status_kunci = $prodi->jumlah_nilai > 0
                    && $prodi->jumlah_terkunci === $prodi->jumlah_nilai
                    ? 'terkunci'
                    : 'belum_dikunci';

                return $prodi;
            });

        $nilais = DB::table('nilais')
            ->where('status', 'Disetujui')
            ->get();

        $terkunci = $nilais
            ->filter(fn ($item) => Nilai::isLockedValue($item->kunci_nilai))
            ->count();

        $belumTerkunci = $nilais->count() - $terkunci;
        $total = $nilais->count();

        return view('kps.kunci', compact(
            'prodis',
            'terkunci',
            'belumTerkunci',
            'total'
        ));
    }

    public function lock(string $kode_prodi)
    {
        $nims = DB::table('mahasiswa')
            ->where('kode_prodi', $kode_prodi)
            ->pluck('nim');

        if ($nims->isEmpty()) {
            return redirect()->back()
                ->with('error', 'Program studi tidak ditemukan atau belum memiliki mahasiswa.');
        }

        $updated = $this->nilaiBelumDikunci(
            DB::table('nilais')
                ->whereIn('nim', $nims)
                ->where('status', 'Disetujui')
        )->update([
            'kunci_nilai' => 1,
            'tanggal_kunci' => now(),
            'updated_at' => now(),
        ]);

        if ($updated === 0) {
            return redirect()->back()
                ->with('error', 'Tidak ada nilai Disetujui yang siap dikunci pada program studi ini.');
        }

        $prodi = DB::table('prodi')->where('kode_prodi', $kode_prodi)->value('nama_prodi');

        return redirect()->back()
            ->with('success', "Berhasil mengunci {$updated} nilai pada {$prodi}.");
    }

    public function unlock(string $kode_prodi)
    {
        $nims = DB::table('mahasiswa')
            ->where('kode_prodi', $kode_prodi)
            ->pluck('nim');

        if ($nims->isEmpty()) {
            return redirect()->back()
                ->with('error', 'Program studi tidak ditemukan atau belum memiliki mahasiswa.');
        }

        $updated = DB::table('nilais')
            ->whereIn('nim', $nims)
            ->update([
                'kunci_nilai' => 0,
                'tanggal_kunci' => null,
                'updated_at' => now(),
            ]);

        if ($updated === 0) {
            return redirect()->back()
                ->with('error', 'Tidak ada nilai yang dapat dibuka kuncinya pada program studi ini.');
        }

        $prodi = DB::table('prodi')->where('kode_prodi', $kode_prodi)->value('nama_prodi');

        return redirect()->back()
            ->with('success', "Berhasil membuka kunci {$updated} nilai pada {$prodi}.");
    }

    public function laporan(Request $request)
    {
        $query = DB::table('nilais')
            ->join('mata_kuliahs', 'nilais.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->join('mahasiswa', 'nilais.nim', '=', 'mahasiswa.nim')
            ->join('prodi', 'mahasiswa.kode_prodi', '=', 'prodi.kode_prodi')
            ->where('nilais.status', 'Disetujui');

        if (
            $request->semester != '' &&
            $request->semester != 'Semua Semester'
        ) {
            $query->where(
                'mata_kuliahs.semester',
                strtolower($request->semester)
            );
        }

        if (
            $request->prodi != '' &&
            $request->prodi != 'Semua Program Studi'
        ) {
            $query->where(
                'prodi.nama_prodi',
                $request->prodi
            );
        }

        $data = $query->select(
            'nilais.*',
            'mata_kuliahs.nama_mk',
            'mata_kuliahs.dosen as dosen_pengampu',
            'mata_kuliahs.semester as semester_mk',
            'mahasiswa.nama as nama_mahasiswa',
            'prodi.nama_prodi'
        )
            ->orderBy('prodi.nama_prodi')
            ->orderBy('mata_kuliahs.nama_mk')
            ->orderBy('mahasiswa.nama')
            ->get();

        $total = $data->count();
        $disetujui = $data->count();
        $terkunci = $data
            ->filter(fn ($item) => Nilai::isLockedValue($item->kunci_nilai))
            ->count();
        $belumTerkunci = $total - $terkunci;

        return view('kps.laporan', compact(
            'data',
            'total',
            'disetujui',
            'terkunci',
            'belumTerkunci'
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
                DB::raw('mata_kuliahs.dosen as nama_dosen'),
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

    public function detailNilai(string $nim, string $kode_mk)
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
            ->join(
                'prodi',
                'mahasiswa.kode_prodi',
                '=',
                'prodi.kode_prodi'
            )
            ->where('nilais.nim', $nim)
            ->where('nilais.kode_mk', $kode_mk)
            ->select(
                'nilais.*',
                'mata_kuliahs.nama_mk',
                'mata_kuliahs.dosen as dosen_pengampu',
                'mata_kuliahs.semester as semester_mk',
                'mahasiswa.nama',
                'prodi.nama_prodi'
            )
            ->first();

        if (! $nilai) {
            abort(404);
        }

        return view(
            'kps.detail_nilai',
            compact('nilai')
        );
    }

    private function resolveStudentValidationStatus($group): string
    {
        $items = collect($group);

        if ($items->every(fn ($item) => Nilai::isLockedValue($item->kunci_nilai))) {
            return 'locked';
        }

        $unlocked = $items->reject(fn ($item) => Nilai::isLockedValue($item->kunci_nilai));

        if ($unlocked->contains(fn ($item) => in_array($item->status, ['Pending', 'Menunggu Approval'], true))) {
            return 'pending';
        }

        if ($unlocked->every(fn ($item) => $item->status === 'Disetujui')) {
            return 'disetujui';
        }

        if ($unlocked->every(fn ($item) => $item->status === 'Ditolak')) {
            return 'ditolak';
        }

        return 'pending';
    }
}
