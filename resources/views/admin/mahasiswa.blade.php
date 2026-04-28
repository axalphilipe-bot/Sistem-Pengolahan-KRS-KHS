@extends('layouts.app')

@section('content')
<div class="admin-content">

<h2>Data Mahasiswa</h2>

<table class="table-admin">
    <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Prodi</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <tr>
        <td>1</td>
        <td>12345678</td>
        <td>Diva</td>
        <td>Informatika</td>
        <td><span class="btn btn-green">Aktif</span></td>
        <td>
            <button class="btn btn-blue">Edit</button>
            <button class="btn btn-red">Hapus</button>
        </td>
    </tr>

</table>

</div>
@endsection