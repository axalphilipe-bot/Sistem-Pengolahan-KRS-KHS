@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Tambah Mata Kuliah</h1>
    <p class="page-subtitle">
        Tambahkan data mata kuliah baru
    </p>

    <div class="card">

        <form action="/admin/matkul/store" method="POST">
            @csrf

            <div class="form-group">
                <label>Kode Mata Kuliah</label>
                <input
                    type="text"
                    name="kode_mk"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Nama Mata Kuliah</label>
                <input
                    type="text"
                    name="nama_mk"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>SKS</label>
                <input
                    type="number"
                    name="sks"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Dosen Pengampu</label>
                <input
                    type="text"
                    name="dosen"
                    class="form-control">
            </div>

            <div class="form-group">
                <label>Program Studi</label>

                <select
                    name="kode_prodi"
                    class="form-control"
                    required>

                    @foreach($prodi as $p)
                        <option value="{{ $p->kode_prodi }}">
                            {{ $p->nama_prodi }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label>Semester</label>

                <select
                    name="semester"
                    class="form-control">

                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>

                </select>
            </div>

            <div class="form-group">
                <label>Jenis Mata Kuliah</label>

                <select
                    name="jenis"
                    class="form-control">

                    <option value="wajib">
                        Wajib
                    </option>

                    <option value="pilihan">
                        Pilihan
                    </option>

                </select>
            </div>

            <br>

            <button
    type="submit"
    class="btn btn-info">

    Simpan Mata Kuliah

</button>

            <a
                href="/admin/matkul"
                class="btn btn-danger">

                Batal

            </a>

        </form>

    </div>

</div>

@endsection