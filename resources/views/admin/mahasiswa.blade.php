@extends('layouts.admin')

@section('content')

<div class="admin-page">

<h1 class="page-title">Data Mahasiswa</h1>

<p class="page-subtitle">
    Kelola data mahasiswa yang terdaftar di Politeknik Negeri Batam
</p>

<div style="margin-bottom:20px;">
    <a href="/admin/mahasiswa/create"
       style="background:green;color:white;padding:10px 15px;text-decoration:none;border-radius:5px;">
        + Tambah Mahasiswa
    </a>
</div>

<div class="table-wrapper">

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>NIM Mahasiswa</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>Kelas</th>
                <th>Kelas Huruf</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @foreach($mahasiswa as $m)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $m->nim }}</td>

                <td>{{ $m->nama }}</td>

                <td>{{ $m->kode_prodi }}</td>

                <td>{{ $m->kelas }}</td>

                <td>{{ $m->kelas_huruf }}</td>

                <td>{{ $m->semester }}</td>

                <td>
                    <span class="status aktif">
                        Aktif
                    </span>
                </td>

                <td class="aksi">

                    <a href="/admin/mahasiswa/{{ $m->nim }}"
                       class="btn lihat">
                        <i class="fa fa-eye"></i>
                        <span>Lihat</span>
                    </a>

                    <a href="/admin/mahasiswa/{{ $m->nim }}/edit"
                       class="btn edit">
                        <i class="fa fa-pen"></i>
                        <span>Edit</span>
                    </a>

                    <a href="/admin/mahasiswa/{{ $m->nim }}/hapus"
                       class="btn hapus"
                       onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                        <i class="fa fa-trash"></i>
                        <span>Hapus</span>
                    </a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>


</div>

@endsection
