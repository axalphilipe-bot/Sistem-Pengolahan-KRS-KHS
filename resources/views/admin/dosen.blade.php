@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Data Dosen</h1>
    <p class="page-subtitle">
        Kelola data dosen yang terdaftar di Politeknik Negeri Batam
    </p>

    <div class="table-wrappe">

        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIDN</th>
                    <th>Nama Dosen</th>
                    <th>Program Studi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>1665589021</td>
                    <td>Agus Fatulloh, S.T., M.T</td>
                    <td>Teknik Informatika</td>
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
                    <td>2</td>
                    <td>5405831600</td>
                    <td>Ari Wibowo, ST, MT</td>
                    <td>Teknik Informatika</td>
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
                    <td>3</td>
                    <td>4056563924</td>
                    <td>Dwi Ely Kurniawan, S.Pd., M.Kom</td>
                    <td>Teknik Informatika</td>
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
                    <td>4</td>
                    <td>6264891536</td>
                    <td>Evaliata Br. Sembiring, S.Kom., M.Cs</td>
                    <td>Teknik Informatika</td>
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
                    <td>5</td>
                    <td>1562408240</td>
                    <td>Fadli Suandi, S.T., M.Kom.</td>
                    <td>Teknik Informatika</td>
                    <td>
                        <span class="status nonaktif">
                            Nonaktif
                        </span>
                    </td>
                    <td class="aksi">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-hapus">Hapus</button>
                    </td>
                </tr>

                <tr>
                    <td>6</td>
                    <td>1445973378</td>
                    <td>Swono Sibagariang, S.Kom., M.Kom</td>
                    <td>Teknik Informatika</td>
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
                    <td>7</td>
                    <td>1708425975</td>
                    <td>Hilda Widyastuti, S.T., M.T.</td>
                    <td>Teknik Informatika</td>
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

            </tbody>
        </table>

    </div>

</div>

@endsection