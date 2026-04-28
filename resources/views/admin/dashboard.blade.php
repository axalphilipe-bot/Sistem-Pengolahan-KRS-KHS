@extends('layouts.app')

@section('content')
<div class="admin-content">

<h2>Dashboard</h2>

<div class="card-box">
    <div class="card">
        <h3>11,329</h3>
        <p>Total Mahasiswa</p>
    </div>

    <div class="card">
        <h3>98</h3>
        <p>Total Dosen</p>
    </div>

    <div class="card">
        <h3>84</h3>
        <p>Kelas Aktif</p>
    </div>

    <div class="card">
        <h3>86</h3>
        <p>Menunggu KRS</p>
    </div>
</div>

<h3>Aktivitas Terbaru</h3>

<table class="table-admin">
    <tr>
        <th>Waktu</th>
        <th>Aktivitas</th>
        <th>Detail</th>
        <th>Oleh</th>
    </tr>

    <tr>
        <td>10 Mei 2026</td>
        <td>Persetujuan KRS</td>
        <td>KRS Mahasiswa</td>
        <td>Admin</td>
    </tr>
</table>

</div>
@endsection