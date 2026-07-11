@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <div class="form-card">
        <div class="form-header">
            <h1>Tambah Dosen</h1>
            <p>Lengkapi data dosen baru untuk didaftarkan ke sistem.</p>
        </div>

        <form action="/admin/dosen/store" method="POST" class="admin-form">
            @csrf

            <div class="form-section-title">Identitas</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="nuptk">NUPTK</label>
                    <input type="text" id="nuptk" name="nuptk" value="{{ old('nuptk') }}" placeholder="Contoh: 166558900007" required>
                </div>

                <div class="form-field">
                    <label for="nama">Nama Dosen</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" required>
                </div>

                <div class="form-field form-field-wide">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@polibatam.ac.id" required>
                </div>
            </div>

            <div class="form-section-title">Akademik</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="jabatan">Jabatan</label>
                    <select id="jabatan" name="jabatan" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach(['Dosen Tetap', 'Dosen Tidak Tetap', 'Lektor', 'Lektor Kepala', 'Kaprodi', 'Sekretaris Prodi'] as $jabatan)
                            <option value="{{ $jabatan }}" @selected(old('jabatan') == $jabatan)>{{ $jabatan }}</option>
                        @endforeach
                    </select>
                </div>

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
            </div>

            <div class="form-actions">
                <a href="/admin/dosen" class="btn-form-cancel">Batal</a>
                <button type="submit" class="btn-form-submit">Simpan Dosen</button>
            </div>
        </form>
    </div>

</div>

@endsection
