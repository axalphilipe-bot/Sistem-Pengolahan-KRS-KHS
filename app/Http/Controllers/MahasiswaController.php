<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;

use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;
use App\Exports\MahasiswaTemplateExport;

class MahasiswaController extends Controller
{
 public function index(Request $request)
{
    $search = $request->search;
    $prodiFilter = $request->prodi;
    $totalMahasiswa = Mahasiswa::count();
    $prodiList = Prodi::orderBy('nama_prodi')->get();

    $mahasiswa = Mahasiswa::with('prodi')
        ->when($prodiFilter, fn ($query) => $query->where('kode_prodi', $prodiFilter))
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('kode_prodi', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%");
            });
        })
        ->orderBy('nim')
        ->paginate(10)
        ->withQueryString();

    return view('admin.mahasiswa', compact('mahasiswa', 'search', 'prodiFilter', 'prodiList', 'totalMahasiswa'));
}

    public function create()
    {
        $dosen = Dosen::orderBy('nama')->get();

        return view('admin.tambah_mahasiswa', compact('dosen'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nim' => 'required|digits:10|unique:mahasiswa,nim',
        'nama' => 'required|string|max:50',
        'email' => 'required|email|max:100',
        'kelas' => 'required|string|max:20',
        'kelas_huruf' => 'nullable|string|max:1',
        'jenjang' => 'required|string|max:10',
        'semester' => 'required|integer|min:1|max:14',
        'kode_prodi' => 'required|exists:prodi,kode_prodi',
        'nuptk_wali' => 'nullable|exists:dosen,nuptk',
    ], [
        'nim.digits' => 'NIM harus tepat 10 digit angka.',
        'nim.unique' => 'NIM sudah terdaftar.',
    ]);

    Mahasiswa::create([
        'nim' => $request->nim,
        'nama' => $request->nama,
        'email' => $request->email,
        'kelas' => $request->kelas,
        'kelas_huruf' => $request->kelas_huruf,
        'jenjang' => $request->jenjang,
        'semester' => $request->semester,
        'kode_prodi' => $request->kode_prodi,
        'nuptk_wali' => $request->filled('nuptk_wali') ? $request->nuptk_wali : null,
    ]);

    return redirect('/admin/mahasiswa')
        ->with('success', 'Mahasiswa berhasil ditambahkan.');
}
   public function show($id)
{
    $mahasiswa = Mahasiswa::with(['dosenWali', 'prodi'])->findOrFail($id);

    return view(
        'admin.detail_mahasiswa',
        compact('mahasiswa')
    );
}

public function edit($nim)
{
    $mahasiswa = Mahasiswa::findOrFail($nim);
    $dosen = Dosen::orderBy('nama')->get();

    return view(
        'admin.edit_mahasiswa',
        compact('mahasiswa', 'dosen')
    );
}

public function update(Request $request, $nim)
{
    $mahasiswa = Mahasiswa::findOrFail($nim);

    $request->validate([
        'nim' => 'required|digits:10|unique:mahasiswa,nim,' . $mahasiswa->nim . ',nim',
        'nama' => 'required|string|max:50',
        'email' => 'required|email|max:100',
        'kelas' => 'required|string|max:20',
        'kelas_huruf' => 'nullable|string|max:1',
        'jenjang' => 'required|string|max:10',
        'semester' => 'required|integer|min:1|max:14',
        'kode_prodi' => 'required|exists:prodi,kode_prodi',
        'nuptk_wali' => 'nullable|exists:dosen,nuptk',
    ], [
        'nim.digits' => 'NIM harus tepat 10 digit angka.',
        'nim.unique' => 'NIM sudah terdaftar.',
    ]);

    $mahasiswa->update([
    'nim' => $request->nim,
    'nama' => $request->nama,
    'email' => $request->email,
    'kelas' => $request->kelas,
    'kelas_huruf' => $request->input('kelas_huruf', $mahasiswa->kelas_huruf),
    'jenjang' => $request->jenjang,
    'semester' => $request->semester,
    'kode_prodi' => $request->kode_prodi,
    'nuptk_wali' => $request->filled('nuptk_wali') ? $request->nuptk_wali : null,
]);

    return redirect('/admin/mahasiswa')
        ->with('success', 'Data mahasiswa berhasil diperbarui.');
}
public function destroy($nim)
{
    $mahasiswa = Mahasiswa::findOrFail($nim);

    $mahasiswa->delete();

    return redirect('/admin/mahasiswa');
}
public function home()
{
    $mahasiswa = Mahasiswa::forAuthenticatedUser();

    if (!$mahasiswa) {
        return redirect('/login')->with(
            'error',
            'Data mahasiswa tidak ditemukan. Silakan hubungi administrator.'
        );
    }

    $totalKrs = \App\Models\Krs::where('nim', $mahasiswa->nim)->count();

    $totalSks = \App\Models\Krs::where('nim', $mahasiswa->nim)
        ->join('mata_kuliahs', 'krs.kode_mk', '=', 'mata_kuliahs.kode_mk')
        ->sum('mata_kuliahs.sks');

    $ips = \App\Models\Nilai::where('nim', $mahasiswa->nim)->avg('index_nilai') ?? 0;

    $krsPending = \App\Models\Krs::where('nim', $mahasiswa->nim)
        ->where('status', 'Pending')
        ->count();

    $krsDisetujui = \App\Models\Krs::where('nim', $mahasiswa->nim)
        ->where('status', 'Disetujui')
        ->count();

    return view(
        'mahasiswa.home',
        compact(
            'mahasiswa',
            'totalKrs',
            'totalSks',
            'ips',
            'krsPending',
            'krsDisetujui'
        )
    );
}
public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(
        new MahasiswaImport,
        $request->file('file')
    );

    return redirect('/admin/mahasiswa')
        ->with('success', 'Data mahasiswa berhasil diimport.');
}
public function export(Request $request)
{
    $search = $request->query('search');
    $prodi = $request->query('prodi');

    return Excel::download(
        new MahasiswaExport($search, $prodi),
        'Data_Mahasiswa_' . date('Y-m-d') . '.xlsx'
    );
}

public function downloadTemplate()
{
    return Excel::download(
        new MahasiswaTemplateExport,
        'Template_Import_Mahasiswa.xlsx'
    );
}
}