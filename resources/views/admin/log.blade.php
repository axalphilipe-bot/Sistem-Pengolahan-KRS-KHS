@extends('layouts.admin')

@section('content')

<div class="admin-page log-page">

    {{-- Hero --}}
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="page-hero-badge">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Audit Trail
            </span>
            <h1>
                <i class="fa-solid fa-list-check"></i>
                Log Aktivitas
            </h1>
            <p>Riwayat aktivitas pengguna sistem — login, pengajuan KRS, validasi nilai, dan perubahan data.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total Aktivitas</small>
            <strong>{{ $totalAktivitas }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats mini-stats-4">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-database"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total Log</small>
                <strong>{{ $totalAktivitas }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-calendar-day"></i>
            </div>
            <div class="mini-stat-info">
                <small>Hari Ini</small>
                <strong>{{ $hariIni }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="mini-stat-info">
                <small>Aktivitas Dosen</small>
                <strong>{{ $totalDosen }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon purple">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="mini-stat-info">
                <small>Aktivitas Mahasiswa</small>
                <strong>{{ $totalMahasiswa }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="panel-toolbar">
        <div class="toolbar-left">
            <span class="toolbar-label">
                <i class="fa-solid fa-filter"></i>
                Filter log aktivitas
            </span>
        </div>

        <form method="GET" action="{{ route('admin.log.index') }}" class="search-form">
            <input
                type="text"
                name="search"
                class="search-modern"
                placeholder="Cari pengguna, role, aktivitas..."
                value="{{ $search ?? '' }}">
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Riwayat Aktivitas</h3>
            <span class="result-info">
                Menampilkan <strong>{{ $logs->firstItem() ?? 0 }}–{{ $logs->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $logs->total() }}</strong> log
                @if($search)
                    untuk "<strong>{{ $search }}</strong>"
                @endif
            </span>
        </div>

        @if($logs->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-clipboard-list"></i>
                <h4>Belum ada log aktivitas</h4>
                <p>
                    @if($search)
                        Tidak ditemukan log dengan kata kunci "{{ $search }}".
                    @else
                        Aktivitas pengguna akan tercatat otomatis saat melakukan aksi di sistem.
                    @endif
                </p>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Pengguna</th>
                            <th>Role</th>
                            <th>Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ ($logs->currentPage() - 1) * $logs->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="log-time">
                                        <span>{{ $log->created_at->format('d-m-Y') }}</span>
                                        <small>{{ $log->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $log->nama_pengguna }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-{{ $log->role }}">
                                        {{ ucfirst($log->role) }}
                                    </span>
                                </td>
                                <td>{{ $log->aktivitas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <span class="pagination-info">
                    Halaman {{ $logs->currentPage() }} dari {{ $logs->lastPage() }}
                </span>
                <div class="pagination-wrapper">
                    {{ $logs->onEachSide(1)->links() }}
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
