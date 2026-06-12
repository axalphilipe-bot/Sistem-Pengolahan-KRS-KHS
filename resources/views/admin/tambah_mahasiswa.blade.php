@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <h1 class="page-title">Tambah Mahasiswa</h1>

    <form action="/admin/mahasiswa/store" method="POST">
        @csrf

        <div style="margin-bottom:15px;">
            <label>NIM</label><br>
            <input type="text" name="nim" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Nama Mahasiswa</label><br>
            <input type="text" name="nama" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Email</label><br>
            <input type="email" name="email" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Kelas</label><br>
            <input type="text" name="kelas" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Jenjang</label><br>
            <input type="text" name="jenjang" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Kode Prodi</label><br>
            <input type="text" name="kode_prodi" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Semester</label><br>
            <input type="number" name="semester" style="width:300px;padding:8px;">
        </div>

        <button type="submit"
            style="
            background:#0d6efd;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
        ">
            Simpan
        </button>

    </form>

</div>

@endsection