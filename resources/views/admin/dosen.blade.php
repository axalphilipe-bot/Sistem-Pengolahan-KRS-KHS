@extends('layouts.admin')

@section('content')

<div class="admin-page dosen-page">

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
                <i class="fa-solid fa-chalkboard-user"></i>
                Data Dosen
            </h1>
            <p>Kelola seluruh data dosen Politeknik Negeri Batam — tambah, edit, import, dan export data.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total Dosen</small>
            <strong>{{ $totalDosen }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total Terdaftar</small>
                <strong>{{ $totalDosen }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-list"></i>
            </div>
            <div class="mini-stat-info">
                <small>Ditampilkan</small>
                <strong>{{ $dosen->count() }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="mini-stat-info">
                <small>Halaman</small>
                <strong>{{ $dosen->currentPage() }}/{{ $dosen->lastPage() }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="panel-toolbar">
        <div class="toolbar-left">
            <a href="/admin/dosen/create" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i>
                Tambah Dosen
            </a>

            <button type="button" class="btn-secondary-custom" onclick="document.getElementById('fileDosen').click();">
                <i class="fa-solid fa-file-import"></i>
                Import
            </button>

            <a href="{{ route('admin.dosen.template') }}" class="btn-template-custom">
                <i class="fa-solid fa-file-arrow-down"></i>
                Template Excel
            </a>

            <a href="{{ route('admin.dosen.export', request()->only('search')) }}" class="btn-success-custom">
                <i class="fa-solid fa-file-excel"></i>
                Export
            </a>
        </div>

        <form method="GET" action="{{ url('/admin/dosen') }}" class="search-form">
            <input
                type="text"
                name="search"
                class="search-modern"
                placeholder="Cari NUPTK, Nama, Prodi..."
                value="{{ request('search') }}">
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <form
        action="{{ route('admin.dosen.import') }}"
        method="POST"
        enctype="multipart/form-data"
        id="formImportDosen"
        style="display:none;">
        @csrf
        <input
            type="file"
            name="file"
            id="fileDosen"
            accept=".xlsx,.xls"
            onchange="document.getElementById('formImportDosen').submit();">
    </form>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Dosen</h3>
            <span class="result-info">
                Menampilkan <strong>{{ $dosen->firstItem() ?? 0 }}–{{ $dosen->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $dosen->total() }}</strong> data
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </span>
        </div>

        @if($dosen->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-user-slash"></i>
                <h4>Tidak ada data dosen</h4>
                <p>
                    @if(request('search'))
                        Tidak ditemukan dosen dengan kata kunci "{{ request('search') }}".
                    @else
                        Belum ada dosen terdaftar. Tambahkan data dosen baru.
                    @endif
                </p>
                <a href="/admin/dosen/create" class="btn-primary-custom">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Dosen
                </a>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Program Studi</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dosen as $d)
                            <tr>
                                <td>{{ ($dosen->currentPage() - 1) * $dosen->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $d->nama }}</div>
                                        <div class="student-nim">{{ $d->nuptk }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="prodi-tag">
                                        {{ $d->prodi->nama_prodi ?? $d->kode_prodi }}
                                    </span>
                                </td>
                                <td>
                                    @if($d->jabatan)
                                        <span class="jabatan-tag">{{ $d->jabatan }}</span>
                                    @else
                                        <span class="text-muted">–</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-active">
                                        <i class="fa-solid fa-circle"></i>
                                        Aktif
                                    </span>
                                </td>
                                <td>
                                    <div class="action-group">
                                        <a href="/admin/dosen/{{ $d->nuptk }}" class="btn-icon btn-view" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="/admin/dosen/{{ $d->nuptk }}/edit" class="btn-icon btn-edit" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="/admin/dosen/{{ $d->nuptk }}/hapus" class="btn-icon btn-delete" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus dosen ini?')">
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
                    Halaman {{ $dosen->currentPage() }} dari {{ $dosen->lastPage() }}
                </span>
                <div class="pagination-wrapper">
                    {{ $dosen->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var search = document.querySelector('.search-modern');
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
