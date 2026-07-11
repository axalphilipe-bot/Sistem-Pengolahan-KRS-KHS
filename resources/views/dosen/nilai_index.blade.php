@extends('layouts.dosen')

@section('content')

<div class="dosen-dashboard dosen-nilai-index">

    <div class="dashboard-hero">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-pen-to-square"></i>
                Pengelolaan Nilai
            </span>
            <h1>Input Nilai</h1>
            <p>Pilih mata kuliah yang ingin diinput nilainya. Hanya mahasiswa dengan KRS disetujui yang ditampilkan.</p>
        </div>

        <div class="hero-date">
            <span>Semester Aktif</span>
            <h3>2025 / 2026</h3>
            <small>Genap</small>
        </div>
    </div>

    @if(session('error'))
        <div class="nilai-alert nilai-alert-error" style="margin-bottom: 20px;">
            <i class="fa-solid fa-circle-xmark"></i>
            {{ session('error') }}
        </div>
    @endif

    @php
        $totalMatkul = $matkul->count();
        $totalPeserta = $matkul->sum('jumlah_mahasiswa');
        $totalSks = $matkul->sum('sks');
    @endphp

    <div class="stats-grid stats-grid-3">
        <div class="stats-card stats-card-static">
            <div class="stat-left">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="stat-info">
                    <small>Total Mata Kuliah</small>
                    <h2>{{ $totalMatkul }}</h2>
                </div>
            </div>
        </div>

        <div class="stats-card stats-card-static">
            <div class="stat-left">
                <div class="stat-icon teal">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-info">
                    <small>Mahasiswa (KRS Disetujui)</small>
                    <h2>{{ $totalPeserta }}</h2>
                </div>
            </div>
        </div>

        <div class="stats-card stats-card-static">
            <div class="stat-left">
                <div class="stat-icon orange">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div class="stat-info">
                    <small>Total SKS Diampu</small>
                    <h2>{{ $totalSks }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-panel nilai-index-filter">
        <form method="GET" action="/dosen/nilai" class="search-form" id="formCariNilai">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="text"
                    id="cariMatkul"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kode atau nama mata kuliah..."
                    autocomplete="off">
            </div>
            @if(request('search'))
                <a href="/dosen/nilai" class="btn-reset">Reset</a>
            @endif
        </form>
    </div>

    <div class="modern-table">
        <div class="panel-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Mata Kuliah</h3>
            <span class="result-count">
                Total <strong>{{ $totalMatkul }}</strong> mata kuliah
            </span>
        </div>

        @if($matkul->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-book-open"></i>
                <h4>Tidak ada mata kuliah</h4>
                <p>
                    @if(request('search'))
                        Tidak ditemukan mata kuliah dengan kata kunci "{{ request('search') }}".
                    @else
                        Anda belum diampu pada mata kuliah manapun.
                    @endif
                </p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Mahasiswa</th>
                        <th>Status Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matkul as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="mk-cell">
                                    <strong class="mk-name">{{ $m->nama_mk }}</strong>
                                    <span class="mk-code">{{ $m->kode_mk }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="sks-badge">{{ $m->sks }} SKS</span>
                            </td>
                            <td>{{ ucfirst($m->semester) }}</td>
                            <td>
                                <span class="mhs-count">
                                    <i class="fa-solid fa-user-graduate"></i>
                                    {{ $m->jumlah_mahasiswa }}
                                </span>
                            </td>
                            <td>
                                @switch($m->status_nilai ?? 'belum_input')
                                    @case('terkunci')
                                        <span class="status-badge locked">
                                            <i class="fa-solid fa-lock"></i> Terkunci
                                        </span>
                                        @break
                                    @case('disetujui')
                                        <span class="status-badge approved">
                                            <i class="fa-solid fa-circle-check"></i> Disetujui
                                        </span>
                                        @break
                                    @case('pending')
                                        <span class="status-badge pending">
                                            <i class="fa-solid fa-clock"></i> Pending
                                        </span>
                                        @break
                                    @case('ditolak')
                                        <span class="status-badge rejected">
                                            <i class="fa-solid fa-xmark"></i> Ditolak
                                        </span>
                                        @break
                                    @case('belum_peserta')
                                        <span class="status-badge empty">
                                            <i class="fa-solid fa-user-slash"></i> Belum Ada Peserta
                                        </span>
                                        @break
                                    @default
                                        <span class="status-badge draft">
                                            <i class="fa-solid fa-pen"></i> Belum Input
                                        </span>
                                @endswitch
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="/dosen/nilai/{{ $m->kode_mk }}" class="btn-action btn-input-nilai" title="Input Nilai">
                                        <i class="fa-solid fa-{{ ($m->status_nilai ?? '') === 'terkunci' ? 'eye' : 'pen-to-square' }}"></i>
                                        {{ ($m->status_nilai ?? '') === 'terkunci' ? 'Lihat Nilai' : 'Input Nilai' }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var search = document.getElementById('cariMatkul');
    if (!search || !search.form) return;

    var timer;
    search.addEventListener('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            search.form.submit();
        }, 400);
    });
});
</script>
@endpush
