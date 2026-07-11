@extends('layouts.mahasiswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/mahasiswa-profil.css') }}">
@endpush

@section('content')

@php $user = auth()->user(); @endphp

<div class="mhs-profil">

    @if(session('success'))
        <div class="profil-alert success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="profil-alert error">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="profil-card">

        <div class="profil-page-header">
            <div class="profil-header-icon">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <h1>Profil Mahasiswa</h1>
                <p>Kelola informasi pribadi dan keamanan akun Anda.</p>
            </div>
        </div>

        <div class="profil-banner">
            <div class="banner-inner">
                <div class="profil-avatar">
                    <span>{{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}</span>
                </div>
                <div class="banner-info">
                    <h2>{{ $mahasiswa->nama }}</h2>
                    <p class="banner-meta">
                        <span class="meta-item"><i class="fa-solid fa-id-card"></i> {{ $mahasiswa->nim }}</span>
                        <span class="meta-dot"></span>
                        <span class="meta-item"><i class="fa-solid fa-graduation-cap"></i> {{ $mahasiswa->prodi->nama_prodi ?? 'Mahasiswa' }}</span>
                    </p>
                    <span class="banner-badge">
                        <i class="fa-solid fa-circle-check"></i>
                        Mahasiswa Aktif
                    </span>
                </div>
            </div>
        </div>

        <div class="profil-layout">

            <aside class="profil-sidebar">
                <div class="sidebar-card sidebar-menu">
                    <h3>Kelola Akun</h3>
                    <p class="sidebar-desc">Perbarui informasi kontak atau keamanan akun Anda.</p>
                    <div class="sidebar-actions">
                        <button type="button" class="btn-profil primary" id="openModal">
                            <i class="fa-solid fa-user-pen"></i>
                            Edit Profil
                        </button>
                        <button type="button" class="btn-profil secondary" id="openPasswordModal">
                            <i class="fa-solid fa-lock"></i>
                            Ubah Password
                        </button>
                    </div>
                </div>

                <div class="sidebar-card sidebar-note">
                    <i class="fa-solid fa-circle-info"></i>
                    <p>Data akademik (prodi, semester, kelas) dikelola oleh admin. Hubungi bagian akademik jika ada kesalahan data.</p>
                </div>
            </aside>

            <main class="profil-main">

                <section class="info-section">
                    <div class="section-head">
                        <h3><i class="fa-solid fa-user"></i> Identitas Mahasiswa</h3>
                    </div>
                    <dl class="detail-list">
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-hashtag"></i> NIM</dt>
                            <dd>{{ $mahasiswa->nim }}</dd>
                        </div>
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-user"></i> Nama Lengkap</dt>
                            <dd>{{ $mahasiswa->nama }}</dd>
                        </div>
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-envelope"></i> Email</dt>
                            <dd>{{ $mahasiswa->email ?? $user->email ?? '-' }}</dd>
                        </div>
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-phone"></i> Telepon</dt>
                            <dd>{{ $user->no_hp ?? '-' }}</dd>
                        </div>
                    </dl>
                </section>

                <section class="info-section">
                    <div class="section-head">
                        <h3><i class="fa-solid fa-graduation-cap"></i> Data Akademik</h3>
                    </div>
                    <dl class="detail-list">
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-building-columns"></i> Program Studi</dt>
                            <dd>{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</dd>
                        </div>
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-layer-group"></i> Jenjang</dt>
                            <dd>{{ $mahasiswa->jenjang ?? '-' }}</dd>
                        </div>
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-calendar-days"></i> Semester Aktif</dt>
                            <dd>{{ $mahasiswa->semester ?? '-' }}</dd>
                        </div>
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-users"></i> Kelas</dt>
                            <dd>{{ trim(($mahasiswa->kelas ?? '-') . ' ' . ($mahasiswa->kelas_huruf ?? '')) }}</dd>
                        </div>
                        @if($mahasiswa->dosenWali)
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-chalkboard-user"></i> Dosen Wali</dt>
                            <dd>{{ $mahasiswa->dosenWali->nama ?? '-' }}</dd>
                        </div>
                        @endif
                        <div class="detail-row">
                            <dt><i class="fa-solid fa-calendar"></i> Tahun Akademik</dt>
                            <dd>2025 / 2026 — Genap</dd>
                        </div>
                    </dl>
                </section>

            </main>
        </div>

    </div>

</div>

{{-- Modal Edit Profil --}}
<div id="editModal" class="profil-modal">
    <div class="profil-modal-content">
        <div class="modal-topbar">
            <h3><i class="fa-solid fa-user-pen"></i> Edit Profil</h3>
            <button type="button" class="modal-close" data-close="editModal">&times;</button>
        </div>
        <form method="POST" action="{{ route('profile.update') }}" class="profil-form">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $mahasiswa->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $mahasiswa->email ?? $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">Telepon</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ $user->no_hp ?? '' }}" placeholder="08xxxxxxxxxx">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-close="editModal">Batal</button>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Password --}}
<div id="passwordModal" class="profil-modal">
    <div class="profil-modal-content">
        <div class="modal-topbar">
            <h3><i class="fa-solid fa-lock"></i> Ubah Password</h3>
            <button type="button" class="modal-close" data-close="passwordModal">&times;</button>
        </div>
        <form method="POST" action="{{ route('profile.password') }}" class="profil-form">
            @csrf
            <div class="form-grid single">
                <div class="form-group">
                    <label for="old_password">Password Lama</label>
                    <input type="password" id="old_password" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" required minlength="6">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-close="passwordModal">Batal</button>
                <button type="submit" class="btn-save">Simpan Password</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/profil.js') }}"></script>
@endpush
