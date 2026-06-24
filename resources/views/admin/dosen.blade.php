@extends('layouts.admin')

@section('content')

<style>
.btn-tambah{
    background:#3b8216;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    display:inline-block;
    font-weight:600;
}

.btn-tambah:hover{
    background:#2f6b12;
}

.aksi a{
    display:inline-block;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
    color:white;
    font-size:14px;
    font-weight:500;
    margin-right:4px;
}

.btn-info{
    background:#2196f3;
}

.btn-warning{
    background:#f59e0b;
}

.btn-danger{
    background:#dc3545;
}
</style>

<div class="page-content">

    <h1 class="page-title">Data Dosen</h1>
    <p class="page-subtitle">
        Kelola data dosen yang terdaftar di Politeknik Negeri Batam
    </p>
<div style="margin-bottom:20px;">
    <a href="/admin/dosen/create" class="btn-tambah">
    + Tambah Dosen
</a>
</div>
    <div class="table-wrappe">

       <table class="custom-table">

    <thead>
        <tr>
            <th>No</th>
            <th>NUPTK</th>
            <th>Nama Dosen</th>
            <th>Program Studi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @foreach($dosen as $d)

        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $d->nuptk }}</td>

            <td>{{ $d->nama }}</td>

            <td>{{ $d->kode_prodi }}</td>

            <td>
                <span class="status aktif">
                    Aktif
                </span>
            </td>

            <td class="aksi" style="white-space:nowrap;">

                <a
href="/admin/dosen/{{ $d->nuptk }}"
class="btn btn-info">
    <i class="fa-solid fa-eye"></i>
    Lihat
</a>

<a href="/admin/dosen/{{ $d->nuptk }}/edit"
   class="btn edit">
    <i class="fa-solid fa-pen"></i>
    Edit
</a>

<a href="/admin/dosen/{{ $d->nuptk }}/hapus"
   class="btn hapus"
   onclick="return confirm('Yakin ingin menghapus dosen ini?')">

    <i class="fa-solid fa-trash"></i>
    Hapus
</a>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

    </div>

</div>

@endsection