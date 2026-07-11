@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-detail-page">

    <div class="detail-top-bar">
        <a href="/admin/mahasiswa" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Header soft gradient --}}
    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Detail Mahasiswa</span>
            <h1>{{ $mahasiswa->nama }}</h1>
            <p class="detail-profile-meta">
                <span class="nim-text">{{ $mahasiswa->nim }}</span>
                <span class="meta-sep">·</span>
                <span>{{ $mahasiswa->prodi->nama_prodi ?? $mahasiswa->kode_prodi }}</span>
            </p>
        </div>
        <span class="status-pill status-pill-active">Aktif</span>
    </div>

    {{-- Satu card compact --}}
    <div class="detail-card-single">
        <div class="detail-columns">

            <div class="detail-group">
                <h2 class="detail-group-title">Identitas</h2>
                <dl class="detail-fields">
                    <div class="detail-field">
                        <dt>NIM</dt>
                        <dd><span class="nim-text">{{ $mahasiswa->nim }}</span></dd>
                    </div>
                    <div class="detail-field">
                        <dt>Nama</dt>
                        <dd>{{ $mahasiswa->nama }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Email</dt>
                        <dd>{{ $mahasiswa->email }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Status</dt>
                        <dd><span class="status-pill status-pill-active">Aktif</span></dd>
                    </div>
                </dl>
            </div>

            <div class="detail-group">
                <h2 class="detail-group-title">Akademik</h2>
                <dl class="detail-fields">
                    <div class="detail-field">
                        <dt>Program Studi</dt>
                        <dd>
                            @if($mahasiswa->prodi)
                                {{ $mahasiswa->prodi->nama_prodi }}
                                <span class="field-sub">({{ $mahasiswa->kode_prodi }})</span>
                            @else
                                {{ $mahasiswa->kode_prodi }}
                            @endif
                        </dd>
                    </div>
                    <div class="detail-field">
                        <dt>Jenjang</dt>
                        <dd>{{ $mahasiswa->jenjang ?? '–' }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Semester</dt>
                        <dd>{{ $mahasiswa->semester }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Kelas</dt>
                        <dd>{{ $mahasiswa->kelas }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Kelas Huruf</dt>
                        <dd>{{ $mahasiswa->kelas_huruf ?? '–' }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Dosen Wali</dt>
                        <dd>
                            @if($mahasiswa->dosenWali)
                                {{ $mahasiswa->dosenWali->nama }}
                                <span class="field-sub">{{ $mahasiswa->nuptk_wali }}</span>
                            @else
                                <span class="text-muted">Belum ditentukan</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

        </div>
    </div>

</div>

@endsection
