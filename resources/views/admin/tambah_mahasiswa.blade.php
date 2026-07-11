@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <div class="form-card">
        <div class="form-header">
            <h1>Tambah Mahasiswa</h1>
            <p>Lengkapi data mahasiswa baru untuk didaftarkan ke sistem.</p>
        </div>

        <form action="/admin/mahasiswa/store" method="POST" class="admin-form">
            @csrf

            @if($errors->any())
                <div class="alert-error-custom">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-grid">
                <div class="form-field">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 3312511001" maxlength="10" pattern="[0-9]{10}" inputmode="numeric" required>
                    <small class="field-hint">Tepat 10 digit angka</small>
                </div>

                <div class="form-field">
                    <label for="nama">Nama Mahasiswa</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" required>
                </div>

                <div class="form-field form-field-wide">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@student.polibatam.ac.id" required>
                </div>

                <div class="form-field">
                    <label for="kelas">Kelas</label>
                    <select id="kelas" name="kelas" required>
                        <option value="">Pilih Kelas</option>
                        <option value="Reguler Pagi" @selected(old('kelas') == 'Reguler Pagi')>Reguler Pagi</option>
                        <option value="Reguler Malam" @selected(old('kelas') == 'Reguler Malam')>Reguler Malam</option>
                        <option value="Batamindo" @selected(old('kelas') == 'Batamindo')>Batamindo</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="kelas_huruf">Kelas Huruf</label>
                    <select id="kelas_huruf" name="kelas_huruf">
                        <option value="">Pilih Kelas Huruf</option>
                        @foreach(['A','B','C','D','E'] as $huruf)
                            <option value="{{ $huruf }}" @selected(old('kelas_huruf') == $huruf)>{{ $huruf }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field">
                    <label for="jenjang">Jenjang</label>
                    <select id="jenjang" name="jenjang" required>
                        <option value="">Pilih Jenjang</option>
                        <option value="D3" @selected(old('jenjang') == 'D3')>D3</option>
                        <option value="D4" @selected(old('jenjang') == 'D4')>D4</option>
                        <option value="S2 Terapan" @selected(old('jenjang') == 'S2 Terapan')>S2 Terapan</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="kode_prodi">Program Studi</label>
                    <select id="kode_prodi" name="kode_prodi" required>
                        <option value="">Pilih Program Studi</option>
                        <option value="IF" @selected(old('kode_prodi') == 'IF')>D3 Teknik Informatika (IF)</option>
                        <option value="GM" @selected(old('kode_prodi') == 'GM')>D3 Teknik Geomatika (GM)</option>
                        <option value="AN" @selected(old('kode_prodi') == 'AN')>D4 Animasi (AN)</option>
                        <option value="TRM" @selected(old('kode_prodi') == 'TRM')>D4 Teknologi Rekayasa Multimedia (TRM)</option>
                        <option value="KS" @selected(old('kode_prodi') == 'KS')>D4 Keamanan Siber (KS)</option>
                        <option value="RPL" @selected(old('kode_prodi') == 'RPL')>D4 Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="TP" @selected(old('kode_prodi') == 'TP')>D4 Teknologi Permainan (TP)</option>
                        <option value="MTK" @selected(old('kode_prodi') == 'MTK')>Magister Terapan Teknik Komputer (MTK)</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="semester">Semester</label>
                    <select id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" @selected(old('semester') == $i)>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-field">
                    <label for="nuptk_wali">Dosen Wali</label>
                    <select id="nuptk_wali" name="nuptk_wali">
                        <option value="">Pilih Dosen Wali</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->nuptk }}" @selected(old('nuptk_wali') == $d->nuptk)>
                                {{ $d->nama }} ({{ $d->nuptk }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="/admin/mahasiswa" class="btn-form-cancel">Batal</a>
                <button type="submit" class="btn-form-submit">Simpan Mahasiswa</button>
            </div>
        </form>
    </div>

</div>

@endsection
