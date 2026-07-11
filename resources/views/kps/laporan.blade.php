@extends('kps.layout')

@section('title', 'Laporan Nilai')

@section('content')

@php
    $semesterFilter = request('semester', 'Semua Semester');
    $prodiFilter    = request('prodi', 'Semua Program Studi');
    $exportQuery    = http_build_query(array_filter([
        'semester' => $semesterFilter !== 'Semua Semester' ? $semesterFilter : null,
        'prodi'    => $prodiFilter !== 'Semua Program Studi' ? $prodiFilter : null,
    ]));
@endphp

<div class="kps-page kps-laporan-page">

    {{-- Hero --}}
    <div class="kps-page-hero">
        <div class="kps-page-hero-content">
            <span class="kps-page-hero-badge">
                <i class="fa-solid fa-chart-column"></i>
                Laporan & Ekspor
            </span>
            <h1>
                <i class="fa-solid fa-file-lines"></i>
                Laporan Nilai
            </h1>
            <p>Lihat rekap nilai mahasiswa yang telah disetujui, filter berdasarkan semester dan program studi, lalu ekspor ke PDF atau Excel.</p>
        </div>

        <div class="kps-page-hero-stat">
            <small>Total Record</small>
            <strong>{{ $total }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="kps-mini-stats">
        <div class="kps-mini-stat-card">
            <div class="kps-mini-stat-icon blue">
                <i class="fa-solid fa-book"></i>
            </div>
            <div class="kps-mini-stat-info">
                <small>Total Nilai</small>
                <strong>{{ $total }}</strong>
            </div>
        </div>

        <div class="kps-mini-stat-card">
            <div class="kps-mini-stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="kps-mini-stat-info">
                <small>Disetujui</small>
                <strong>{{ $disetujui }}</strong>
            </div>
        </div>

        <div class="kps-mini-stat-card">
            <div class="kps-mini-stat-icon red">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="kps-mini-stat-info">
                <small>Terkunci</small>
                <strong>{{ $terkunci }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="kps-panel-toolbar kps-laporan-toolbar">
        <div class="kps-toolbar-left">
            <form method="GET" action="/kps/laporan" class="kps-laporan-filter-form">
                <select name="semester" class="kps-filter-select">
                    <option value="Semua Semester" @selected($semesterFilter === 'Semua Semester')>Semua Semester</option>
                    <option value="Ganjil" @selected($semesterFilter === 'Ganjil')>Ganjil</option>
                    <option value="Genap" @selected($semesterFilter === 'Genap')>Genap</option>
                </select>

                <select name="prodi" class="kps-filter-select kps-filter-select-wide">
                    <option @selected($prodiFilter === 'Semua Program Studi')>Semua Program Studi</option>
                    <option @selected($prodiFilter === 'D3 Teknik Informatika')>D3 Teknik Informatika</option>
                    <option @selected($prodiFilter === 'D3 Teknik Geomatika')>D3 Teknik Geomatika</option>
                    <option @selected($prodiFilter === 'D4 Animasi')>D4 Animasi</option>
                    <option @selected($prodiFilter === 'D4 Teknologi Rekayasa Multimedia')>D4 Teknologi Rekayasa Multimedia</option>
                    <option @selected($prodiFilter === 'D4 Keamanan Siber')>D4 Keamanan Siber</option>
                    <option @selected($prodiFilter === 'D4 Rekayasa Perangkat Lunak')>D4 Rekayasa Perangkat Lunak</option>
                    <option @selected($prodiFilter === 'D4 Teknologi Permainan')>D4 Teknologi Permainan</option>
                    <option @selected($prodiFilter === 'Magister Terapan Teknik Komputer')>Magister Terapan Teknik Komputer</option>
                </select>

                <button type="submit" class="kps-btn-filter-modern">
                    <i class="fa-solid fa-filter"></i>
                    Terapkan
                </button>
            </form>
        </div>

        <div class="kps-toolbar-right">
            <input type="text" id="kpsLaporanSearch" class="kps-search-input"
                   placeholder="Cari NIM, mahasiswa, mata kuliah, atau dosen...">
            <select id="kpsLaporanFilter" class="kps-filter-select">
                <option value="">Semua Status</option>
                <option value="approved">Disetujui</option>
                <option value="locked">Terkunci</option>
            </select>

            <a href="/kps/laporan/pdf{{ $exportQuery ? '?' . $exportQuery : '' }}" class="kps-btn-export pdf">
                <i class="fa-solid fa-file-pdf"></i>
                PDF
            </a>
            <a href="/kps/laporan/excel{{ $exportQuery ? '?' . $exportQuery : '' }}" class="kps-btn-export excel">
                <i class="fa-solid fa-file-excel"></i>
                Excel
            </a>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="kps-data-table-panel">
        <div class="kps-data-table-header">
            <h3><i class="fa-solid fa-table-list"></i> Daftar Nilai Disetujui</h3>
            <span class="kps-result-info">
                Menampilkan <strong id="kpsLaporanCount">{{ $total }}</strong> data
                @if($belumTerkunci > 0)
                    &middot; <span class="kps-result-muted">{{ $belumTerkunci }} belum terkunci</span>
                @endif
            </span>
        </div>

        <div class="kps-data-table-scroll">
            @if($data->isEmpty())
                <div class="kps-empty-state">
                    <i class="fa-solid fa-inbox"></i>
                    <p>Belum ada data laporan nilai yang disetujui.</p>
                </div>
            @else
                <table class="kps-data-table kps-laporan-table" id="kpsLaporanTable">
                    <thead>
                        <tr>
                            <th class="col-nim">NIM</th>
                            <th class="col-mahasiswa">Mahasiswa</th>
                            <th class="col-matkul">Mata Kuliah</th>
                            <th class="col-dosen">Dosen</th>
                            <th class="col-prodi">Program Studi</th>
                            <th class="col-semester">Semester</th>
                            <th class="col-nilai">Nilai</th>
                            <th class="col-status">Status</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            @php
                                $isLocked = \App\Models\Nilai::isLockedValue($item->kunci_nilai);
                                $nama = $item->nama_mahasiswa ?? '-';
                                $initial = strtoupper(substr($nama, 0, 1));
                                $semesterLabel = ucfirst($item->semester_mk ?? '-');
                                $dosenNama = $item->nama_dosen ?: ($item->dosen_pengampu ?? '-');
                                $gradeKey = strtolower(substr(preg_replace('/[^A-Za-z]/', '', $item->nilai_huruf ?? ''), 0, 1)) ?: 'x';
                                $searchText = strtolower(implode(' ', [
                                    $item->nim,
                                    $nama,
                                    $item->nama_mk ?? '',
                                    $item->kode_mk,
                                    $dosenNama !== '-' ? $dosenNama : '',
                                    $item->nama_prodi ?? '',
                                ]));
                                $filterStatus = $isLocked ? 'locked' : 'approved';
                            @endphp
                            <tr data-search="{{ $searchText }}" data-status="{{ $filterStatus }}">
                                <td>
                                    <span class="kps-kode-tag">{{ $item->nim }}</span>
                                </td>
                                <td>
                                    <div class="kps-student-cell">
                                        <div class="kps-student-avatar">{{ $initial }}</div>
                                        <div>
                                            <strong>{{ $nama }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="kps-matkul-cell">
                                        <strong>{{ $item->nama_mk ?? $item->kode_mk }}</strong>
                                        <small class="kps-td-muted">{{ $item->kode_mk }}</small>
                                    </div>
                                </td>
                                <td>{{ $dosenNama }}</td>
                                <td>{{ $item->nama_prodi ?? '-' }}</td>
                                <td>
                                    <span class="kps-semester-tag">{{ $semesterLabel }}</span>
                                </td>
                                <td>
                                    <span class="kps-grade-badge grade-{{ $gradeKey }}">
                                        {{ $item->nilai_huruf ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if($isLocked)
                                        <span class="kps-badge locked"><i class="fa-solid fa-lock"></i> Terkunci</span>
                                    @else
                                        <span class="kps-badge approved"><i class="fa-solid fa-check"></i> Disetujui</span>
                                    @endif
                                </td>
                                <td class="kps-action-cell">
                                    <a href="/kps/laporan/detail/{{ $item->nim }}/{{ $item->kode_mk }}"
                                       class="kps-btn-icon detail"
                                       title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="kps-empty-state kps-filter-empty" id="kpsLaporanEmpty" hidden>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>Tidak ada data yang cocok dengan pencarian.</p>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/kps-laporan.js') }}"></script>
@endpush
