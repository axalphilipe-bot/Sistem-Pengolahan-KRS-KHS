@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Mata Kuliah</h1>
    <p class="page-subtitle">
        Kelola data mata kuliah
    </p>

    <!-- SEARCH -->
    <div class="search-box">
        <input type="text" placeholder="Cari Mata Kuliah...">
    </div>

    <!-- TABLE -->
    <div class="table-wrappe">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>IF211</td>
                    <td>Basis Data</td>
                    <td>3</td>
                    <td>Teknik Informatika</td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus-hijau">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>IF210</td>
                    <td>Pemrograman Web</td>
                    <td>3</td>
                    <td>Teknik Informatika</td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus-hijau">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>IF207</td>
                    <td>Proyek Pembuatan Prototipe</td>
                    <td>3</td>
                    <td>Teknik Informatika</td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus-hijau">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>IF212</td>
                    <td>Pemrograman Berorientasi Objek</td>
                    <td>3</td>
                    <td>Teknik Informatika</td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus-hijau">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>IF213</td>
                    <td>Bahasa Inggris</td>
                    <td>3</td>
                    <td>Teknik Informatika</td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus-hijau">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>IF209</td>
                    <td>Jaringan Komputer</td>
                    <td>3</td>
                    <td>Teknik Informatika</td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus-hijau">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>IF208</td>
                    <td>Dasar Rekayasa Perangkat Lunak</td>
                    <td>3</td>
                    <td>Teknik Informatika</td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus-hijau">Hapus</button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection