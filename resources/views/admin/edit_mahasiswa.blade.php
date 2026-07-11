@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-edit-page">

    <div class="detail-top-bar">
        <a href="/admin/mahasiswa" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Edit Data</span>
            <h1>{{ $mahasiswa->nama }}</h1>
            <p class="detail-profile-meta">
                <span class="nim-text">{{ $mahasiswa->nim }}</span>
                <span class="meta-sep">·</span>
                <span>Perbarui informasi mahasiswa</span>
            </p>
        </div>
    </div>

    <div class="form-card form-card-wide">
        <div class="form-header">
            <h1>Edit Mahasiswa</h1>
            <p>Ubah data mahasiswa lalu simpan perubahan.</p>
        </div>

        <form
            id="form-edit-mahasiswa"
            action="/admin/mahasiswa/{{ $mahasiswa->nim }}/update"
            method="POST"
            class="admin-form">
            @csrf

            <div class="form-section-title">Identitas</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
                </div>

                <div class="form-field">
                    <label for="nama">Nama Mahasiswa</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required>
                </div>

                <div class="form-field form-field-wide">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}" required>
                </div>
            </div>

            <div class="form-section-title">Akademik</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="kelas">Kelas</label>
                    <select id="kelas" name="kelas" required>
                        <option value="">Pilih Kelas</option>
                        <option value="Reguler Pagi" @selected(old('kelas', $mahasiswa->kelas) == 'Reguler Pagi')>Reguler Pagi</option>
                        <option value="Reguler Malam" @selected(old('kelas', $mahasiswa->kelas) == 'Reguler Malam')>Reguler Malam</option>
                        <option value="Batamindo" @selected(old('kelas', $mahasiswa->kelas) == 'Batamindo')>Batamindo</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="kelas_huruf">Kelas Huruf</label>
                    <select id="kelas_huruf" name="kelas_huruf">
                        <option value="">Pilih Kelas Huruf</option>
                        @foreach(['A','B','C','D','E'] as $huruf)
                            <option value="{{ $huruf }}" @selected(old('kelas_huruf', $mahasiswa->kelas_huruf) == $huruf)>{{ $huruf }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field">
                    <label for="jenjang">Jenjang</label>
                    <select id="jenjang" name="jenjang" required>
                        <option value="">Pilih Jenjang</option>
                        <option value="D3" @selected(old('jenjang', $mahasiswa->jenjang) == 'D3')>D3</option>
                        <option value="D4" @selected(old('jenjang', $mahasiswa->jenjang) == 'D4')>D4</option>
                        <option value="S2 Terapan" @selected(old('jenjang', $mahasiswa->jenjang) == 'S2 Terapan')>S2 Terapan</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="kode_prodi">Program Studi</label>
                    <select id="kode_prodi" name="kode_prodi" required>
                        <option value="">Pilih Program Studi</option>
                        <option value="IF" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'IF')>D3 Teknik Informatika (IF)</option>
                        <option value="GM" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'GM')>D3 Teknik Geomatika (GM)</option>
                        <option value="AN" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'AN')>D4 Animasi (AN)</option>
                        <option value="TRM" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'TRM')>D4 Teknologi Rekayasa Multimedia (TRM)</option>
                        <option value="KS" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'KS')>D4 Keamanan Siber (KS)</option>
                        <option value="RPL" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'RPL')>D4 Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="TP" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'TP')>D4 Teknologi Permainan (TP)</option>
                        <option value="MTK" @selected(old('kode_prodi', $mahasiswa->kode_prodi) == 'MTK')>Magister Terapan Teknik Komputer (MTK)</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="semester">Semester</label>
                    <select id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" @selected(old('semester', $mahasiswa->semester) == $i)>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-field">
                    <label for="nuptk_wali">Dosen Wali</label>
                    <select id="nuptk_wali" name="nuptk_wali">
                        <option value="">Pilih Dosen Wali</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->nuptk }}" @selected(old('nuptk_wali', $mahasiswa->nuptk_wali) == $d->nuptk)>
                                {{ $d->nama }} ({{ $d->nuptk }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="/admin/mahasiswa" class="btn-form-cancel">Batal</a>
                <button type="submit" class="btn-form-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</div>

@endsection
