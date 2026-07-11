@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <div class="form-card">
        <div class="form-header">
            <h1>Tambah Mata Kuliah</h1>
            <p>Lengkapi data mata kuliah baru untuk didaftarkan ke sistem.</p>
        </div>

        <form action="/admin/matkul/store" method="POST" class="admin-form">
            @csrf

            <div class="form-section-title">Informasi Mata Kuliah</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="kode_mk">Kode Mata Kuliah</label>
                    <input type="text" id="kode_mk" name="kode_mk" value="{{ old('kode_mk') }}" placeholder="Contoh: IF101" required>
                </div>

                <div class="form-field">
                    <label for="nama_mk">Nama Mata Kuliah</label>
                    <input type="text" id="nama_mk" name="nama_mk" value="{{ old('nama_mk') }}" placeholder="Nama mata kuliah" required>
                </div>

                <div class="form-field">
                    <label for="sks">SKS</label>
                    <input type="number" id="sks" name="sks" value="{{ old('sks') }}" min="1" max="6" placeholder="3" required>
                </div>

                <div class="form-field">
                    <label for="dosen">Dosen Pengampu</label>
                    <input type="text" id="dosen" name="dosen" value="{{ old('dosen') }}" placeholder="Nama dosen pengampu">
                </div>
            </div>

            <div class="form-section-title">Akademik</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="kode_prodi">Program Studi</label>
                    <select id="kode_prodi" name="kode_prodi" required>
                        <option value="">Pilih Program Studi</option>
                        @foreach($prodi as $p)
                            <option value="{{ $p->kode_prodi }}" @selected(old('kode_prodi') == $p->kode_prodi)>
                                {{ $p->nama_prodi }} ({{ $p->kode_prodi }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field">
                    <label for="semester">Semester</label>
                    <select id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" @selected(old('semester') == $i)>Semester {{ $i }}</option>
                        @endfor
                        <option value="ganjil" @selected(old('semester') == 'ganjil')>Ganjil</option>
                        <option value="genap" @selected(old('semester') == 'genap')>Genap</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="jenis">Jenis Mata Kuliah</label>
                    <select id="jenis" name="jenis" required>
                        <option value="">Pilih Jenis</option>
                        <option value="wajib" @selected(old('jenis') == 'wajib')>Wajib</option>
                        <option value="pilihan" @selected(old('jenis') == 'pilihan')>Pilihan</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="/admin/matkul" class="btn-form-cancel">Batal</a>
                <button type="submit" class="btn-form-submit">Simpan Mata Kuliah</button>
            </div>
        </form>
    </div>

</div>

@endsection
