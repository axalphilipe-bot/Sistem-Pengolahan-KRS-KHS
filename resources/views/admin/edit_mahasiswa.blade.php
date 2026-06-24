@extends('layouts.admin')

@section('content')

<div class="edit-header">
    <i class="fa fa-pen"></i>
    <h1>Edit Mahasiswa</h1>
</div>

    <form action="/admin/mahasiswa/{{ $mahasiswa->nim }}/update"
          method="POST">

        @csrf

        <div class="detail-grid">

            <div class="detail-item">
                <label>NIM</label>
                <input type="text"
                       name="nim"
                       value="{{ $mahasiswa->nim }}">
            </div>

            <div class="detail-item">
                <label>Nama</label>
                <input type="text"
                       name="nama"
                       value="{{ $mahasiswa->nama }}">
            </div>

            <div class="detail-item">
    <label>Kelas</label>
    <input type="text"
           name="kelas"
           value="{{ $mahasiswa->kelas }}">
</div>

<div class="detail-item">
    <label>Jenjang</label>
    <input type="text"
           name="jenjang"
           value="{{ $mahasiswa->jenjang }}">
</div>

            <div class="detail-item">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ $mahasiswa->email }}">
            </div>

            <div class="detail-item">
                <label>Program Studi</label>
                <input type="text"
                       name="kode_prodi"
                       value="{{ $mahasiswa->kode_prodi }}">
            </div>

            <div class="detail-item">
                <label>Semester</label>
                <input type="number"
                       name="semester"
                       value="{{ $mahasiswa->semester }}">
            </div>

        </div>

        <div class="detail-actions">

            <a href="/admin/mahasiswa"
               class="btn-kembali">
               ← Batal
            </a>

            <button type="submit"
                    class="btn-edit">
                💾 Simpan
            </button>

        </div>

    </form>

</div>

@endsection