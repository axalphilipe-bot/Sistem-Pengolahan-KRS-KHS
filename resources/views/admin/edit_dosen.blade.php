@extends('layouts.admin')

@section('content')

<div class="edit-card">

    <div class="edit-header">
        <i class="fa-solid fa-pen-to-square"></i>
        <h1>Edit Dosen</h1>
    </div>

    <form action="/admin/dosen/{{ $dosen->nuptk }}/update" method="POST">
        @csrf

        <div class="edit-grid">

            <div class="edit-item">
                <label>NUPTK</label>
                <input type="text"
                       value="{{ $dosen->nuptk }}"
                       readonly>
            </div>

            <div class="edit-item">
                <label>Nama Dosen</label>
                <input type="text"
                       name="nama"
                       value="{{ $dosen->nama }}">
            </div>

            <div class="edit-item">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ $dosen->email }}">
            </div>

            <div class="edit-item">
                <label>Jabatan</label>

                <select name="jabatan">

                    <option value="Dosen Tetap"
                    {{ $dosen->jabatan == 'Dosen Tetap' ? 'selected' : '' }}>
                        Dosen Tetap
                    </option>

                    <option value="Dosen Tidak Tetap"
                    {{ $dosen->jabatan == 'Dosen Tidak Tetap' ? 'selected' : '' }}>
                        Dosen Tidak Tetap
                    </option>

                    <option value="Kaprodi"
                    {{ $dosen->jabatan == 'Kaprodi' ? 'selected' : '' }}>
                        Kaprodi
                    </option>

                    <option value="Sekretaris Prodi"
                    {{ $dosen->jabatan == 'Sekretaris Prodi' ? 'selected' : '' }}>
                        Sekretaris Prodi
                    </option>

                </select>

            </div>

            <div class="edit-item">
                <label>Program Studi</label>

                <select name="kode_prodi">

                    @foreach($prodi as $p)

                    <option value="{{ $p->kode_prodi }}"
                    {{ $dosen->kode_prodi == $p->kode_prodi ? 'selected' : '' }}>

                        {{ $p->kode_prodi }} - {{ $p->nama_prodi }}

                    </option>

                    @endforeach

                </select>

            </div>

        </div>

        <div class="edit-actions">

            <a href="/admin/dosen"
               class="btn-kembali">
                Kembali
            </a>

            <button type="submit"
                    class="btn-simpan">
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection