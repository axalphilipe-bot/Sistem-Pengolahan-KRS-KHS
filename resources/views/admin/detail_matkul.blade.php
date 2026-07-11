@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-detail-page matkul-detail-page">

    <div class="detail-top-bar">
        <a href="/admin/matkul" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Detail Mata Kuliah</span>
            <h1>{{ $matkul->nama_mk }}</h1>
            <p class="detail-profile-meta">
                <span class="kode-text">{{ $matkul->kode_mk }}</span>
                <span class="meta-sep">·</span>
                <span>{{ $matkul->prodi->nama_prodi ?? $matkul->kode_prodi }}</span>
            </p>
        </div>
        @if($matkul->jenis)
            <span class="jenis-badge {{ strtolower($matkul->jenis) }}">{{ ucfirst($matkul->jenis) }}</span>
        @endif
    </div>

    <div class="detail-card-single">
        <div class="detail-columns">

            <div class="detail-group">
                <h2 class="detail-group-title">Informasi Mata Kuliah</h2>
                <dl class="detail-fields">
                    <div class="detail-field">
                        <dt>Kode MK</dt>
                        <dd><span class="kode-text">{{ $matkul->kode_mk }}</span></dd>
                    </div>
                    <div class="detail-field">
                        <dt>Nama</dt>
                        <dd>{{ $matkul->nama_mk }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>SKS</dt>
                        <dd><span class="sks-badge">{{ $matkul->sks }} SKS</span></dd>
                    </div>
                    <div class="detail-field">
                        <dt>Dosen Pengampu</dt>
                        <dd>{{ $matkul->dosen ?? '–' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="detail-group">
                <h2 class="detail-group-title">Akademik</h2>
                <dl class="detail-fields">
                    <div class="detail-field">
                        <dt>Program Studi</dt>
                        <dd>
                            @if($matkul->prodi)
                                {{ $matkul->prodi->nama_prodi }}
                                <span class="field-sub">({{ $matkul->kode_prodi }})</span>
                            @else
                                {{ $matkul->kode_prodi }}
                            @endif
                        </dd>
                    </div>
                    <div class="detail-field">
                        <dt>Semester</dt>
                        <dd>{{ ucfirst($matkul->semester ?? '–') }}</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Jenis</dt>
                        <dd>
                            @if($matkul->jenis)
                                <span class="jenis-badge {{ strtolower($matkul->jenis) }}">{{ ucfirst($matkul->jenis) }}</span>
                            @else
                                <span class="text-muted">–</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

        </div>
    </div>

</div>

@endsection
