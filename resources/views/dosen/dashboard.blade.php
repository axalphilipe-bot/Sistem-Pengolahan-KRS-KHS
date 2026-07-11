@extends('layouts.dosen')

@section('content')

<div class="dosen-dashboard">

    {{-- Hero --}}
    <div class="dashboard-hero">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-chalkboard-user"></i>
                Panel Dosen
            </span>
            <h1>Selamat Datang, {{ auth()->user()->name }}</h1>
            <p>
                Kelola kelas pengampu, validasi KRS mahasiswa, dan input nilai
                melalui Sistem Pengelolaan KRS & KHS dengan lebih cepat dan mudah.
            </p>
        </div>

        <div class="hero-date">
            <span>Hari ini</span>
            <h3>{{ now()->translatedFormat('d F Y') }}</h3>
            <small>Semester 2025 / 2026 Genap</small>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="stats-grid">

        <a href="/dosen/kelas" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="stat-info">
                    <small>Jumlah Kelas</small>
                    <h2 class="count-up" data-target="{{ $jumlahKelas }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/dosen/kelas" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon green">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="stat-info">
                    <small>Total Mahasiswa</small>
                    <h2 class="count-up" data-target="{{ $totalMahasiswa }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/dosen/validasi" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon teal">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="stat-info">
                    <small>KRS Disetujui</small>
                    <h2 class="count-up" data-target="{{ $krsDisetujui }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="/dosen/validasi" class="stats-card">
            <div class="stat-left">
                <div class="stat-icon orange">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="stat-info">
                    <small>Menunggu Persetujuan</small>
                    <h2 class="count-up" data-target="{{ $menunggu }}">0</h2>
                </div>
            </div>
            <div class="stat-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

    </div>

    {{-- Quick actions + Ringkasan --}}
    <div class="dashboard-grid">

        <div class="panel">
            <div class="panel-header">
                <h3><i class="fa-solid fa-bolt"></i> Aksi Cepat</h3>
            </div>

            <div class="quick-actions">
                <a href="/dosen/kelas" class="quick-action">
                    <i class="fa-solid fa-users"></i>
                    Data Kelas
                </a>
                <a href="/dosen/validasi" class="quick-action">
                    <i class="fa-solid fa-file-circle-check"></i>
                    Validasi KRS
                </a>
                @if($matkul->isNotEmpty())
                    <a href="/dosen/nilai/{{ $matkul->first()->kode_mk }}" class="quick-action">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Input Nilai
                    </a>
                @else
                    <span class="quick-action disabled">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Input Nilai
                    </span>
                @endif
                <a href="/dosen/panduan" class="quick-action">
                    <i class="fa-solid fa-book"></i>
                    Panduan
                </a>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3><i class="fa-solid fa-clipboard-list"></i> Ringkasan Semester</h3>
            </div>

            <div class="summary-list">
                <div class="summary-item">
                    <div class="summary-icon blue">
                        <i class="fa-solid fa-chalkboard"></i>
                    </div>
                    <div class="summary-text">
                        <strong>{{ $jumlahKelas }}</strong>
                        <span>Mata Kuliah Diampu</span>
                    </div>
                </div>

                <div class="summary-item">
                    <div class="summary-icon success">
                        <i class="fa-solid fa-check-double"></i>
                    </div>
                    <div class="summary-text">
                        <strong>{{ $krsDisetujui }}</strong>
                        <span>KRS Disetujui</span>
                    </div>
                </div>

                <div class="summary-item">
                    <div class="summary-icon warning">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div class="summary-text">
                        <strong>{{ $menunggu }}</strong>
                        <span>KRS Menunggu Validasi</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Daftar kelas --}}
    <div class="modern-table">
        <div class="panel-header">
            <h3><i class="fa-solid fa-chalkboard-teacher"></i> Daftar Kelas Pengampu</h3>
            <a href="/dosen/kelas" class="panel-link">
                Lihat Semua
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <p class="table-desc">
            Mata kuliah yang sedang Anda ampu pada semester aktif.
        </p>

        @if($matkul->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-inbox"></i>
                <p>Belum ada mata kuliah yang diampu.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matkul as $m)
                        <tr>
                            <td><span class="kode-tag">{{ $m->kode_mk }}</span></td>
                            <td><strong class="mk-name">{{ $m->nama_mk }}</strong></td>
                            <td><span class="sks-badge">{{ $m->sks }} SKS</span></td>
                            <td><span class="semester-badge">{{ $m->semester }}</span></td>
                            <td>
                                <span class="mhs-count">
                                    <i class="fa-solid fa-users"></i>
                                    {{ $m->jumlah_mahasiswa }}
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="/dosen/kelas/{{ $m->kode_mk }}" class="btn-action btn-krs">
                                        <i class="fa-solid fa-list-check"></i>
                                        Lihat KRS
                                    </a>
                                    <a href="/dosen/nilai/{{ $m->kode_mk }}" class="btn-action btn-nilai">
                                        <i class="fa-solid fa-pen"></i>
                                        Input Nilai
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Info --}}
    <div class="info-banner">
        <i class="fa-solid fa-circle-info"></i>
        <span>Pastikan KRS mahasiswa telah disetujui sebelum perkuliahan dimulai.</span>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof countUp !== 'undefined' && countUp.CountUp) {
        document.querySelectorAll('.count-up').forEach(function (el) {
            var target = parseInt(el.dataset.target, 10) || 0;
            var counter = new countUp.CountUp(el, target, { duration: 1.5, separator: '.' });
            if (!counter.error) counter.start();
        });
    } else {
        document.querySelectorAll('.count-up').forEach(function (el) {
            el.textContent = el.dataset.target;
        });
    }
});
</script>
@endpush
