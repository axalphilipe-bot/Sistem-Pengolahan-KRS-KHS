@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Pengaturan</h1>

    <p class="page-subtitle">
        Pengaturan Umum Sistem
    </p>

    <div class="stats-grid">

    <div class="stat-card">
        <h3>Tahun Aktif</h3>
        <h2>2025/2026</h2>
    </div>

    <div class="stat-card success">
        <h3>Maks SKS</h3>
        <h2>24</h2>
    </div>

    <div class="stat-card warning">
        <h3>Semester</h3>
        <h2>Genap</h2>
    </div>

</div>

<div class="setting-card">

    <form onsubmit="return simpanPengaturan()">

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
            <label>Maksimal SKS per Semester</label>
            <input type="number" value="24">
        </div>

        <div class="setting-row">
            <label>Batas Akhir Pengajuan KRS</label>
            <input type="date">
        </div>

        <div class="setting-row">
            <label>Status Sistem</label>

            <select>
                <option>Aktif</option>
                <option>Maintenance</option>
            </select>
        </div>

        <button type="submit" class="save-btn">
            Simpan Pengaturan
        </button>

    </form>

    </div>

</div>

<script>
function simpanPengaturan()
{
    alert('Pengaturan berhasil disimpan');
    return false;
}
</script>

@endsection