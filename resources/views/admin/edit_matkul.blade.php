@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-edit-page matkul-edit-page">

    <div class="detail-top-bar">
        <a href="/admin/matkul" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Edit Data</span>
            <h1>{{ $matkul->nama_mk }}</h1>
            <p class="detail-profile-meta">
                <span class="kode-text">{{ $matkul->kode_mk }}</span>
                <span class="meta-sep">·</span>
                <span>Perbarui informasi mata kuliah</span>
            </p>
        </div>
    </div>

    <div class="form-card form-card-wide">
        <div class="form-header">
            <h1>Edit Mata Kuliah</h1>
            <p>Ubah data mata kuliah lalu simpan perubahan.</p>
        </div>

        <form action="/admin/matkul/{{ $matkul->kode_mk }}/update" method="POST" class="admin-form">
            @csrf

            <div class="form-section-title">Informasi Mata Kuliah</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="kode_mk">Kode MK</label>
                    <input type="text" id="kode_mk" value="{{ $matkul->kode_mk }}" readonly>
                </div>

                <div class="form-field">
                    <label for="nama_mk">Nama Mata Kuliah</label>
                    <input type="text" id="nama_mk" name="nama_mk" value="{{ old('nama_mk', $matkul->nama_mk) }}" required>
                </div>

                <div class="form-field">
                    <label for="sks">SKS</label>
                    <input type="number" id="sks" name="sks" value="{{ old('sks', $matkul->sks) }}" min="1" max="6" required>
                </div>

                <div class="form-field">
                    <label for="dosen">Dosen Pengampu</label>
                    <input type="text" id="dosen" name="dosen" value="{{ old('dosen', $matkul->dosen) }}" placeholder="Nama dosen pengampu">
                </div>
            </div>

            <div class="form-section-title">Akademik</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="kode_prodi">Program Studi</label>
                    <select id="kode_prodi" name="kode_prodi" required>
                        <option value="">Pilih Program Studi</option>
                        @foreach($prodi as $p)
                            <option value="{{ $p->kode_prodi }}" @selected(old('kode_prodi', $matkul->kode_prodi) == $p->kode_prodi)>
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
                            <option value="{{ $i }}" @selected(old('semester', $matkul->semester) == $i)>Semester {{ $i }}</option>
                        @endfor
                        <option value="ganjil" @selected(old('semester', $matkul->semester) == 'ganjil')>Ganjil</option>
                        <option value="genap" @selected(old('semester', $matkul->semester) == 'genap')>Genap</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="jenis">Jenis</label>
                    <select id="jenis" name="jenis" required>
                        <option value="">Pilih Jenis</option>
                        <option value="wajib" @selected(old('jenis', $matkul->jenis) == 'wajib')>Wajib</option>
                        <option value="pilihan" @selected(old('jenis', $matkul->jenis) == 'pilihan')>Pilihan</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="/admin/matkul" class="btn-form-cancel">Batal</a>
                <button type="submit" class="btn-form-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</div>

@endsection
