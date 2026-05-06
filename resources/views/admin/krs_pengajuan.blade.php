@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Pengajuan KRS</h1>

    <p class="page-subtitle">
        Daftar pengajuan KRS yang diajukan oleh mahasiswa.
    </p>

    <!-- SEARCH -->
    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>

        <input type="text"
        placeholder="Cari NIM atau nama mahasiswa...">
    </div>

    <!-- TABLE -->
    <div class="table-container">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                    <th>Semester</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>1665589021</td>
                    <td>Muhammad Farhan</td>
                    <td>Teknik Informatika</td>
                    <td>2025/2026 Genap</td>
                    <td>11 Mei 2025 10:15</td>
                    <td>
                        <span class="status disetujui">
                            Disetujui
                        </span>
                    </td>
                    <td>
                        <button class="btn-lihat">
                            Lihat
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>1133409498</td>
                    <td>Devicha Retha Sashara</td>
                    <td>Teknik Informatika</td>
                    <td>2025/2026 Genap</td>
                    <td>12 Mei 2025 08:23</td>
                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>
                    <td>
                        <button class="btn-lihat">
                            Lihat
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>1919068459</td>
                    <td>Ananda Shadiva Wansa</td>
                    <td>Teknik Informatika</td>
                    <td>2025/2026 Genap</td>
                    <td>10 Mei 2025 11:13</td>
                    <td>
                        <span class="status disetujui">
                            Disetujui
                        </span>
                    </td>
                    <td>
                        <button class="btn-lihat">
                            Lihat
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>1857497941</td>
                    <td>Axal Philipe Samuel</td>
                    <td>Teknik Informatika</td>
                    <td>2025/2026 Genap</td>
                    <td>09 Mei 2025 17:12</td>
                    <td>
                        <span class="status disetujui">
                            Disetujui
                        </span>
                    </td>
                    <td>
                        <button class="btn-lihat">
                            Lihat
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>1092712899</td>
                    <td>Aliya Putri Ramadhani</td>
                    <td>Teknik Informatika</td>
                    <td>2025/2026 Genap</td>
                    <td>10 Mei 2025 05:12</td>
                    <td>
                        <span class="status disetujui">
                            Disetujui
                        </span>
                    </td>
                    <td>
                        <button class="btn-lihat">
                            Lihat
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>6</td>
                    <td>1710187203</td>
                    <td>Adinda Salsabila</td>
                    <td>Teknik Informatika</td>
                    <td>2025/2026 Genap</td>
                    <td>12 Mei 2025 12:00</td>
                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>
                    <td>
                        <button class="btn-lihat">
                            Lihat
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>7</td>
                    <td>1998341155</td>
                    <td>Dody Sinaga</td>
                    <td>Teknik Informatika</td>
                    <td>2025/2026 Genap</td>
                    <td>07 Mei 2025 08:00</td>
                    <td>
                        <span class="status ditolak">
                            Ditolak
                        </span>
                    </td>
                    <td>
                        <button class="btn-lihat">
                            Lihat
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection