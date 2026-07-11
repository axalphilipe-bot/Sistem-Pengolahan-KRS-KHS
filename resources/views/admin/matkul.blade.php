@extends('layouts.admin')

@section('content')

<div class="admin-page matkul-page">

    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error-custom">
            <i class="fa-solid fa-circle-xmark"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Hero --}}
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="page-hero-badge">
                <i class="fa-solid fa-database"></i>
                Manajemen Data
            </span>
            <h1>
                <i class="fa-solid fa-book-open"></i>
                Mata Kuliah
            </h1>
            <p>Kelola seluruh data mata kuliah Politeknik Negeri Batam — tambah, edit, import, export, dan filter data.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total Matkul</small>
            <strong>{{ $totalMatkul }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total Mata Kuliah</small>
                <strong>{{ $totalMatkul }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total SKS</small>
                <strong>{{ $totalSks }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="mini-stat-info">
                <small>Halaman</small>
                <strong>{{ $matkul->currentPage() }}/{{ $matkul->lastPage() }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="panel-toolbar">
        <div class="toolbar-left">
            <a href="/admin/matkul/create" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i>
                Tambah Mata Kuliah
            </a>

            <button type="button" class="btn-secondary-custom" onclick="document.getElementById('fileMatkul').click();">
                <i class="fa-solid fa-file-import"></i>
                Import
            </button>

            <a href="{{ route('admin.matkul.template') }}" class="btn-template-custom">
                <i class="fa-solid fa-file-arrow-down"></i>
                Template Excel
            </a>

            <a href="{{ route('admin.matkul.export', request()->only(['search', 'prodi', 'semester', 'jenis'])) }}" class="btn-success-custom">
                <i class="fa-solid fa-file-excel"></i>
                Export
            </a>
        </div>
    </div>

    <form
        action="{{ route('admin.matkul.import') }}"
        method="POST"
        enctype="multipart/form-data"
        id="formImportMatkul"
        style="display:none;">
        @csrf
        <input
            type="file"
            id="fileMatkul"
            name="file"
            accept=".xlsx,.xls"
            onchange="document.getElementById('formImportMatkul').submit();">
    </form>

    {{-- Filter --}}
    <div class="filter-panel">
        <form action="/admin/matkul" method="GET">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kode atau nama mata kuliah..."
                class="search-modern">

            <select name="prodi" class="filter-select">
                <option value="">Semua Prodi</option>
                @foreach($prodi as $p)
                    <option value="{{ $p->kode_prodi }}" @selected(request('prodi') == $p->kode_prodi)>
                        {{ $p->nama_prodi ?? $p->kode_prodi }}
                    </option>
                @endforeach
            </select>

            <select name="semester" class="filter-select">
                <option value="">Semua Semester</option>
                <option value="ganjil" @selected(request('semester') == 'ganjil')>Ganjil</option>
                <option value="genap" @selected(request('semester') == 'genap')>Genap</option>
            </select>

            <select name="jenis" class="filter-select">
                <option value="">Semua Jenis</option>
                <option value="wajib" @selected(request('jenis') == 'wajib')>Wajib</option>
                <option value="pilihan" @selected(request('jenis') == 'pilihan')>Pilihan</option>
            </select>

            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Mata Kuliah</h3>
            <span class="result-info">
                Menampilkan <strong>{{ $matkul->firstItem() ?? 0 }}–{{ $matkul->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $matkul->total() }}</strong> data
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </span>
        </div>

        @if($matkul->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-book"></i>
                <h4>Tidak ada data mata kuliah</h4>
                <p>
                    @if(request()->hasAny(['search', 'prodi', 'semester', 'jenis']))
                        Tidak ditemukan mata kuliah dengan filter yang dipilih.
                    @else
                        Belum ada mata kuliah terdaftar. Tambahkan data mata kuliah baru.
                    @endif
                </p>
                <a href="/admin/matkul/create" class="btn-primary-custom">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Mata Kuliah
                </a>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Prodi</th>
                            <th>Semester</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matkul as $m)
                            <tr>
                                <td>{{ ($matkul->currentPage() - 1) * $matkul->perPage() + $loop->iteration }}</td>
                                <td>
                                    <span class="kode-tag">{{ $m->kode_mk }}</span>
                                </td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $m->nama_mk }}</div>
                                        @if($m->dosen)
                                            <div class="student-nim">{{ $m->dosen }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="sks-badge">{{ $m->sks }} SKS</span>
                                </td>
                                <td>
                                    <span class="prodi-tag">
                                        {{ $m->prodi->nama_prodi ?? $m->kode_prodi }}
                                    </span>
                                </td>
                                <td>
                                    <span class="semester-badge">{{ ucfirst($m->semester ?? '–') }}</span>
                                </td>
                                <td>
                                    @if($m->jenis)
                                        <span class="jenis-badge {{ strtolower($m->jenis) }}">{{ ucfirst($m->jenis) }}</span>
                                    @else
                                        <span class="text-muted">–</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-group">
                                        <a href="/admin/matkul/{{ $m->kode_mk }}" class="btn-icon btn-view" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="/admin/matkul/{{ $m->kode_mk }}/edit" class="btn-icon btn-edit" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="/admin/matkul/{{ $m->kode_mk }}/hapus" class="btn-icon btn-delete" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <span class="pagination-info">
                    Halaman {{ $matkul->currentPage() }} dari {{ $matkul->lastPage() }}
                </span>
                <div class="pagination-wrapper">
                    {{ $matkul->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var search = document.querySelector('.filter-panel .search-modern');
    if (!search) return;

    var timer;
    search.addEventListener('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            search.form.submit();
        }, 400);
    });
});
</script>
@endpush

@endsection
