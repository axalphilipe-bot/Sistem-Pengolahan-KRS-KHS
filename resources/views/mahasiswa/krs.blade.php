@extends('layouts.mahasiswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/mahasiswa-krs.css') }}">
@endpush

@section('content')

<div class="mhs-krs">

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="krs-alert-card success">
            <div class="alert-icon-wrap success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="alert-body">
                <strong>Berhasil!</strong>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if(session('error'))
        <div class="krs-alert-card error">
            <div class="alert-icon-wrap error">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="alert-body">
                <strong>Gagal</strong>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Notifikasi Sudah Diambil --}}
    @if(session('warning_title'))
        <div class="krs-alert-card warning">
            <div class="alert-icon-wrap warning">
                <i class="fa-solid fa-bookmark"></i>
            </div>
            <div class="alert-body">
                <strong>{{ session('warning_title') }}</strong>
                <p>{{ session('warning_message') }}</p>
                @if(session('warning_items'))
                    <ul class="alert-items">
                        @foreach(session('warning_items') as $item)
                            <li><i class="fa-solid fa-book"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif

    <div class="krs-card">

        <div class="krs-page-header">
            <div class="krs-header-icon">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <div>
                <h1>Ambil KRS</h1>
                <p>Pilih semester untuk menampilkan mata kuliah program studi Anda.</p>
            </div>
        </div>

        <div class="krs-filter-box">
            <form method="GET" action="{{ url('/krs') }}" class="krs-filter-form">
                <div class="krs-filter-row">
                    <div class="krs-filter-item">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="krs-select">
                            <option value="">Pilih Semester</option>
                            <option value="ganjil" {{ ($semester ?? request('semester')) == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="genap" {{ ($semester ?? request('semester')) == 'genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>

                    @if($mahasiswa && $prodiMahasiswa)
                        <div class="krs-filter-item">
                            <label>Program Studi</label>
                            <div class="krs-prodi-readonly">
                                {{ $mahasiswa->prodi->nama_prodi ?? $prodiMahasiswa }}
                                <span class="krs-prodi-code">({{ $prodiMahasiswa }})</span>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn-tampilkan">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>

        <div class="krs-info-banner">
            <i class="fa-solid fa-circle-info"></i>
            <span>Maksimal <strong>24 SKS</strong> per semester. Pastikan tidak ada bentrok jadwal.</span>
        </div>

        <form method="POST" action="{{ route('krs.store') }}" class="krs-form">
            @csrf

            <div class="krs-table-header">
                <h3><i class="fa-solid fa-list-check"></i> Daftar Mata Kuliah</h3>
                @if($mataKuliah->isNotEmpty())
                    @php
                        $jumlahDiambil = $mataKuliah->filter(fn($m) => $krsDiambil->has($m->kode_mk))->count();
                        $jumlahTersedia = $mataKuliah->count() - $jumlahDiambil;
                    @endphp
                    <div class="krs-legend">
                        <span class="legend-dot available"></span> {{ $jumlahTersedia }} tersedia
                        <span class="legend-dot taken"></span> {{ $jumlahDiambil }} sudah diambil
                    </div>
                @endif
            </div>

            @if($mataKuliah->isEmpty())
                <div class="krs-empty">
                    <div class="krs-empty-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <h4>Belum ada mata kuliah ditampilkan</h4>
                    <p>Pilih semester dan prodi di atas, lalu klik <strong>Tampilkan</strong>.</p>
                </div>
            @else
                <div class="krs-table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Jenis</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mataKuliah as $m)
                                @php
                                    $krsItem = $krsDiambil->get($m->kode_mk);
                                    $sudahDiambil = $krsItem !== null;
                                @endphp
                                <tr class="{{ $sudahDiambil ? 'row-taken' : '' }}">
                                    <td><span class="kode-tag">{{ $m->kode_mk }}</span></td>
                                    <td>
                                        <strong>{{ $m->nama_mk }}</strong>
                                        @if($sudahDiambil)
                                            <span class="taken-hint">Sudah diajukan</span>
                                        @endif
                                    </td>
                                    <td><span class="sks-badge">{{ $m->sks }}</span></td>
                                    <td>{{ $m->dosen }}</td>
                                    <td>
                                        @if($m->jenis == 'wajib')
                                            <span class="jenis-badge wajib">Wajib</span>
                                        @else
                                            <span class="jenis-badge pilihan">Pilihan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sudahDiambil)
                                            @if($krsItem->status === 'Disetujui')
                                                <span class="status-chip approved">
                                                    <i class="fa-solid fa-check"></i> Disetujui
                                                </span>
                                            @elseif($krsItem->status === 'Pending')
                                                <span class="status-chip pending">
                                                    <i class="fa-solid fa-clock"></i> Menunggu
                                                </span>
                                            @else
                                                <span class="status-chip rejected">
                                                    <i class="fa-solid fa-xmark"></i> Ditolak
                                                </span>
                                            @endif
                                        @else
                                            <label class="checkbox-modern" title="Pilih mata kuliah">
                                                <input type="checkbox"
                                                       name="mata_kuliah[]"
                                                       value="{{ $m->kode_mk }}"
                                                       data-sks="{{ $m->sks }}"
                                                       class="matkul">
                                                <span></span>
                                            </label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="krs-footer">
                    <div class="footer-left">
                        <div class="footer-sks">
                            Total SKS: <strong><span id="total-sks">0</span> / 24</strong>
                        </div>
                        <div class="sks-bar">
                            <div class="sks-bar-fill" id="sks-bar-fill"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn-ambil">
                        <i class="fa-solid fa-file-circle-check"></i>
                        Ambil KRS
                    </button>
                </div>
            @endif

        </form>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/krs.js') }}"></script>
@endpush
