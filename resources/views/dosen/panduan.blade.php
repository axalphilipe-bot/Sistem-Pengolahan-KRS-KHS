@extends('layouts.dosen')

@section('content')
<div class="panduan-container">

    <h2 class="panduan-title">Panduan</h2>
    <p class="panduan-sub">Berikut panduan penggunaan sistem KRS untuk Dosen.</p>

    <div class="panduan-grid">

        <div class="panduan-card">
            <div class="badge blue">1</div>
            <h3>Kelas Saya</h3>
            <p>Lihat daftar kelas yang Anda ampu beserta jumlah mahasiswa dan status validasi.</p>
            <a href="/dosen/kelas">Lihat Kelas Saya →</a>
        </div>

        <div class="panduan-card">
            <div class="badge green">2</div>
            <h3>Validasi KRS</h3>
            <p>Periksa dan setujui KRS mahasiswa sebelum masa perkuliahan dimulai.</p>
            <a href="/dosen/validasi">Pelajari Validasi →</a>
        </div>
        <div class="panduan-card">
            <div class="badge purple">3</div>
            <h3>Input Nilai</h3>
            <p>Masukkan nilai mahasiswa setelah proses perkuliahan selesai.</p>
            <a href="/dosen/nilai">Pelajari Input Nilai →</a>
        </div>

   
        <div class="panduan-card">
            <div class="badge orange">4</div>
            <h3>Export Data</h3>
            <p>Unduh rekap KRS atau daftar mahasiswa ke format PDF.</p>
            <a href="#">Pelajari Export →</a>
        </div>

    </div>

    <div class="panduan-tips">
        💡 Pastikan Anda melakukan validasi KRS tepat waktu agar mahasiswa dapat mengikuti perkuliahan.
    </div>

</div>
@endsection