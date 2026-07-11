@extends('layouts.admin')

@section('content')

<div class="admin-page laporan-khs-page">

    {{-- Hero --}}
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="page-hero-badge">
                <i class="fa-solid fa-chart-column"></i>
                Laporan
            </span>
            <h1>
                <i class="fa-solid fa-graduation-cap"></i>
                Laporan KHS
            </h1>
            <p>Data seluruh nilai mahasiswa Politeknik Negeri Batam.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total Nilai</small>
            <strong>{{ $totalKhs }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats mini-stats-4">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-list-ol"></i>
            </div>
            <div class="mini-stat-info">
                <small>Total Nilai</small>
                <strong>{{ $totalKhs }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="mini-stat-info">
                <small>Nilai A</small>
                <strong>{{ $nilaiA }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-bookmark"></i>
            </div>
            <div class="mini-stat-info">
                <small>Nilai B</small>
                <strong>{{ $nilaiB }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon slate">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="mini-stat-info">
                <small>C / D / E</small>
                <strong>{{ $nilaiCD }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="panel-toolbar laporan-toolbar">
        <div class="toolbar-left">
            <a href="{{ url('/admin/laporan-khs/pdf?' . http_build_query(request()->only(['search', 'nilai_huruf']))) }}" class="btn-pdf-custom">
                <i class="fa-solid fa-file-pdf"></i>
                PDF
            </a>

            <a href="{{ url('/admin/laporan-khs/excel?' . http_build_query(request()->only(['search', 'nilai_huruf']))) }}" class="btn-success-custom">
                <i class="fa-solid fa-file-excel"></i>
                Export
            </a>
        </div>

        <form method="GET" action="/admin/laporan-khs" class="laporan-filter-form">
            <input
                type="text"
                name="search"
                class="search-modern"
                value="{{ request('search') }}"
                placeholder="Cari NIM atau nama mahasiswa...">

            <select name="nilai_huruf" class="filter-select">
                <option value="">Semua Nilai</option>
                @foreach(['A', 'B', 'C', 'D', 'E'] as $huruf)
                    <option value="{{ $huruf }}" @selected(request('nilai_huruf') == $huruf)>{{ $huruf }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Data Laporan KHS</h3>
            <span class="result-info">
                Menampilkan <strong>{{ $nilai->firstItem() ?? 0 }}–{{ $nilai->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $nilai->total() }}</strong> data
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </span>
        </div>

        @if($nilai->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-folder-open"></i>
                <h4>Tidak ada data nilai</h4>
                <p>
                    @if(request()->hasAny(['search', 'nilai_huruf']))
                        Tidak ditemukan data dengan filter yang dipilih.
                    @else
                        Belum ada data nilai mahasiswa.
                    @endif
                </p>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Nilai Akhir</th>
                            <th>Nilai Huruf</th>
                            <th>Index</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $item)
                            <tr>
                                <td>{{ ($nilai->currentPage() - 1) * $nilai->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $item->mahasiswa->nama ?? '–' }}</div>
                                        <div class="student-nim">{{ $item->nim }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="kode-tag">{{ $item->kode_mk }}</span>
                                    @if($item->matkul)
                                        <div class="mk-sub">{{ $item->matkul->nama_mk }}</div>
                                    @endif
                                </td>
                                <td>{{ $item->nilai_akhir }}</td>
                                <td>
                                    @php $huruf = strtoupper(substr($item->nilai_huruf, 0, 1)); @endphp
                                    @if($huruf == 'A')
                                        <span class="nilai-badge nilai-badge-a">{{ $item->nilai_huruf }}</span>
                                    @elseif($huruf == 'B')
                                        <span class="nilai-badge nilai-badge-b">{{ $item->nilai_huruf }}</span>
                                    @else
                                        <span class="nilai-badge nilai-badge-c">{{ $item->nilai_huruf }}</span>
                                    @endif
                                </td>
                                <td><span class="semester-badge">{{ $item->index_nilai }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <span class="pagination-info">
                    Halaman {{ $nilai->currentPage() }} dari {{ $nilai->lastPage() }}
                </span>
                <div class="pagination-wrapper">
                    {{ $nilai->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var search = document.querySelector('.laporan-filter-form .search-modern');
    if (!search) return;

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

@endsection
