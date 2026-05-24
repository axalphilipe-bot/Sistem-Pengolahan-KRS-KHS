@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <h1 class="page-title">Data Mahasiswa</h1>

    <p class="page-subtitle">
        Kelola data mahasiswa yang terdaftar di Politeknik Negeri Batam
    </p>

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>33125110</td>
                    <td>Muhammad Farhan</td>
                    <td>Teknik Informatika</td>
                    <td>2025</td>

                    <td>
                        <span class="status aktif">
                            Aktif
                        </span>
                    </td>

                    <td class="aksi">

                        <button class="btn lihat">
                            Lihat
                        </button>

                        <button class="btn edit">
                            Edit
                        </button>

<button class="btn hapus">
                            Hapus
                        </button>

                    </td>
                </tr>

                @for($i = 2; $i <= 12; $i++)

                <tr>
                    <td>{{ $i }}</td>
                    <td></td>
                    <td></td>
                    <td>Teknik Informatika</td>
                    <td>2025</td>

                    <td>
                        <span class="status aktif">
                            Aktif
                        </span>
                    </td>

                    <td class="aksi">

                        <button class="btn lihat">
                            Lihat
                        </button>

                        <button class="btn edit">
                            Edit
                        </button>

                        <button class="btn hapus">
                            Hapus
                        </button>

                    </td>
                </tr>

                @endfor

            </tbody>

        </table>

    </div>

</div>

@endsection