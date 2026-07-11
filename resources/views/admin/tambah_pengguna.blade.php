@extends('layouts.admin')

@section('content')

<div class="admin-page pengguna-form-page mahasiswa-edit-page">

    <div class="detail-top-bar">
        <a href="/admin/pengguna" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Pengguna Baru</span>
            <h1>Tambah Pengguna</h1>
            <p class="detail-profile-meta">Daftarkan akun baru beserta role dan hak akses sistem.</p>
        </div>
    </div>

    <div class="form-card form-card-wide">
        <div class="form-header">
            <h1>Form Pengguna</h1>
            <p>Lengkapi informasi akun sesuai role yang dipilih.</p>
        </div>

        @if($errors->any())
            <div class="alert-error-custom" style="margin-bottom: 20px;">
                <i class="fa-solid fa-circle-xmark"></i>
                Periksa kembali data yang diisi.
            </div>
        @endif

        <form action="{{ route('admin.pengguna.store') }}" method="POST" class="admin-form" id="formPengguna">
            @csrf

            <div class="form-section-title">Akun</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        @foreach(['admin' => 'Admin', 'mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'kps' => 'KPS'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('role') == $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('role')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field field-role-email">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@polibatam.ac.id">
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field field-role-nim">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" value="{{ old('nim') }}" maxlength="10">
                    @error('nim')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field field-role-nuptk">
                    <label for="nuptk">NUPTK</label>
                    <input type="text" id="nuptk" name="nuptk" value="{{ old('nuptk') }}" maxlength="14">
                    @error('nuptk')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="8" required>
                    <span class="field-hint">Minimal 8 karakter</span>
                    @error('password')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="aktif" @selected(old('status', 'aktif') == 'aktif')>Aktif</option>
                        <option value="nonaktif" @selected(old('status') == 'nonaktif')>Nonaktif</option>
                    </select>
                    @error('status')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-section-title field-mahasiswa-extra">Profil Mahasiswa</div>
            <div class="form-grid field-mahasiswa-extra">
                <div class="form-field">
                    <label for="prodi">Program Studi</label>
                    <input type="text" id="prodi" name="prodi" value="{{ old('prodi') }}">
                    @error('prodi')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="kelas">Kelas</label>
                    <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}">
                    @error('kelas')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="no_hp">No. HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                    @error('no_hp')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="/admin/pengguna" class="btn-form-cancel">Batal</a>
                <button type="submit" class="btn-form-submit">Simpan Pengguna</button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var roleSelect = document.getElementById('role');
    if (!roleSelect) return;

    function toggleRoleFields() {
        var role = roleSelect.value;
        var showEmail = role === 'admin' || role === 'kps' || role === 'dosen' || role === 'mahasiswa';
        var requireEmail = role === 'admin' || role === 'kps';
        var showNim = role === 'mahasiswa';
        var showNuptk = role === 'dosen';
        var showMhsExtra = role === 'mahasiswa';

        document.querySelectorAll('.field-role-email').forEach(function (el) {
            el.style.display = showEmail ? '' : 'none';
        });
        document.querySelectorAll('.field-role-nim').forEach(function (el) {
            el.style.display = showNim ? '' : 'none';
        });
        document.querySelectorAll('.field-role-nuptk').forEach(function (el) {
            el.style.display = showNuptk ? '' : 'none';
        });
        document.querySelectorAll('.field-mahasiswa-extra').forEach(function (el) {
            el.style.display = showMhsExtra ? '' : 'none';
        });

        var emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.required = requireEmail;
        }

        var nimInput = document.getElementById('nim');
        if (nimInput) {
            nimInput.required = showNim;
        }

        var nuptkInput = document.getElementById('nuptk');
        if (nuptkInput) {
            nuptkInput.required = showNuptk;
        }
    }

    roleSelect.addEventListener('change', toggleRoleFields);
    toggleRoleFields();
});
</script>
@endpush

@endsection
