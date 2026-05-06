@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Pengaturan</h1>

    <p class="page-subtitle">
        Pengaturan Umum Sistem
    </p>

    <div class="setting-card">

        <div class="setting-row">
            <label>Nama Sistem</label>
            <input type="text" value="Sistem KRS & KHS">
        </div>

        <div class="setting-row">
            <label>Nama Institusi</label>
            <input type="text" value="Politeknik Negeri Batam">
        </div>

        <div class="setting-row">
            <label>Tahun Akademik Aktif</label>
            <input type="text" value="2025/2026">
        </div>

        <div class="setting-row">
            <label>Maksimal SKS per semester</label>
            <input type="text" value="24">
        </div>

        <div class="setting-row">
            <label>Batas Akhir Pengajuan KRS</label>
            <input type="text" value="21 Mei 2025">
        </div>

    </div>

</div>

@endsection