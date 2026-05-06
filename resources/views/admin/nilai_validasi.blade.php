@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Validasi Nilai</h1>

    <p class="page-subtitle">
        Validasi nilai yang sudah diinput
    </p>

    <div class="filter-wrapper">

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text"
            placeholder="Cari NIM atau Nama Mahasiswa...">
        </div>

   
        <select class="filter-select">
            <option>Semua Kelas</option>
            <option>Kelas A</option>
            <option>Kelas B</option>
        </select>

    
        <button class="btn-simpan-semua">
            Simpan Nilai
        </button>

    </div>

    <div class="table-container">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Nilai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>125346179</td>
                    <td>Axal Philipe Samuel Stankovick </td>
                    <td>Basis Data</td>
                    <td>A</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>607624351</td>
                    <td>Ananda Shadiva Wansa</td>
                    <td>Basis Data</td>
                    <td>A</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>143256735</td>
                    <td>Devicha Reta Sashara</td>
                    <td>Basis Data</td>
                    <td>A</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>867965411</td>
                    <td>Muhammad Zacky A</td>
                    <td>Basis Data</td>
                    <td>A</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>987624315</td>
                    <td>Aliya Putri Ramadhani</td>
                    <td>Basis Data</td>
                    <td>A</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>981524367</td>
                    <td>Adinda Salsabila</td>
                    <td>Basis Data</td>
                    <td>A</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>546372819</td>
                    <td>Muhammad Farhan</td>
                    <td>Basis Data</td>
                    <td>A</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>9825364718</td>
                    <td>Natalia Kristin</td>
                    <td>Basis Data</td>
                    <td>-</td>
                    <td>Draft</td>

                    <td>
                        <button class="btn-validasi">
                            Validasi
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection