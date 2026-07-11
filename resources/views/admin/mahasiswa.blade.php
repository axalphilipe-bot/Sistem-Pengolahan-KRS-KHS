@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-page">

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
                <i class="fa-solid fa-user-graduate"></i>
                Data Mahasiswa
            </h1>
            <p>Kelola seluruh data mahasiswa Politeknik Negeri Batam — tambah, edit, import, dan export data.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total Mahasiswa</small>
            <strong>{{ $totalMahasiswa }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total Terdaftar</small>
                <strong>{{ $totalMahasiswa }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-list"></i>
            </div>
            <div class="mini-stat-info">
                <small>Ditampilkan</small>
                <strong>{{ $mahasiswa->count() }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="mini-stat-info">
                <small>Halaman</small>
                <strong>{{ $mahasiswa->currentPage() }}/{{ $mahasiswa->lastPage() }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="panel-toolbar">
        <div class="toolbar-left">
            <a href="/admin/mahasiswa/create" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i>
                Tambah Mahasiswa
            </a>

            <button type="button" class="btn-secondary-custom" onclick="document.getElementById('fileMahasiswa').click();">
                <i class="fa-solid fa-file-import"></i>
                Import
            </button>

            <a href="{{ route('admin.mahasiswa.template') }}" class="btn-template-custom">
                <i class="fa-solid fa-file-arrow-down"></i>
                Template Excel
            </a>

            <a href="{{ route('admin.mahasiswa.export', request()->only('search', 'prodi')) }}" class="btn-success-custom">
                <i class="fa-solid fa-file-excel"></i>
                Export
            </a>
        </div>

        <form method="GET" action="{{ url('/admin/mahasiswa') }}" class="toolbar-filters">
            <select name="prodi" class="filter-prodi-modern" onchange="this.form.submit()">
                <option value="">Semua Prodi</option>
                @foreach($prodiList as $p)
                    <option value="{{ $p->kode_prodi }}" {{ ($prodiFilter ?? '') == $p->kode_prodi ? 'selected' : '' }}>
                        {{ $p->nama_prodi }}
                    </option>
                @endforeach
            </select>

            <input
                type="text"
                name="search"
                class="search-modern"
                placeholder="Cari NIM, Nama, Prodi..."
                value="{{ $search }}">
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <form
        action="{{ route('admin.mahasiswa.import') }}"
        method="POST"
        enctype="multipart/form-data"
        id="formImportMahasiswa"
        style="display:none;">
        @csrf
        <input
            type="file"
            id="fileMahasiswa"
            name="file"
            accept=".xlsx,.xls"
            onchange="document.getElementById('formImportMahasiswa').submit();">
    </form>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Mahasiswa</h3>
            <span class="result-info">
                Menampilkan <strong>{{ $mahasiswa->firstItem() ?? 0 }}–{{ $mahasiswa->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $mahasiswa->total() }}</strong> data
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </span>
        </div>

        @if($mahasiswa->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-user-slash"></i>
                <h4>Tidak ada data mahasiswa</h4>
                <p>
                    @if(request('search'))
                        Tidak ditemukan mahasiswa dengan kata kunci "{{ request('search') }}".
                    @else
                        Belum ada mahasiswa terdaftar. Tambahkan data mahasiswa baru.
                    @endif
                </p>
                <a href="/admin/mahasiswa/create" class="btn-primary-custom">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Mahasiswa
                </a>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Kelas</th>
                            <th>Huruf</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $m)
                            <tr>
                                <td>{{ ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $m->nama }}</div>
                                        <div class="student-nim">{{ $m->nim }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="prodi-tag">
                                        {{ $m->prodi->nama_prodi ?? $m->kode_prodi }}
                                    </span>
                                </td>
                                <td>{{ $m->kelas }}</td>
                                <td>{{ $m->kelas_huruf ?? '-' }}</td>
                                <td>
                                    <span class="semester-badge">{{ $m->semester }}</span>
                                </td>
                                <td>
                                    <span class="status-active">
                                        <i class="fa-solid fa-circle"></i>
                                        Aktif
                                    </span>
                                </td>
                                <td>
                                    <div class="action-group">
                                        <a href="/admin/mahasiswa/{{ $m->nim }}" class="btn-icon btn-view" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="/admin/mahasiswa/{{ $m->nim }}/edit" class="btn-icon btn-edit" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="/admin/mahasiswa/{{ $m->nim }}/hapus" class="btn-icon btn-delete" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
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
                    Halaman {{ $mahasiswa->currentPage() }} dari {{ $mahasiswa->lastPage() }}
                </span>
                <div class="pagination-wrapper">
                    {{ $mahasiswa->onEachSide(1)->links() }}
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
