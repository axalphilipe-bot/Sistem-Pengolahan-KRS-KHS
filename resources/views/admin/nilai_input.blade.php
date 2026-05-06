@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Input Nilai</h1>

    <p class="page-subtitle">
        Input nilai mahasiswa permata kuliah
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
        <select class="filter-select">
            <option>Semua Mata Kuliah</option>
        </select>

        <select class="filter-select">
            <option>Semua Kelas</option>
        </select>

        <!-- BUTTON -->
        <button class="btn-simpan-semua">
            Simpan Nilai
        </button>

    </div>

    <!-- TABLE -->
    <div class="table-container">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>Nim</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>125346179</td>
                    <td>Axal Philipe Samuel</td>
                    <td>Basis Data</td>
                    <td>A</td>

                    <td>
                        <select class="nilai-select">
                            <option>A</option>
                            <option>B+</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </td>

                    <td>
                        <button class="btn-simpan">
                            Simpan
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>607624351</td>
                    <td>Ananda Shadiva Wansa</td>
                    <td>Basis Data</td>
                    <td>A</td>

                    <td>
                        <select class="nilai-select">
                            <option>A</option>
                            <option>B+</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </td>

                    <td>
                        <button class="btn-simpan">
                            Simpan
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>143256735</td>
                    <td>Devicha Reta Sashara</td>
                    <td>Basis Data</td>
                    <td>A</td>

                    <td>
                        <select class="nilai-select">
                            <option>B+</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </td>

                    <td>
                        <button class="btn-simpan">
                            Simpan
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>867965411</td>
                    <td>Muhammad Zacky A</td>
                    <td>Basis Data</td>
                    <td>A</td>

                    <td>
                        <select class="nilai-select">
                            <option>B</option>
                            <option>A</option>
                            <option>B+</option>
                            <option>C</option>
                        </select>
                    </td>

                    <td>
                        <button class="btn-simpan">
                            Simpan
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection