@extends('layouts.admin')

@section('content')

<h1 class="page-title">
    Dashboard
</h1>

<div class="card-wrapper">

    <div class="card">
        <i class="fa fa-users fa-2x"></i>
        <h2>11,329</h2>
        <p>Total Mahasiswa Aktif</p>
    </div>

    <div class="card">
        <i class="fa fa-user fa-2x"></i>
        <h2>98</h2>
        <p>Total Dosen Aktif</p>
    </div>

    <div class="card">
        <i class="fa fa-school fa-2x"></i>
        <h2>84</h2>
        <p>Kelas Aktif</p>
    </div>

    <div class="card">
        <i class="fa fa-file fa-2x"></i>
        <h2>86</h2>
        <p>Pengajuan KRS</p>
    </div>

</div>

<div class="table-box">

    <h2 style="margin-bottom:20px;">
        Aktivitas Terbaru
    </h2>

    <table>

        <tr>
            <th>Waktu</th>
            <th>Aktivitas</th>
            <th>Detail</th>
            <th>Oleh</th>
        </tr>

        <tr>
            <td>10 Mei 2026</td>
            <td>Persetujuan KRS</td>
            <td>KRS disetujui</td>
            <td>Admin</td>
        </tr>

        <tr>
            <td>10 Mei 2026</td>
            <td>Input Nilai</td>
            <td>Nilai Basis Data</td>
            <td>Dosen</td>
        </tr>

    </table>

</div>

@endsection