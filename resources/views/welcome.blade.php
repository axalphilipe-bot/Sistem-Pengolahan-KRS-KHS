<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem KRS & KHS</title>

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo"></div>
    <a href="{{ route('login') }}" class="btn-login">Login</a>
</div>

<!-- HERO -->
<div class="hero">
    <h1>SISTEM KRS & KHS</h1>
    <p>Sistem Pengelolaan Studi Mahasiswa</p>
</div>

<!-- PENGUMUMAN -->
<div class="section">
    <h2>Pengumuman Akademik</h2>

    <div class="wel-card">
        <span>10 Mei 2026</span>
        <p>Pengajuan KRS Semester Ganjil Dibuka</p>
    </div>

    <div class="wel-card">
        <span>12 Mei 2026</span>
        <p>Validasi Nilai Semester Genap</p>
    </div>
</div>
</body>
</html>

@include('contact')