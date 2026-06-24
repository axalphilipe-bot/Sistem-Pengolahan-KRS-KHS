@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
        Laporan KHS
    </h1>

    <p class="page-subtitle">
        Data seluruh nilai mahasiswa
    </p>

    <div class="stats-grid">

        <div class="stat-card">
            <h3>Total Nilai</h3>
            <h2>{{ $totalKhs }}</h2>
        </div>

        <div class="stat-card success">
            <h3>Nilai A</h3>
            <h2>{{ $nilaiA }}</h2>
        </div>

        <div class="stat-card warning">
            <h3>Nilai B</h3>
            <h2>{{ $nilaiB }}</h2>
        </div>

        <div class="stat-card danger">
            <h3>C / D / E</h3>
            <h2>{{ $nilaiCD }}</h2>
        </div>

    </div>

    <form method="GET">

    <div class="filter-wrapper">

        <div class="action-wrapper">

            <a href="{{ url('/admin/laporan-khs/pdf') }}" class="btn-pdf">
                <i class="fa-solid fa-file-pdf"></i>
                PDF
            </a>

            <a href="{{ url('/admin/laporan-khs/excel') }}" class="btn-excel">
                <i class="fa-solid fa-file-excel"></i>
                Excel
            </a>

        </div>

           <div class="search-box">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari NIM..."
    >


</div>

            <select
                name="nilai_huruf"
                class="filter-select"
                onchange="this.form.submit()"
            >
                <option value="">
                    Semua Nilai
                </option>

                <option value="A">
                    A
                </option>

                <option value="B">
                    B
                </option>

                <option value="C">
                    C
                </option>

                <option value="D">
                    D
                </option>

                <option value="E">
                    E
                </option>

            </select>

        </div>

    </form>

<div class="table-wrapper">
        <table class="custom-table">

            <thead>

                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kode MK</th>
                    <th>Nilai Akhir</th>
                    <th>Nilai Huruf</th>
                    <th>Index</th>
                </tr>

            </thead>

            <tbody>

            @forelse($nilai as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nim }}</td>

                    <td>
                        {{ $item->mahasiswa->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->kode_mk }}
                    </td>

                    <td>
                        {{ $item->nilai_akhir }}
                    </td>

                    <td>
                        {{ $item->nilai_huruf }}
                    </td>

                    <td>
                        {{ $item->index_nilai }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">
    Tidak ada data
</td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection