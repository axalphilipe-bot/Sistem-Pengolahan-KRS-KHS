@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
        Laporan KRS
    </h1>

    <p class="page-subtitle">
        Data seluruh pengajuan KRS mahasiswa
    </p>

    <div class="stats-grid">

    <div class="stat-card">
        <h3>Total KRS</h3>
        <h2>{{ $totalKrs }}</h2>
    </div>

    <div class="stat-card success">
        <h3>Disetujui</h3>
        <h2>{{ $disetujui }}</h2>
    </div>

    <div class="stat-card danger">
        <h3>Ditolak</h3>
        <h2>{{ $ditolak }}</h2>
    </div>

    <div class="stat-card warning">
        <h3>Menunggu</h3>
        <h2>{{ $menunggu }}</h2>
    </div>

</div>

    <form method="GET">

        <div class="filter-wrapper">

            <div class="action-wrapper">

    <a href="/admin/laporan-krs/pdf" class="btn-pdf">
    <i class="fa-solid fa-file-pdf"></i>
    PDF
</a>

<a href="/admin/laporan-krs/excel" class="btn-excel">
    <i class="fa-solid fa-file-excel"></i>
    Excel
</a>

</div>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari NIM..."
                >
            </div>

            <select
                name="status"
                class="filter-select"
                onchange="this.form.submit()"
            >
                <option value="">
                    Semua Status
                </option>

                <option value="Disetujui">
                    Disetujui
                </option>

                <option value="Ditolak">
                    Ditolak
                </option>

                <option value="Menunggu Approval">
                    Menunggu Approval
                </option>

            </select>

        </div>

    </form>

    <div class="table-wrapper">

        <table class="custom-table">

            <thead>

                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>

            </thead>

            <tbody>

                @forelse($krs as $item)

                <tr>

                    <td>{{ $item->nim }}</td>

                    <td>
                        {{ $item->mahasiswa->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->kode_mk }}
                    </td>

                    <td>

@if($item->status == 'Disetujui')

    <span class="badge-success">
        Disetujui
    </span>

@elseif($item->status == 'Ditolak')

    <span class="badge-danger">
        Ditolak
    </span>

@else

    <span class="badge-warning">
        Menunggu
    </span>

@endif

</td>

                    <td>

</td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">
                        Tidak ada data
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection