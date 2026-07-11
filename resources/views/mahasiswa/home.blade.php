@extends('layouts.mahasiswa')

@section('content')

<div class="mhs-dashboard">

    {{-- Hero --}}
    <div class="dashboard-hero">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-graduation-cap"></i>
                Portal Mahasiswa
            </span>
            <h1>Selamat Datang, {{ $mahasiswa->nama }}</h1>
            <p>
                Kelola KRS, lihat KHS, dan pantau perkembangan akademik Anda
                melalui Sistem Pengelolaan KRS & KHS Polibatam.
            </p>
        </div>

        <div class="hero-date">
            <span>Semester Aktif</span>
            <h3>{{ $mahasiswa->semester }}</h3>
            <small>2025 / 2026 Genap</small>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="stats-grid">

        <a href="/krs" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div class="stat-info">
                    <small>Total KRS</small>
                    <h2 class="count-up" data-target="{{ $totalKrs }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/krs" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon green">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="stat-info">
                    <small>Total SKS</small>
                    <h2 class="count-up" data-target="{{ $totalSks }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/khs" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon orange">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="stat-info">
                    <small>IPS</small>
                    <h2>{{ number_format($ips, 2) }}</h2>
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
                <a href="/krs" class="quick-action">
                    <i class="fa-solid fa-file-signature"></i>
                    Ajukan KRS
                </a>
                <a href="/khs" class="quick-action">
                    <i class="fa-solid fa-file-lines"></i>
                    Lihat KHS
                </a>
                <a href="/profil" class="quick-action">
                    <i class="fa-solid fa-user"></i>
                    Profil Saya
                </a>
                <a href="/panduan" class="quick-action">
                    <i class="fa-solid fa-circle-question"></i>
                    Panduan
                </a>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3><i class="fa-solid fa-clipboard-list"></i> Ringkasan Akademik</h3>
            </div>

            <div class="summary-list">
                <div class="summary-item">
                    <div class="summary-icon blue">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="summary-text">
                        <strong>{{ $mahasiswa->semester }}</strong>
                        <span>Semester Aktif</span>
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

                <div class="summary-item">
                    <div class="summary-icon warning">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="summary-text">
                        <strong>{{ $krsPending }}</strong>
                        <span>KRS Menunggu</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Profil --}}
    <div class="profile-panel">
        <div class="panel-header">
            <h3><i class="fa-solid fa-id-card"></i> Data Diri Mahasiswa</h3>
            <a href="/profil" class="panel-link">
                Lihat Profil
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="profile-body">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar">
                    {{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}
                </div>
                <div class="profile-avatar-info">
                    <strong>{{ $mahasiswa->nama }}</strong>
                    <span>{{ $mahasiswa->nim }}</span>
                    <div class="status-tag">Aktif</div>
                </div>
            </div>

            <div class="profile-grid">
                <div class="profile-item">
                    <i class="fa-solid fa-building-columns"></i>
                    <div>
                        <small>Program Studi</small>
                        <strong>{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</strong>
                    </div>
                </div>

                <div class="profile-item">
                    <i class="fa-solid fa-users"></i>
                    <div>
                        <small>Kelas</small>
                        <strong>{{ $mahasiswa->kelas ?? '-' }}</strong>
                    </div>
                </div>

                <div class="profile-item">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <div>
                        <small>Jenjang</small>
                        <strong>{{ $mahasiswa->jenjang ?? '-' }}</strong>
                    </div>
                </div>

                <div class="profile-item">
                    <i class="fa-solid fa-envelope"></i>
                    <div>
                        <small>Email</small>
                        <strong>{{ $mahasiswa->email ?? '-' }}</strong>
                    </div>
                </div>

                <div class="profile-item">
                    <i class="fa-solid fa-phone"></i>
                    <div>
                        <small>No HP</small>
                        <strong>{{ auth()->user()->no_hp ?? '-' }}</strong>
                    </div>
                </div>

                <div class="profile-item">
                    <i class="fa-solid fa-calendar-days"></i>
                    <div>
                        <small>Semester</small>
                        <strong>{{ $mahasiswa->semester }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Info --}}
    <div class="info-banner">
        <i class="fa-solid fa-circle-info"></i>
        <span>
            Silakan lengkapi data diri terlebih dahulu di menu
            <a href="/profil">Profil</a>
            sebelum melakukan pengajuan KRS.
        </span>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>
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
