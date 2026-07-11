@extends('layouts.admin')

@section('content')

<div class="admin-page mahasiswa-detail-page krs-detail-page">

    <div class="detail-top-bar">
        <a href="/admin/krs" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="detail-profile-header">
        <div class="detail-profile-main">
            <span class="detail-label">Detail Pengajuan KRS</span>
            <h1>{{ $mahasiswa->nama }}</h1>
            <p class="detail-profile-meta">
                <span class="nim-text">{{ $mahasiswa->nim }}</span>
                <span class="meta-sep">·</span>
                <span>{{ $mahasiswa->prodi->nama_prodi ?? $mahasiswa->kode_prodi }}</span>
            </p>
        </div>
        @if($status == 'Pending')
            <span class="krs-status krs-status-pending">Pending</span>
        @elseif($status == 'Disetujui')
            <span class="krs-status krs-status-approved">Disetujui</span>
        @else
            <span class="krs-status krs-status-rejected">Ditolak</span>
        @endif
    </div>

    <div class="detail-card-single">
        <div class="detail-columns">

            <div class="detail-group">
                <h2 class="detail-group-title">Data Mahasiswa</h2>
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
                        <dt>Program Studi</dt>
                        <dd>
                            {{ $mahasiswa->prodi->nama_prodi ?? $mahasiswa->kode_prodi }}
                            @if($mahasiswa->prodi)
                                <span class="field-sub">({{ $mahasiswa->kode_prodi }})</span>
                            @endif
                        </dd>
                    </div>
                    <div class="detail-field">
                        <dt>Semester</dt>
                        <dd>{{ $mahasiswa->semester }}</dd>
                    </div>
                </dl>
            </div>

            <div class="detail-group">
                <h2 class="detail-group-title">Ringkasan KRS</h2>
                <dl class="detail-fields">
                    <div class="detail-field">
                        <dt>Jumlah MK</dt>
                        <dd>{{ $krs->count() }} mata kuliah</dd>
                    </div>
                    <div class="detail-field">
                        <dt>Total SKS</dt>
                        <dd><span class="sks-badge">{{ $totalSks }} SKS</span></dd>
                    </div>
                    <div class="detail-field">
                        <dt>Status</dt>
                        <dd>
                            @if($status == 'Pending')
                                <span class="krs-status krs-status-pending">Pending</span>
                            @elseif($status == 'Disetujui')
                                <span class="krs-status krs-status-approved">Disetujui</span>
                            @else
                                <span class="krs-status krs-status-rejected">Ditolak</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

        </div>
    </div>

    <div class="data-table-panel krs-matkul-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-book-open"></i> Mata Kuliah Diajukan</h3>
            <span class="result-info">Total <strong>{{ $totalSks }} SKS</strong></span>
        </div>

        @if($krs->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-book"></i>
                <h4>Belum ada mata kuliah</h4>
                <p>Mahasiswa belum mengajukan mata kuliah apapun.</p>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($krs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="kode-tag">{{ $item->kode_mk }}</span></td>
                                <td>{{ $item->mataKuliah->nama_mk ?? '–' }}</td>
                                <td><span class="sks-badge">{{ $item->mataKuliah->sks ?? '–' }} SKS</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

@endsection
