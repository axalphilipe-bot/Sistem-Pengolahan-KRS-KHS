<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem KRS & KHS | Politeknik Negeri Batam</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <a href="/" class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Polibatam">
        <div>
            <span class="logo-text">Politeknik Negeri Batam</span>
            <span class="logo-sub">Sistem KRS & KHS</span>
        </div>
    </a>
    <a href="{{ route('login') }}" class="btn-login">
        <i class="fa-solid fa-right-to-bracket"></i>
        Login
    </a>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <span class="hero-badge">
            <i class="fa-solid fa-graduation-cap"></i>
            Portal Akademik Mahasiswa
        </span>
        <h1>SISTEM KRS & KHS</h1>
        <p class="hero-subtitle">Sistem Pengelolaan Studi Mahasiswa Politeknik Negeri Batam</p>
        <div class="hero-actions">
            <a href="{{ route('login') }}" class="btn-hero-primary">
                <i class="fa-solid fa-right-to-bracket"></i>
                Masuk ke Sistem
            </a>
            <a href="#pengumuman" class="btn-hero-secondary">
                <i class="fa-solid fa-bullhorn"></i>
                Lihat Pengumuman
            </a>
        </div>
    </div>
    <a href="#pengumuman" class="scroll-hint">
        <span>Gulir ke bawah</span>
        <i class="fa-solid fa-chevron-down"></i>
    </a>
</section>

<!-- FITUR RINGKAS -->
<div class="features-strip">
    <div class="features-inner">
        <div class="feature-item">
            <i class="fa-solid fa-file-pen"></i>
            <h4>Pengisian KRS</h4>
            <p>Ajukan mata kuliah semester secara online</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-chart-line"></i>
            <h4>Lihat KHS</h4>
            <p>Pantau nilai dan IP semester Anda</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-user-check"></i>
            <h4>Validasi Dosen</h4>
            <p>Proses persetujuan KRS oleh dosen wali</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-shield-halved"></i>
            <h4>Aman & Terintegrasi</h4>
            <p>Data akademik terkelola dengan baik</p>
        </div>
    </div>
</div>

<!-- PENGUMUMAN -->
<section class="section" id="pengumuman">
    <div class="section-header">
        <span class="section-tag">Informasi</span>
        <h2>Pengumuman Akademik</h2>
        <p>Informasi terbaru seputar kegiatan akademik dan jadwal penting</p>
    </div>

    <div class="announcement-grid">
        <article class="wel-card">
            <div class="wel-card-icon">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="wel-card-body">
                <span class="wel-card-date">
                    <i class="fa-regular fa-calendar"></i>
                    10 Mei 2026
                </span>
                <p>Pengajuan KRS Semester Ganjil Dibuka</p>
            </div>
        </article>

        <article class="wel-card">
            <div class="wel-card-icon">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div class="wel-card-body">
                <span class="wel-card-date">
                    <i class="fa-regular fa-calendar"></i>
                    12 Mei 2026
                </span>
                <p>Validasi Nilai Semester Genap</p>
            </div>
        </article>
    </div>
</section>

@include('contact')

<footer class="footer">
    <div class="footer-logo">
        <img src="{{ asset('img/logo.png') }}" alt="Polibatam">
        <strong>Politeknik Negeri Batam</strong>
    </div>
    <p>&copy; {{ date('Y') }} Sistem KRS & KHS. All rights reserved.</p>
</footer>

<script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
