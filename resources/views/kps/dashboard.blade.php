@extends('kps.layout')

@section('title', 'Dashboard')

@section('content')

<div class="kps-dashboard">

    {{-- Hero --}}
    <div class="kps-dashboard-hero">
        <div class="kps-hero-circle kps-hero-circle-1"></div>
        <div class="kps-hero-circle kps-hero-circle-2"></div>

        <div class="kps-hero-content">
            <span class="kps-hero-badge">
                <i class="fa-solid fa-user-tie"></i>
                Panel KPS
            </span>
            <h1>Dashboard KPS</h1>
            <p>
                Selamat datang, <strong>{{ auth()->user()->name ?? 'KPS' }}</strong>.
                Kelola proses validasi nilai, penguncian nilai,
                dan monitoring aktivitas akademik program studi.
            </p>
        </div>

        <div class="kps-hero-date">
            <span>Hari ini</span>
            <h3>{{ now()->translatedFormat('d F Y') }}</h3>
            <small>Semester 2025 / 2026 Genap</small>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="kps-dashboard-stats">

        <a href="/kps/approve" class="kps-dash-stat-card">
            <div class="kps-dash-stat-left">
                <div class="kps-dash-stat-icon yellow">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="kps-dash-stat-info">
                    <small>Pending Validasi</small>
                    <h2 class="kps-count-up" data-target="{{ $menunggu }}">0</h2>
                </div>
            </div>
            <div class="kps-dash-stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/kps/approve" class="kps-dash-stat-card">
            <div class="kps-dash-stat-left">
                <div class="kps-dash-stat-icon green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="kps-dash-stat-info">
                    <small>Sudah Disetujui</small>
                    <h2 class="kps-count-up" data-target="{{ $disetujui }}">0</h2>
                </div>
            </div>
            <div class="kps-dash-stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/kps/kunci" class="kps-dash-stat-card">
            <div class="kps-dash-stat-left">
                <div class="kps-dash-stat-icon red">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="kps-dash-stat-info">
                    <small>Nilai Terkunci</small>
                    <h2 class="kps-count-up" data-target="{{ $terkunci }}">0</h2>
                </div>
            </div>
            <div class="kps-dash-stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

    </div>

    {{-- Quick actions + Ringkasan --}}
    <div class="kps-dashboard-grid">

        <div class="kps-dash-panel">
            <div class="kps-dash-panel-header">
                <h3><i class="fa-solid fa-bolt"></i> Aksi Cepat</h3>
            </div>

            <div class="kps-quick-actions">
                <a href="/kps/approve" class="kps-quick-action">
                    <i class="fa-solid fa-circle-check"></i>
                    Validasi Nilai
                </a>
                <a href="/kps/kunci" class="kps-quick-action">
                    <i class="fa-solid fa-lock"></i>
                    Kunci Nilai
                </a>
                <a href="/kps/laporan" class="kps-quick-action">
                    <i class="fa-solid fa-file-lines"></i>
                    Laporan Nilai
                </a>
                <a href="/kps/approve" class="kps-quick-action">
                    <i class="fa-solid fa-list-check"></i>
                    Review Pending
                </a>
            </div>
        </div>

        <div class="kps-dash-panel">
            <div class="kps-dash-panel-header">
                <h3><i class="fa-solid fa-clipboard-list"></i> Ringkasan</h3>
            </div>

            <div class="kps-summary-list">
                <div class="kps-summary-item">
                    <div class="kps-summary-icon warning">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div class="kps-summary-text">
                        <strong>{{ $menunggu }}</strong>
                        <span>Nilai Menunggu Validasi</span>
                    </div>
                </div>

                <div class="kps-summary-item">
                    <div class="kps-summary-icon success">
                        <i class="fa-solid fa-check-double"></i>
                    </div>
                    <div class="kps-summary-text">
                        <strong>{{ $disetujui }}</strong>
                        <span>Nilai Disetujui</span>
                    </div>
                </div>

                <div class="kps-summary-item">
                    <div class="kps-summary-icon danger">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="kps-summary-text">
                        <strong>{{ $terkunci }}</strong>
                        <span>Nilai Terkunci</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Aktivitas terbaru --}}
    <div class="kps-modern-table">
        <div class="kps-dash-panel-header">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> Aktivitas Terbaru</h3>
            <a href="/kps/approve" class="kps-panel-link">
                Lihat Semua
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        @if($aktivitas->isEmpty())
            <div class="kps-empty-state">
                <i class="fa-solid fa-inbox"></i>
                <p>Belum ada aktivitas nilai yang disetujui.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aktivitas as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->translatedFormat('d M Y, H:i') }}</td>
                            <td>
                                <strong>{{ $item->nama_mahasiswa ?? $item->nim }}</strong>
                                <br>
                                <small class="kps-td-muted">{{ $item->nim }}</small>
                            </td>
                            <td>
                                <strong>{{ $item->nama_mk ?? $item->kode_mk }}</strong>
                                @if($item->nama_mk)
                                    <br><small class="kps-td-muted">{{ $item->kode_mk }}</small>
                                @endif
                            </td>
                            <td>
                                @if($item->status === 'Disetujui')
                                    <span class="kps-status-badge approved">Disetujui</span>
                                @elseif($item->status === 'Ditolak')
                                    <span class="kps-status-badge rejected">Ditolak</span>
                                @elseif(in_array($item->status, ['Pending', 'Menunggu Approval']))
                                    <span class="kps-status-badge pending">Pending</span>
                                @else
                                    <span class="kps-status-badge pending">{{ $item->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof countUp !== 'undefined' && countUp.CountUp) {
        document.querySelectorAll('.kps-count-up').forEach(function (el) {
            var target = parseInt(el.dataset.target, 10) || 0;
            var counter = new countUp.CountUp(el, target, { duration: 1.5, separator: '.' });
            if (!counter.error) counter.start();
        });
    } else {
        document.querySelectorAll('.kps-count-up').forEach(function (el) {
            el.textContent = el.dataset.target;
        });
    }
});
</script>
@endpush
