@extends('layouts.admin')

@section('content')

<div class="admin-dashboard">

    {{-- Hero --}}
    <div class="dashboard-hero">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-shield-halved"></i>
                Panel Administrator
            </span>
            <h1>Dashboard Admin</h1>
            <p>
                Selamat datang kembali, Administrator.
                Kelola data mahasiswa, dosen, mata kuliah, KRS, dan KHS
                melalui Sistem Pengelolaan KRS & KHS secara lebih mudah dan efisien.
            </p>
        </div>

        <div class="hero-date">
            <span>Hari ini</span>
            <h3>{{ now()->translatedFormat('d F Y') }}</h3>
            <small>Semester 2025 / 2026 Genap</small>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="stats-grid">

        <a href="/admin/mahasiswa" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="stat-info">
                    <small>Total Mahasiswa</small>
                    <h2 class="count-up" data-target="{{ $totalMahasiswa }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/admin/dosen" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon green">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div class="stat-info">
                    <small>Total Dosen</small>
                    <h2 class="count-up" data-target="{{ $totalDosen }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/admin/matkul" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon orange">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="stat-info">
                    <small>Mata Kuliah</small>
                    <h2 class="count-up" data-target="{{ $totalMatkul }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/admin/krs" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon red">
                    <i class="fa-solid fa-file-circle-check"></i>
                </div>
                <div class="stat-info">
                    <small>Pengajuan KRS</small>
                    <h2 class="count-up" data-target="{{ $totalKrs }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

    </div>

    {{-- Quick actions + Ringkasan --}}
    <div class="dashboard-grid">

        <div class="panel">
            <div class="panel-header">
                <h3><i class="fa-solid fa-bolt"></i> Aksi Cepat</h3>
            </div>

            <div class="quick-actions">
                <a href="/admin/mahasiswa/create" class="quick-action">
                    <i class="fa-solid fa-user-plus"></i>
                    Tambah Mahasiswa
                </a>
                <a href="/admin/dosen/create" class="quick-action">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    Tambah Dosen
                </a>
                <a href="/admin/matkul/create" class="quick-action">
                    <i class="fa-solid fa-book-medical"></i>
                    Tambah Matkul
                </a>
                <a href="/admin/krs-approve" class="quick-action">
                    <i class="fa-solid fa-circle-check"></i>
                    Persetujuan KRS
                </a>
                <a href="/admin/laporan-krs" class="quick-action">
                    <i class="fa-solid fa-chart-column"></i>
                    Laporan KRS
                </a>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3><i class="fa-solid fa-clipboard-list"></i> Ringkasan</h3>
            </div>

            <div class="summary-list">
                <div class="summary-item">
                    <div class="summary-icon warning">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="summary-text">
                        <strong>{{ $krsPending }}</strong>
                        <span>KRS Menunggu Persetujuan</span>
                    </div>
                </div>

                <div class="summary-item">
                    <div class="summary-icon success">
                        <i class="fa-solid fa-check-double"></i>
                    </div>
                    <div class="summary-text">
                        <strong>{{ $krsDisetujui }}</strong>
                        <span>KRS Disetujui</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Aktivitas terbaru --}}
    <div class="modern-table">
        <div class="panel-header">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> Pengajuan KRS Terbaru</h3>
            <a href="/admin/krs" class="panel-link">
                Lihat Semua
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        @if($recentKrs->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-inbox"></i>
                <p>Belum ada pengajuan KRS.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentKrs as $krs)
                        <tr>
                            <td>
                                <strong>{{ $krs->mahasiswa->nama ?? $krs->nim }}</strong>
                                <br>
                                <small style="color:#94a3b8;">{{ $krs->nim }}</small>
                            </td>
                            <td>
                                {{ $krs->mataKuliah->nama_mk ?? $krs->kode_mk }}
                            </td>
                            <td>
                                @if($krs->status === 'Disetujui')
                                    <span class="status-badge approved">Disetujui</span>
                                @elseif($krs->status === 'Ditolak')
                                    <span class="status-badge rejected">Ditolak</span>
                                @else
                                    <span class="status-badge pending">{{ $krs->status ?? 'Pending' }}</span>
                                @endif
                            </td>
                            <td>{{ $krs->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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
