@extends('kps.layout')

@section('title', 'Kunci Nilai')

@section('content')

<div class="kps-page kps-kunci-page">

    {{-- Hero --}}
    <div class="kps-page-hero">
        <div class="kps-page-hero-content">
            <span class="kps-page-hero-badge">
                <i class="fa-solid fa-lock"></i>
                Pengamanan Nilai
            </span>
            <h1>
                <i class="fa-solid fa-lock"></i>
                Kunci Nilai
            </h1>
            <p>Kunci nilai disetujui per program studi agar dosen tidak dapat mengubahnya. Buka kunci jika diperlukan koreksi.</p>
        </div>

        <div class="kps-page-hero-stat">
            <small>Total Disetujui</small>
            <strong>{{ $total }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="kps-mini-stats">
        <div class="kps-mini-stat-card">
            <div class="kps-mini-stat-icon orange">
                <i class="fa-solid fa-unlock"></i>
            </div>
            <div class="kps-mini-stat-info">
                <small>Belum Dikunci</small>
                <strong>{{ $belumTerkunci }}</strong>
            </div>
        </div>

        <div class="kps-mini-stat-card">
            <div class="kps-mini-stat-icon red">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="kps-mini-stat-info">
                <small>Nilai Terkunci</small>
                <strong>{{ $terkunci }}</strong>
            </div>
        </div>

        <div class="kps-mini-stat-card">
            <div class="kps-mini-stat-icon blue">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <div class="kps-mini-stat-info">
                <small>Total Record</small>
                <strong>{{ $total }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="kps-panel-toolbar">
        <div class="kps-toolbar-left">
            <span class="kps-toolbar-hint">
                <i class="fa-solid fa-circle-info"></i>
                Hanya nilai berstatus <strong>Disetujui</strong> yang dapat dikunci per program studi
            </span>
        </div>

        <div class="kps-toolbar-right">
            <input type="text" id="kpsKunciSearch" class="kps-search-input"
                   placeholder="Cari program studi...">
            <select id="kpsKunciFilter" class="kps-filter-select">
                <option value="">Semua Status</option>
                <option value="belum_dikunci">Belum Dikunci</option>
                <option value="terkunci">Terkunci</option>
            </select>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="kps-data-table-panel">
        <div class="kps-data-table-header">
            <h3><i class="fa-solid fa-table-list"></i> Daftar Program Studi</h3>
            <span class="kps-result-info">Menampilkan <strong id="kpsKunciCount">{{ $prodis->count() }}</strong> program studi</span>
        </div>

        <div class="kps-data-table-scroll">
            @if($prodis->isEmpty())
                <div class="kps-empty-state">
                    <i class="fa-solid fa-inbox"></i>
                    <p>Belum ada program studi terdaftar.</p>
                </div>
            @else
                <table class="kps-data-table" id="kpsKunciTable">
                    <thead>
                        <tr>
                            <th>Program Studi</th>
                            <th>Jumlah Nilai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prodis as $prodi)
                            @php
                                $isLocked = $prodi->status_kunci === 'terkunci';
                                $searchText = strtolower($prodi->nama_prodi . ' ' . $prodi->kode_prodi);
                            @endphp
                            <tr data-search="{{ $searchText }}" data-status="{{ $prodi->status_kunci }}">
                                <td>
                                    <strong>{{ $prodi->nama_prodi }}</strong>
                                    <br>
                                    <small class="kps-td-muted">{{ $prodi->kode_prodi }}</small>
                                </td>
                                <td>
                                    <strong>{{ number_format($prodi->jumlah_nilai) }}</strong>
                                    <br>
                                    <small class="kps-td-muted">nilai disetujui</small>
                                </td>
                                <td>
                                    @if($isLocked)
                                        <span class="kps-badge locked"><i class="fa-solid fa-lock"></i> Terkunci</span>
                                    @else
                                        <span class="kps-badge unlocked"><i class="fa-solid fa-unlock"></i> Belum Dikunci</span>
                                    @endif
                                </td>
                                <td class="kps-action-cell">
                                    @if($isLocked)
                                        <a href="/kps/kunci/unlock/{{ $prodi->kode_prodi }}"
                                           class="kps-btn-action unlock"
                                           onclick="return confirm('Buka kunci seluruh nilai pada {{ $prodi->nama_prodi }}? Dosen dapat mengubah nilai kembali.')">
                                            <i class="fa-solid fa-unlock"></i>
                                            Buka
                                        </a>
                                    @elseif($prodi->jumlah_nilai > 0)
                                        <a href="/kps/kunci/lock/{{ $prodi->kode_prodi }}"
                                           class="kps-btn-action lock"
                                           onclick="return confirm('Kunci seluruh nilai disetujui pada {{ $prodi->nama_prodi }}? Dosen tidak dapat mengubah nilai setelah dikunci.')">
                                            <i class="fa-solid fa-lock"></i>
                                            Kunci
                                        </a>
                                    @else
                                        <span class="kps-action-muted">Tidak ada nilai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="kps-empty-state kps-filter-empty" id="kpsKunciEmpty" hidden>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>Tidak ada data yang cocok dengan pencarian.</p>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/kps-kunci.js') }}"></script>
@endpush
