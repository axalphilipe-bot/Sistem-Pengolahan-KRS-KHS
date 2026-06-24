@extends('layouts.dosen')

@section('content')

<div class="panduan-container">

    <h2 class="panduan-title">Panduan</h2>
    <p class="panduan-sub">
        Berikut panduan penggunaan Sistem Pengelolaan KRS dan KHS untuk Dosen.
    </p>

    <div class="panduan-grid">

        <!-- KELAS SAYA -->
        <div class="panduan-card">
            <div class="badge blue">1</div>

            <h3>Kelas Saya</h3>

            <p>
                Lihat daftar mata kuliah yang Anda ampu beserta jumlah
                mahasiswa yang terdaftar pada setiap kelas.
            </p>

            <a href="/dosen" class="panduan-link">
                Lihat Kelas Saya →
            </a>
        </div>

        <!-- VALIDASI KRS -->
        <div class="panduan-card">
            <div class="badge green">2</div>

            <h3>Validasi KRS</h3>

            <p>
                Periksa dan setujui pengajuan KRS mahasiswa sebelum masa
                perkuliahan dimulai.
            </p>

            <a href="/dosen/validasi" class="panduan-link">
                Pelajari Validasi →
            </a>
        </div>

        <!-- INPUT NILAI -->
        <div class="panduan-card">
    <div class="badge purple">3</div>

    <h3>Input Nilai</h3>

    <p>
        Dosen dapat menginput nilai mahasiswa secara manual maupun melalui
        fitur import Excel. Sistem akan menghitung nilai akhir, nilai huruf,
        dan indeks nilai secara otomatis berdasarkan komposisi penilaian yang
        telah ditentukan.
    </p>

    <a href="/dosen" class="panduan-link">
        Pelajari Input Nilai →
    </a>
</div>

        <!-- EXPORT DATA -->
        <div class="panduan-card">
    <div class="badge orange">4</div>

    <h3>Export PDF</h3>

    <p>
        Fitur ini digunakan untuk mengunduh laporan daftar kelas dosen
        dalam format PDF yang siap dicetak atau disimpan sebagai arsip.
    </p>

    <a href="/dosen/kelas">
        Pelajari Export PDF →
    </a>
</div>
    </div>

    <div class="panduan-tips">
        Pastikan proses validasi KRS dilakukan tepat waktu agar mahasiswa
        dapat mengikuti perkuliahan sesuai jadwal yang telah ditetapkan.
    </div>

</div>

@endsection