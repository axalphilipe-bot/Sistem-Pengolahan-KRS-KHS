@extends('layouts.admin')

@section('content')

<div class="admin-page laporan-krs-page">

    {{-- Hero --}}
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="page-hero-badge">
                <i class="fa-solid fa-chart-column"></i>
                Laporan
            </span>
            <h1>
                <i class="fa-solid fa-file-lines"></i>
                Laporan KRS
            </h1>
            <p>Data seluruh pengajuan KRS mahasiswa Politeknik Negeri Batam.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total KRS</small>
            <strong>{{ $totalKrs }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats mini-stats-4">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total KRS</small>
                <strong>{{ $totalKrs }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="mini-stat-info">
                <small>Disetujui</small>
                <strong>{{ $disetujui }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon slate">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="mini-stat-info">
                <small>Ditolak</small>
                <strong>{{ $ditolak }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="mini-stat-info">
                <small>Menunggu</small>
                <strong>{{ $menunggu }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="panel-toolbar laporan-toolbar">
        <div class="toolbar-left">
            <a href="{{ url('/admin/laporan-krs/pdf?' . http_build_query(request()->only(['search', 'status']))) }}" class="btn-pdf-custom">
                <i class="fa-solid fa-file-pdf"></i>
                PDF
            </a>

            <a href="{{ url('/admin/laporan-krs/excel?' . http_build_query(request()->only(['search', 'status']))) }}" class="btn-success-custom">
                <i class="fa-solid fa-file-excel"></i>
                Export
            </a>
        </div>

        <form method="GET" action="/admin/laporan-krs" class="laporan-filter-form">
            <input
                type="text"
                name="search"
                class="search-modern"
                value="{{ request('search') }}"
                placeholder="Cari NIM atau nama mahasiswa...">

            <select name="status" class="filter-select">
                <option value="">Semua Status</option>
                <option value="Disetujui" @selected(request('status') == 'Disetujui')>Disetujui</option>
                <option value="Ditolak" @selected(request('status') == 'Ditolak')>Ditolak</option>
                <option value="Pending" @selected(request('status') == 'Pending')>Menunggu</option>
            </select>

            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Data Laporan KRS</h3>
            <span class="result-info">
                Menampilkan <strong>{{ $krs->firstItem() ?? 0 }}–{{ $krs->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $krs->total() }}</strong> data
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </span>
        </div>

        @if($krs->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-folder-open"></i>
                <h4>Tidak ada data KRS</h4>
                <p>
                    @if(request()->hasAny(['search', 'status']))
                        Tidak ditemukan data dengan filter yang dipilih.
                    @else
                        Belum ada data pengajuan KRS.
                    @endif
                </p>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($krs as $item)
                            <tr>
                                <td>{{ ($krs->currentPage() - 1) * $krs->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $item->mahasiswa->nama ?? '–' }}</div>
                                        <div class="student-nim">{{ $item->nim }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="kode-tag">{{ $item->kode_mk }}</span>
                                    @if($item->mataKuliah)
                                        <div class="mk-sub">{{ $item->mataKuliah->nama_mk }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 'Disetujui')
                                        <span class="krs-status krs-status-approved">Disetujui</span>
                                    @elseif($item->status == 'Ditolak')
                                        <span class="krs-status krs-status-rejected">Ditolak</span>
                                    @else
                                        <span class="krs-status krs-status-pending">Menunggu</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <span class="pagination-info">
                    Halaman {{ $krs->currentPage() }} dari {{ $krs->lastPage() }}
                </span>
                <div class="pagination-wrapper">
                    {{ $krs->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var search = document.querySelector('.laporan-filter-form .search-modern');
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
