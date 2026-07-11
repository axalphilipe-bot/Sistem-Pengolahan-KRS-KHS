@extends('layouts.mahasiswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/mahasiswa-khs.css') }}">
@endpush

@section('content')

<div class="mhs-khs">

    <div class="khs-card">

        <div class="khs-page-header">
            <div class="khs-header-icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
                <h1>KHS (Kartu Hasil Studi)</h1>
                <p>Lihat hasil studi dan indeks prestasi berdasarkan semester yang dipilih.</p>
            </div>
        </div>

        <div class="khs-filter-box">
            <div class="khs-filter-row">
                <div class="khs-filter-item">
                    <label for="semester">Semester</label>
                    <select id="semester" class="khs-select">
                        <option value="">Pilih Semester</option>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap" selected>Genap</option>
                    </select>
                </div>
                <div class="khs-filter-item">
                    <label for="tahun">Tahun Ajaran</label>
                    <select id="tahun" class="khs-select">
                        <option value="">Pilih Tahun Akademik</option>
                        <option value="2025" selected>2025 / 2026</option>
                        <option value="2024">2024 / 2025</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="khs-stats">
            <div class="khs-stat-card">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="stat-info">
                    <span>Total SKS</span>
                    <strong>{{ $totalSks }}</strong>
                </div>
            </div>

            <div class="khs-stat-card">
                <div class="stat-icon green">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <span>IP Semester</span>
                    <strong>{{ number_format($ips, 2) }}</strong>
                </div>
            </div>

            <div class="khs-stat-card">
                <div class="stat-icon orange">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="stat-info">
                    <span>IPK</span>
                    <strong>{{ number_format($ipk, 2) }}</strong>
                </div>
            </div>
        </div>

        <div class="khs-table-header">
            <h3><i class="fa-solid fa-table-list"></i> Daftar Nilai</h3>
            @if($nilai->isNotEmpty())
                <span class="khs-count">{{ $nilai->count() }} mata kuliah</span>
            @endif
        </div>

        @if($nilai->isEmpty())
            <div class="khs-empty">
                <div class="khs-empty-icon">
                    <i class="fa-solid fa-file-circle-xmark"></i>
                </div>
                <h4>Nilai belum dipublikasikan</h4>
                <p>Nilai belum dipublikasikan oleh Ketua Program Studi.</p>
            </div>
        @else
            <div class="khs-table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Nilai</th>
                            <th>Angka</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $index => $n)
                            <tr>
                                <td class="col-no">{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $n->matkul->nama_mk ?? '-' }}</strong>
                                    <span class="kode-tag">{{ $n->kode_mk }}</span>
                                </td>
                                <td><span class="sks-badge">{{ $n->matkul->sks ?? 0 }}</span></td>
                                <td>
                                    <span class="grade-chip grade-{{ strtolower($n->nilai_huruf ?? '-') }}">
                                        {{ $n->nilai_huruf ?? '-' }}
                                    </span>
                                </td>
                                <td><span class="score-value">{{ number_format($n->nilai_akhir ?? 0, 1) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="khs-footer">
            <div class="khs-summary">
                <span class="summary-item">
                    <i class="fa-solid fa-chart-simple"></i>
                    IP Semester: <strong>{{ number_format($ips, 2) }}</strong>
                </span>
                <span class="summary-divider"></span>
                <span class="summary-item">
                    <i class="fa-solid fa-medal"></i>
                    IPK: <strong>{{ number_format($ipk, 2) }}</strong>
                </span>
            </div>
            <button type="button" class="btn-lihat-khs" id="openModal">
                <i class="fa-solid fa-file-lines"></i>
                Lihat KHS
            </button>
        </div>

    </div>

</div>

{{-- Modal KHS --}}
<div id="khsModal" class="khs-modal">
    <div class="khs-modal-content">

        <div class="khs-modal-topbar no-print">
            <span class="modal-badge"><i class="fa-solid fa-file-lines"></i> Preview KHS</span>
            <button type="button" class="khs-modal-close" aria-label="Tutup">&times;</button>
        </div>

        <div class="khs-modal-hero">
            <div class="modal-brand">
                <div class="modal-logo">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div>
                    <h2>POLITEKNIK NEGERI BATAM</h2>
                    <span>Sistem Akademik Mahasiswa</span>
                </div>
            </div>
            <div class="modal-doc-title">
                <h3>Kartu Hasil Studi</h3>
                <span>2025 / 2026 — Genap</span>
            </div>
        </div>

        <div class="khs-modal-info">
            <div class="info-card">
                <label><i class="fa-solid fa-user"></i> Nama</label>
                <strong>{{ $mahasiswa->nama ?? '-' }}</strong>
            </div>
            <div class="info-card">
                <label><i class="fa-solid fa-id-card"></i> NIM</label>
                <strong>{{ $mahasiswa->nim ?? '-' }}</strong>
            </div>
            <div class="info-card">
                <label><i class="fa-solid fa-graduation-cap"></i> Program Studi</label>
                <strong>{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</strong>
            </div>
            <div class="info-card">
                <label><i class="fa-solid fa-calendar"></i> Semester</label>
                <strong>{{ $mahasiswa->semester ?? '-' }}</strong>
            </div>
        </div>

        <div class="khs-modal-stats">
            <div class="modal-stat blue">
                <div class="modal-stat-icon"><i class="fa-solid fa-book-open"></i></div>
                <div>
                    <span>Total SKS</span>
                    <strong>{{ $totalSks }}</strong>
                </div>
            </div>
            <div class="modal-stat green">
                <div class="modal-stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                <div>
                    <span>IPS</span>
                    <strong>{{ number_format($ips, 2) }}</strong>
                </div>
            </div>
            <div class="modal-stat orange">
                <div class="modal-stat-icon"><i class="fa-solid fa-award"></i></div>
                <div>
                    <span>IPK</span>
                    <strong>{{ number_format($ipk, 2) }}</strong>
                </div>
            </div>
        </div>

        <div class="khs-modal-table-wrap">
            <table class="khs-modal-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Huruf</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilai as $index => $n)
                        <tr>
                            <td class="col-no">{{ $index + 1 }}</td>
                            <td><strong>{{ $n->matkul->nama_mk ?? '-' }}</strong></td>
                            <td><span class="sks-badge">{{ $n->matkul->sks ?? 0 }}</span></td>
                            <td>
                                <span class="grade-chip grade-{{ strtolower($n->nilai_huruf ?? '-') }}">
                                    {{ $n->nilai_huruf ?? '-' }}
                                </span>
                            </td>
                            <td>{{ number_format($n->nilai_akhir ?? 0, 1) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="modal-empty">Belum ada data nilai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="khs-modal-footer no-print">
            <button type="button" class="btn-modal-close">
                <i class="fa-solid fa-xmark"></i>
                Tutup
            </button>
            <a href="{{ route('khs.pdf') }}" class="btn-export-pdf">
                <i class="fa-solid fa-file-pdf"></i>
                Export PDF
            </a>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/khs.js') }}"></script>
@endpush
