@extends('layouts.admin')

@section('content')

<div class="admin-page krs-pengajuan-page">

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
                <i class="fa-solid fa-file-signature"></i>
                Pengelolaan KRS
            </span>
            <h1>
                <i class="fa-solid fa-clipboard-list"></i>
                Pengajuan KRS
            </h1>
            <p>Monitoring pengajuan KRS mahasiswa (read-only). Persetujuan dilakukan oleh Dosen Wali.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total Pengajuan</small>
            <strong>{{ $totalPengajuan }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats mini-stats-4">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total Pengajuan</small>
                <strong>{{ $totalPengajuan }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="mini-stat-info">
                <small>Pending</small>
                <strong>{{ $totalPending }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="mini-stat-info">
                <small>Disetujui</small>
                <strong>{{ $totalDisetujui }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon slate">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="mini-stat-info">
                <small>Ditolak</small>
                <strong>{{ $totalDitolak }}</strong>
            </div>
        </div>
    </div>

    {{-- Search --}}
    <div class="panel-toolbar">
        <div class="toolbar-note">
            <i class="fa-solid fa-circle-info"></i>
            Halaman ini hanya untuk monitoring. Gunakan panel Dosen Wali untuk persetujuan KRS.
        </div>

        <form method="GET" action="/admin/krs" class="search-form">
            <input
                type="text"
                name="search"
                class="search-modern"
                placeholder="Cari NIM atau nama mahasiswa..."
                value="{{ request('search') }}">
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Pengajuan KRS</h3>
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
                <i class="fa-solid fa-file-circle-xmark"></i>
                <h4>Tidak ada pengajuan KRS</h4>
                <p>
                    @if(request('search'))
                        Tidak ditemukan pengajuan dengan kata kunci "{{ request('search') }}".
                    @else
                        Belum ada mahasiswa yang mengajukan KRS.
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
                            <th>Program Studi</th>
                            <th>Semester</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($krs as $item)
                            <tr>
                                <td>{{ $krs->firstItem() + $loop->index }}</td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $item->mahasiswa->nama ?? '–' }}</div>
                                        <div class="student-nim">{{ $item->nim }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="prodi-tag">
                                        {{ $item->mahasiswa->prodi->nama_prodi ?? $item->mahasiswa->kode_prodi ?? '–' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="semester-badge">{{ $item->mahasiswa->semester ?? '–' }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                <td>
                                    @if($item->status == 'Pending')
                                        <span class="krs-status krs-status-pending">Pending</span>
                                    @elseif($item->status == 'Disetujui')
                                        <span class="krs-status krs-status-approved">Disetujui</span>
                                    @else
                                        <span class="krs-status krs-status-rejected">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-group">
                                        <a href="/admin/krs/{{ $item->nim }}" class="btn-icon btn-view" title="Detail">
                                            <i class="fa-solid fa-eye"></i>
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
