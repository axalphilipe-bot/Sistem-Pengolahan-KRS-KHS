@extends('layouts.app')

@section('content')

    <div class="home-container">

        <!-- BANNER -->
        <div class="welcome-banner">
            <span class="badge">KRS-KHS</span>
            <h1>Selamat Datang di Sistem KRS & KHS</h1>
            <p>Anda dapat mengelola studi secara online</p>
        </div>

        <!-- NOTIF -->
        <div class="alert-box">
            Silakan lengkapi data diri terlebih dahulu di menu <b>PROFIL</b> sebelum melakukan pengajuan.
        </div>

    
        <div class="profile-box">

            <div class="profile-left">
                <img src="{{ asset('img/foto.jpg') }}" alt="Foto">
            </div>

            <div class="profile-right">
                <h3>DATA DIRI MAHASISWA</h3>

                <table>
                    <p>NIM : {{ auth()->user()?->nim ?? '-' }}</p>
                    <p>Nama : {{ auth()->user()?->name ?? '-' }}</p>
                    <p>No HP : {{ auth()->user()?->no_hp ?? '-' }}</p>
                    <p>Email : {{ auth()->user()?->email ?? '-' }}</p>
                    <p>Prodi : {{ auth()->user()?->prodi ?? '-' }}</p>
                    <p>Status : {{ auth()->user()?->status ?? '-' }}</p>
                    <p>Kelas : {{ auth()->user()?->kelas ?? '-' }}</p>
                </table>

            </div>

        </div>

    </div>

@endsection