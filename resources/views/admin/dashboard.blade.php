@extends('layouts.admin')

@section('content')

<h1 class="page-title">
    Dashboard
</h1>

<div class="card-wrapper">

    <div class="card">
        <i class="fa fa-users fa-2x"></i>
        <h2>{{ $totalMahasiswa }}</h2>
        <p>Total Mahasiswa</p>
    </div>

    <div class="card">
        <i class="fa fa-user fa-2x"></i>
        <h2>{{ $totalDosen }}</h2>
        <p>Total Dosen</p>
    </div>

    <div class="card">
        <i class="fa fa-book fa-2x"></i>
        <h2>{{ $totalMatkul }}</h2>
        <p>Total Mata Kuliah</p>
    </div>

    <div class="card">
        <i class="fa fa-file fa-2x"></i>
        <h2>{{ $totalKrs }}</h2>
        <p>Pengajuan KRS</p>
    </div>

</div>

<div class="table-box">

    <h2 style="margin-bottom:20px;">
        Aktivitas Terbaru
    </h2>

    <table>

        <thead>
            <tr>
                <th>Waktu</th>
                <th>Aktivitas</th>
                <th>Detail</th>
                <th>Oleh</th>
            </tr>
        </thead>

        <tbody>

    <tr>
        <td>{{ now()->format('d M Y') }}</td>
        <td>Login Sistem</td>
        <td>Admin masuk ke sistem</td>
        <td>Admin</td>
    </tr>

</tbody>
    </table>

</div>

@endsection