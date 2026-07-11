@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-detail-page dosen-detail-page">

    <div class="detail-top-bar">
        <a href="/admin/dosen" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Detail Dosen</span>
            <h1>{{ $dosen->nama }}</h1>
            <p class="detail-profile-meta">
                <span class="nuptk-text">{{ $dosen->nuptk }}</span>
                <span class="meta-sep">·</span>
                <span>{{ $dosen->prodi->nama_prodi ?? $dosen->kode_prodi }}</span>
            </p>
        </div>
        <span class="status-pill status-pill-active">Aktif</span>
    </div>

    <div class="detail-card-single">
        <div class="detail-columns">

            <div class="detail-group">
                <h2 class="detail-group-title">Identitas</h2>
                <dl class="detail-fields">
                    <div class="detail-field">
                        <dt>NUPTK</dt>
                        <dd><span class="nuptk-text">{{ $dosen->nuptk }}</span></dd>
                    </div>
                    <div class="detail-field">
                        <dt>Nama</dt>
                        <dd>{{ $dosen->nama }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Email</dt>
                        <dd>{{ $dosen->email ?? '–' }}</dd>
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
                            @if($dosen->prodi)
                                {{ $dosen->prodi->nama_prodi }}
                                <span class="field-sub">({{ $dosen->kode_prodi }})</span>
                            @else
                                {{ $dosen->kode_prodi }}
                            @endif
                        </dd>
                    </div>
                    <div class="detail-field">
                        <dt>Jabatan</dt>
                        <dd>{{ $dosen->jabatan ?? '–' }}</dd>
                    </div>
                </dl>
            </div>

        </div>
    </div>

</div>

@endsection
