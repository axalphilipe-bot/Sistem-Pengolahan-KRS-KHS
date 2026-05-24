@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Pengguna & Hak Akses</h1>

    <p class="page-subtitle">
        Kelola pengguna & Hak Akses
    </p>

    <div class="table-wrappe">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Axal Phillipe Samuel</td>
                    <td>Axal</td>
                    <td>Admin</td>

                    <td>
                        <span class="status aktif">
                            Aktif
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>Ananda Shadiva Wansa</td>
                    <td>Shadiva</td>
                    <td>Dosen</td>

                    <td>
                        <span class="status aktif">
                            Aktif
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>Devicha Reta Sashara</td>
                    <td>Devicha</td>
                    <td>Mahasiswa</td>

                    <td>
                        <span class="status aktif">
                            Aktif
                        </span>
                    </td>

                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus">Hapus</button>
                    </td>
                </tr>

                <!-- KOSONG -->
                @for($i = 0; $i < 5; $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endfor

            </tbody>

        </table>

    </div>

</div>

@endsection