@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Persetujuan KRS</h1>

    <p class="page-subtitle">
        Setujui atau tolak pengajuan KRS Mahasiswa
    </p>

    <!-- FILTER -->
    <div class="filter-wrapper">

        <!-- SEARCH -->
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text"
            placeholder="Cari NIM atau Nama Mahasiswa...">
        </div>

        <!-- SELECT -->
        <select class="filter-status">
            <option>Semua Status</option>
            <option>Pending</option>
            <option>Disetujui</option>
            <option>Ditolak</option>
        </select>

    </div>

    <!-- TABLE -->
    <div class="table-container">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Semester</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>956423172</td>
                    <td>Muhammad Farhan</td>
                    <td>2</td>
                    <td>11 Mei 2025</td>

                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-setuju">
                            Setujui
                        </button>

                        <button class="btn-tolak">
                            Tolak
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>1133409498</td>
                    <td>Devicha Retha Sashara</td>
                    <td>2</td>
                    <td>11 Mei 2025</td>

                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-setuju">
                            Setujui
                        </button>

                        <button class="btn-tolak">
                            Tolak
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>1919068459</td>
                    <td>Ananda Shadiva Wansa</td>
                    <td>2</td>
                    <td>12 Mei 2025</td>

                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-setuju">
                            Setujui
                        </button>

                        <button class="btn-tolak">
                            Tolak
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>1857497941</td>
                    <td>Aliya Putri Ramadhani</td>
                    <td>2</td>
                    <td>12 Mei 2025</td>

                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-setuju">
                            Setujui
                        </button>

                        <button class="btn-tolak">
                            Tolak
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>1092712899</td>
                    <td>Axal Philipe Samuel</td>
                    <td>2</td>
                    <td>11 Mei 2025</td>

                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-setuju">
                            Setujui
                        </button>

                        <button class="btn-tolak">
                            Tolak
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection