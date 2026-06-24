@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
        Pengguna & Hak Akses
    </h1>

    <p class="page-subtitle">
        Kelola pengguna dan hak akses sistem
    </p>

    <!-- Statistik -->
    <div class="stats-grid">

        <div class="stat-card">
    <h3>Total User</h3>
    <h2>{{ $totalUser }}</h2>
</div>

<div class="stat-card success">
    <h3>Admin</h3>
    <h2>{{ $totalAdmin }}</h2>
</div>

<div class="stat-card warning">
    <h3>Dosen</h3>
    <h2>{{ $totalDosen }}</h2>
</div>

<div class="stat-card danger">
    <h3>Mahasiswa</h3>
    <h2>{{ $totalMahasiswa }}</h2>
</div>

    </div>

    <!-- Tombol -->
    <div class="filter-wrapper">

        <div class="action-wrapper">

            <button class="btn btn-primary">
                + Tambah Pengguna
            </button>

        </div>

        <div class="search-box">
            <input
                type="text"
                placeholder="Cari pengguna..."
            >
        </div>

    </div>

    <!-- Tabel -->
    <div class="table-wrapper">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

@foreach($users as $user)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $user->name }}</td>

    <td>{{ $user->email ?? '-' }}</td>

    <td>
        <span class="badge bg-primary">
            {{ ucfirst($user->role) }}
        </span>
    </td>

    <td>
        <span class="badge bg-success">
            Aktif
        </span>
    </td>

    <td>

        <button class="btn btn-warning btn-sm">
            Edit
        </button>

        <button class="btn btn-danger btn-sm">
            Hapus
        </button>

    </td>

</tr>

@endforeach

</tbody>
        </table>

    </div>

</div>

@endsection