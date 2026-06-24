@extends('layouts.admin')

@section('content')

<h1>Tambah Dosen</h1>

<form action="/admin/dosen/store" method="POST">

    @csrf

    <div>
        <label>NUPTK</label>
        <input type="text" name="nuptk">
    </div>

    <br>

    <div>
        <label>Nama</label>
        <input type="text" name="nama">
    </div>

    <br>

    <div>
        <label>Email</label>
        <input type="email" name="email">
    </div>

    <br>

    <div>
    <label>Jabatan</label>

    <select name="jabatan">

        <option value="">
            -- Pilih Jabatan --
        </option>

        <option value="Dosen Tetap">
            Dosen Tetap
        </option>

        <option value="Dosen Tidak Tetap">
            Dosen Tidak Tetap
        </option>

        <option value="Kaprodi">
            Kaprodi
        </option>

        <option value="Sekretaris Prodi">
            Sekretaris Prodi
        </option>

    </select>
</div>

    <br>

    <div>
    <label>Program Studi</label>

    <select name="kode_prodi">

        <option value="">
            -- Pilih Program Studi --
        </option>

        @foreach($prodi as $p)

            <option value="{{ $p->kode_prodi }}">
                {{ $p->kode_prodi }} - {{ $p->nama_prodi }}
            </option>

        @endforeach

    </select>
</div>

    <br>

    <button
    type="submit"
    style="
        background:#2563eb;
        color:white;
        border:none;
        padding:10px 20px;
        border-radius:8px;
        cursor:pointer;
        font-weight:600;
    ">
      Simpan
</button>

</form>

@endsection