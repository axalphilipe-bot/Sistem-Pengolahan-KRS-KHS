@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
        Edit Mata Kuliah
    </h1>

    <form method="POST"
          action="/admin/matkul/{{ $matkul->kode_mk }}/update">

        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Kode MK</label>
                <input type="text"
                       value="{{ $matkul->kode_mk }}"
                       disabled>
            </div>

            <div class="form-group">
                <label>Nama Mata Kuliah</label>
                <input type="text"
                       name="nama_mk"
                       value="{{ $matkul->nama_mk }}">
            </div>

            <div class="form-group">
                <label>SKS</label>
                <input type="number"
                       name="sks"
                       value="{{ $matkul->sks }}">
            </div>

            <div class="form-group">
                <label>Dosen</label>
                <input type="text"
                       name="dosen"
                       value="{{ $matkul->dosen }}">
            </div>

            <div class="form-group">
    <label>Program Studi</label>

    <select name="kode_prodi">

        @foreach($prodi as $p)

        <option value="{{ $p->kode_prodi }}"
            {{ $matkul->kode_prodi == $p->kode_prodi ? 'selected' : '' }}>
            {{ $p->nama_prodi }}
        </option>

        @endforeach

    </select>
</div>

<div class="form-group">
    <label>Semester</label>

    <input type="text"
           name="semester"
           value="{{ $matkul->semester }}">
</div>

<div class="form-group">
    <label>Jenis</label>

    <input type="text"
           name="jenis"
           value="{{ $matkul->jenis }}">
</div>

        </div>

        <br>

        <button class="btn btn-warning">
            Simpan Perubahan
        </button>

        <a href="/admin/matkul"
           class="btn btn-info">
            Kembali
        </a>

    </form>

</div>

@endsection