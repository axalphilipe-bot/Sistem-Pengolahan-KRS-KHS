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
    <div class="alert-box">
        Silakan lengkapi data diri terlebih dahulu di menu
        <b>PROFIL</b> sebelum melakukan pengajuan.
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
                   NIM : 3312401020
                </p>

                <p>
                    <span>Nama</span>
                   NAMA : Ananda Shadiva Wansa
                </p>

                <p>
                    <span>No HP</span>
                   No HP : 081234567890
                </p>

                <p>
                    <span>Email</span>
                   EMAIL : shadiva@student.ac.id
                </p>

                <p>
                    <span>Program Studi</span>
                   Program Studi : Teknik Informatika
                </p>

                <p>
                    <span>Status</span>
                   Status : Aktif
                </p>

                <p>
                    <span>Kelas</span>
                   Kelas : TI-2A
                </p>

                <p>
                    <span>Jenjang</span>
                   Jenjang : D4
                </p>

                <p>
                    <span>Semester</span>
                   Semester : 2
                </p>

            </div>

        </div>

    </div>

</div>

@endsection