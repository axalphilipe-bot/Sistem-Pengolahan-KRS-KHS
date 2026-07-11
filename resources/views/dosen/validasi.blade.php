@extends('layouts.dosen')

@section('content')

<div class="dosen-dashboard dosen-validasi">

    {{-- Hero --}}
    <div class="dashboard-hero">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-file-circle-check"></i>
                Validasi KRS
            </span>
            <h1>Validasi KRS Mahasiswa</h1>
            <p>
                Setujui atau tolak pengajuan KRS mahasiswa bimbingan Anda.
                Pastikan hanya mahasiswa yang memenuhi syarat yang disetujui.
            </p>
        </div>

        <div class="hero-date">
            <span>Semester Aktif</span>
            <h3>2025 / 2026</h3>
            <small>Genap</small>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="stats-grid stats-grid-4">

        <div class="stats-card stats-card-static">
            <div class="stat-left">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-inbox"></i>
                </div>
                <div class="stat-info">
                    <small>Total Pengajuan</small>
                    <h2 class="count-up" data-target="{{ $totalPengajuan }}">0</h2>
                </div>
            </div>
        </div>

        <div class="stats-card stats-card-static">
            <div class="stat-left">
                <div class="stat-icon orange">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="stat-info">
                    <small>Menunggu</small>
                    <h2 class="count-up" data-target="{{ $pending }}">0</h2>
                </div>
            </div>
        </div>

        <div class="stats-card stats-card-static">
            <div class="stat-left">
                <div class="stat-icon teal">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="stat-info">
                    <small>Disetujui</small>
                    <h2 class="count-up" data-target="{{ $disetujui }}">0</h2>
                </div>
            </div>
        </div>

        <div class="stats-card stats-card-static">
            <div class="stat-left">
                <div class="stat-icon red">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="stat-info">
                    <small>Ditolak</small>
                    <h2 class="count-up" data-target="{{ $ditolak }}">0</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Filter & Search --}}
    <div class="filter-panel">
        <form method="GET" action="/dosen/validasi" class="search-form">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari NIM, nama mahasiswa, atau mata kuliah..."
                >
            </div>
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <button type="submit" class="btn-search">Cari</button>
            @if(request('search') || request('status'))
                <a href="/dosen/validasi" class="btn-reset">Reset</a>
            @endif
        </form>

        <div class="filter-tabs">
            @php
                $currentStatus = request('status', 'all');
                $searchParam = request('search') ? '&search=' . urlencode(request('search')) : '';
            @endphp
            <a href="/dosen/validasi?status=all{{ $searchParam }}"
               class="filter-tab {{ $currentStatus === 'all' ? 'active' : '' }}">
                Semua <span>{{ $totalPengajuan }}</span>
            </a>
            <a href="/dosen/validasi?status=Pending{{ $searchParam }}"
               class="filter-tab {{ $currentStatus === 'Pending' ? 'active' : '' }}">
                Pending <span>{{ $pending }}</span>
            </a>
            <a href="/dosen/validasi?status=Disetujui{{ $searchParam }}"
               class="filter-tab {{ $currentStatus === 'Disetujui' ? 'active' : '' }}">
                Disetujui <span>{{ $disetujui }}</span>
            </a>
            <a href="/dosen/validasi?status=Ditolak{{ $searchParam }}"
               class="filter-tab {{ $currentStatus === 'Ditolak' ? 'active' : '' }}">
                Ditolak <span>{{ $ditolak }}</span>
            </a>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="modern-table">
        <div class="panel-header">
            <h3><i class="fa-solid fa-list-check"></i> Daftar Pengajuan KRS</h3>
            <span class="result-count">
                Total <strong>{{ $krs->total() }}</strong> data
            </span>
        </div>

        @if($krs->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-inbox"></i>
                <h4>Tidak ada data KRS</h4>
                <p>
                    @if(request('search') || request('status'))
                        Tidak ditemukan pengajuan KRS dengan filter yang dipilih.
                    @else
                        Belum ada pengajuan KRS dari mahasiswa bimbingan Anda.
                    @endif
                </p>
            </div>
        @else
            <div class="validasi-table-wrap">
            <table class="validasi-table">
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th class="col-nama">Nama</th>
                        <th class="col-nim">NIM</th>
                        <th class="col-mk">Mata Kuliah</th>
                        <th class="col-kode">Kode MK</th>
                        <th class="col-sem">Semester</th>
                        <th class="col-date">Tanggal</th>
                        <th class="col-status">Status</th>
                        <th class="col-action">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($krs as $item)
                        <tr>
                            <td class="col-no">{{ $krs->firstItem() + $loop->index }}</td>
                            <td class="col-nama">
                                <span class="cell-nama">{{ $item->mahasiswa->nama ?? '-' }}</span>
                            </td>
                            <td class="col-nim">
                                <span class="cell-nim">{{ $item->nim }}</span>
                            </td>
                            <td class="col-mk">
                                <span class="cell-mk">{{ $item->mataKuliah->nama_mk ?? '-' }}</span>
                            </td>
                            <td class="col-kode">
                                <span class="kode-tag">{{ $item->kode_mk }}</span>
                            </td>
                            <td class="col-sem">
                                <span class="semester-badge">
                                    {{ $item->mahasiswa->semester ?? '-' }}
                                </span>
                            </td>
                            <td class="col-date">{{ $item->created_at?->translatedFormat('d M Y') ?? '-' }}</td>
                            <td class="col-status">
                                @if($item->status === 'Disetujui')
                                    <span class="status-badge approved">Disetujui</span>
                                @elseif($item->status === 'Pending')
                                    <span class="status-badge pending">Pending</span>
                                @else
                                    <span class="status-badge rejected">Ditolak</span>
                                @endif
                            </td>
                            <td class="col-action">
                                @if($item->status === 'Pending')
                                    <div class="action-group">
                                        <a href="/dosen/krs/approve/{{ $item->id }}"
                                           class="btn-action btn-approve"
                                           onclick="return confirm('Setujui KRS {{ $item->mataKuliah->nama_mk ?? $item->kode_mk }} ini?')">
                                            <i class="fa-solid fa-check"></i>
                                            Setujui
                                        </a>
                                        <a href="/dosen/krs/reject/{{ $item->id }}"
                                           class="btn-action btn-reject"
                                           onclick="return confirm('Tolak KRS {{ $item->mataKuliah->nama_mk ?? $item->kode_mk }} ini?')">
                                            <i class="fa-solid fa-xmark"></i>
                                            Tolak
                                        </a>
                                    </div>
                                @elseif($item->status === 'Disetujui')
                                    <span class="action-done approved">
                                        <i class="fa-solid fa-check-circle"></i>
                                        Sudah Disetujui
                                    </span>
                                @else
                                    <span class="action-done rejected">
                                        <i class="fa-solid fa-ban"></i>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <div class="pagination-bar">
                <span class="pagination-info">
                    Menampilkan {{ $krs->firstItem() ?? 0 }} sampai {{ $krs->lastItem() ?? 0 }} dari {{ $krs->total() }} hasil
                </span>
                <div class="pagination-wrapper">
                    {{ $krs->onEachSide(1)->links('vendor.pagination.dosen') }}
                </div>
            </div>
        @endif
    </div>

    {{-- Info --}}
    <div class="info-banner">
        <i class="fa-solid fa-circle-info"></i>
        <span>Pastikan hanya mahasiswa yang memenuhi syarat akademik yang disetujui sebelum perkuliahan dimulai.</span>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof countUp !== 'undefined' && countUp.CountUp) {
        document.querySelectorAll('.count-up').forEach(function (el) {
            var target = parseInt(el.dataset.target, 10) || 0;
            var counter = new countUp.CountUp(el, target, { duration: 1.5, separator: '.' });
            if (!counter.error) counter.start();
        });
    } else {
        document.querySelectorAll('.count-up').forEach(function (el) {
            el.textContent = el.dataset.target;
        });
    }
});
</script>
@endpush
