@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
        Log Aktivitas
    </h1>

    <p class="page-subtitle">
        Riwayat aktivitas pengguna sistem
    </p>

    <div class="stats-grid">

        <div class="stat-card">
            <h3>Total Aktivitas</h3>
            <h2>15</h2>
        </div>

        <div class="stat-card success">
            <h3>Hari Ini</h3>
            <h2>8</h2>
        </div>

        <div class="stat-card warning">
            <h3>Dosen</h3>
            <h2>4</h2>
        </div>

        <div class="stat-card danger">
            <h3>Mahasiswa</h3>
            <h2>3</h2>
        </div>

    </div>

    <div class="table-wrapper">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Aktivitas</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>18-06-2026 20:00</td>
                    <td>Axal Phillipe Samuel</td>
                    <td>Admin</td>
                    <td>Menyetujui Pengajuan KRS</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>18-06-2026 20:05</td>
                    <td>Hilda Widyastuti</td>
                    <td>Dosen</td>
                    <td>Menginput Nilai Mahasiswa</td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>18-06-2026 20:10</td>
                    <td>Ananda Shadiva Wansa</td>
                    <td>Mahasiswa</td>
                    <td>Mengajukan KRS</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection