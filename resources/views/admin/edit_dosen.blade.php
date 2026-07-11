@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-edit-page dosen-edit-page">

    <div class="detail-top-bar">
        <a href="/admin/dosen" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Edit Data</span>
            <h1>{{ $dosen->nama }}</h1>
            <p class="detail-profile-meta">
                <span class="nuptk-text">{{ $dosen->nuptk }}</span>
                <span class="meta-sep">·</span>
                <span>Perbarui informasi dosen</span>
            </p>
        </div>
    </div>

    <div class="form-card form-card-wide">
        <div class="form-header">
            <h1>Edit Dosen</h1>
            <p>Ubah data dosen lalu simpan perubahan.</p>
        </div>

        <form action="/admin/dosen/{{ $dosen->nuptk }}/update" method="POST" class="admin-form">
            @csrf

            <div class="form-section-title">Identitas</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="nuptk">NUPTK</label>
                    <input type="text" id="nuptk" value="{{ $dosen->nuptk }}" readonly>
                </div>

                <div class="form-field">
                    <label for="nama">Nama Dosen</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $dosen->nama) }}" required>
                </div>

                <div class="form-field form-field-wide">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $dosen->email) }}" required>
                </div>
            </div>

            <div class="form-section-title">Akademik</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="jabatan">Jabatan</label>
                    <select id="jabatan" name="jabatan" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach(['Dosen Tetap', 'Dosen Tidak Tetap', 'Lektor', 'Lektor Kepala', 'Kaprodi', 'Sekretaris Prodi'] as $jabatan)
                            <option value="{{ $jabatan }}" @selected(old('jabatan', $dosen->jabatan) == $jabatan)>{{ $jabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field">
                    <label for="kode_prodi">Program Studi</label>
                    <select id="kode_prodi" name="kode_prodi" required>
                        <option value="">Pilih Program Studi</option>
                        @foreach($prodi as $p)
                            <option value="{{ $p->kode_prodi }}" @selected(old('kode_prodi', $dosen->kode_prodi) == $p->kode_prodi)>
                                {{ $p->nama_prodi }} ({{ $p->kode_prodi }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="/admin/dosen" class="btn-form-cancel">Batal</a>
                <button type="submit" class="btn-form-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</div>

@endsection
