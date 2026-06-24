@extends('layouts.mahasiswa')

@section('content')

<div class="home-container">

    <!-- BANNER -->
    <div class="welcome-banner">
        <span class="badge">KRS-KHS</span>

        <h1>
            Selamat Datang di Sistem KRS & KHS
        </h1>

        <p>
            Anda dapat mengelola studi secara online
        </p>
    </div>

    <!-- ALERT -->
    <!-- ALERT -->
<div class="alert-box">
    Silakan lengkapi data diri terlebih dahulu di menu
    <b>PROFIL</b> sebelum melakukan pengajuan.
</div>

<!-- STATISTIK -->
<div class="stats-container">

    <div class="stat-card">
        <h4>Total KRS</h4>
        <h2>{{ $totalKrs }}</h2>
    </div>

    <div class="stat-card">
        <h4>Total SKS</h4>
        <h2>{{ $totalSks }}</h2>
    </div>

    <div class="stat-card">
        <h4>IPS</h4>
        <h2>{{ number_format($ips, 2) }}</h2>
    </div>

</div>

<!-- PROFILE -->
<div class="profile-box">


        <!-- FOTO -->
        <div class="profile-left">
            <img src="{{ asset('img/foto.jpg') }}" alt="Foto">
        </div>

        <!-- DATA -->
        <div class="profile-right">

            <h3>DATA DIRI MAHASISWA</h3>

            <div class="profile-data">

                <p>
                    <span>NIM</span>
                   NIM : {{ $mahasiswa->nim }}
                </p>

                <p>
                    <span>Nama</span>
                   NAMA : {{ $mahasiswa->nama }}
                </p>

                <p>
                    <span>No HP</span>
                   No HP : 081234567890
                </p>

                <p>
                    <span>Email</span>
                   EMAIL : {{ $mahasiswa->email }}
                </p>

                <p>
                    <span>Program Studi</span>
                   Program Studi :{{ $mahasiswa->prodi->nama_prodi ?? '-' }}
                </p>

                <p>
                    <span>Status</span>
                   Status : Aktif
                </p>

                <p>
                    <span>Kelas</span>
                   Kelas : {{ $mahasiswa->kelas }}
                </p>

                <p>
                    <span>Jenjang</span>
                   Jenjang : {{ $mahasiswa->jenjang }}
                </p>

                <p>
                    <span>Semester</span>
                   Semester : {{ $mahasiswa->semester }}
                </p>

            </div>

        </div>

    </div>

</div>

@endsection