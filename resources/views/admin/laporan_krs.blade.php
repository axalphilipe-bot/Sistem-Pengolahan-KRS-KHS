@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Laporan KRS</h1>

    <p class="page-subtitle">
        Unduh Laporan KRS berdasarkan periode
    </p>

    <!-- FILTER -->
    <div class="filter-wrapper">

        <div class="filter-group">
            <label>Semester</label>

            <select class="filter-select">
                <option>2025/2026</option>
            </select>
        </div>

        <div class="filter-group">
            <label>Program Studi</label>

            <select class="filter-select">
                <option>Teknik Informatika</option>
            </select>
        </div>

        <div class="filter-group">
            <label>Format</label>

            <select class="filter-select kecil">
                <option>PDF</option>
            </select>
        </div>

        <button class="btn-download-laporan">
            Download Laporan
        </button>

    </div>

    <!-- TITLE -->
    <h3 class="table-title">
        Riwayat Laporan
    </h3>

    <!-- TABLE -->
    <div class="table-wrappe">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>Semester</th>
                    <th>Program Studi</th>
                    <th>Format</th>
                    <th>Tanggal Download</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>2025/2026</td>
                    <td>Teknik Informatika</td>
                    <td>PDF</td>
                    <td>14 Mei 2025 10:30</td>

                    <td>
                        <button class="btn-download">
                            Download
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2025/2026</td>
                    <td>Teknik Informatika</td>
                    <td>PDF</td>
                    <td>14 Mei 2025 10:30</td>

                    <td>
                        <button class="btn-download">
                            Download
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2025/2026</td>
                    <td>Teknik Informatika</td>
                    <td>PDF</td>
                    <td>14 Mei 2025 10:30</td>

                    <td>
                        <button class="btn-download">
                            Download
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection