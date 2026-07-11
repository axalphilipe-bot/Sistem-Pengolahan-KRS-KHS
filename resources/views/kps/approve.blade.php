@extends('kps.layout')



@section('title', 'Validasi Nilai')



@section('content')



@php

    $pendingCount   = $nilais->whereIn('status', ['Pending', 'Menunggu Approval'])->count();

    $disetujuiCount = $nilais->where('status', 'Disetujui')->count();

    $ditolakCount   = $nilais->where('status', 'Ditolak')->count();

    $totalMahasiswa = $mahasiswaList->count();

@endphp



<div class="kps-page kps-approve-page">



    {{-- Hero --}}

    <div class="kps-page-hero">

        <div class="kps-page-hero-content">

            <span class="kps-page-hero-badge">

                <i class="fa-solid fa-circle-check"></i>

                Pengelolaan Nilai

            </span>

            <h1>

                <i class="fa-solid fa-square-check"></i>

                Validasi Nilai

            </h1>

            <p>Tinjau dan setujui nilai mahasiswa per NIM sebelum dipublikasikan ke KHS.</p>

        </div>



        <div class="kps-page-hero-stat">

            <small>Total Mahasiswa</small>

            <strong>{{ $totalMahasiswa }}</strong>

        </div>

    </div>



    {{-- Mini stats --}}

    <div class="kps-mini-stats">

        <div class="kps-mini-stat-card">

            <div class="kps-mini-stat-icon yellow">

                <i class="fa-solid fa-clock"></i>

            </div>

            <div class="kps-mini-stat-info">

                <small>Pending</small>

                <strong>{{ $pendingCount }}</strong>

            </div>

        </div>



        <div class="kps-mini-stat-card">

            <div class="kps-mini-stat-icon green">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div class="kps-mini-stat-info">

                <small>Disetujui</small>

                <strong>{{ $disetujuiCount }}</strong>

            </div>

        </div>



        <div class="kps-mini-stat-card">

            <div class="kps-mini-stat-icon red">

                <i class="fa-solid fa-xmark"></i>

            </div>

            <div class="kps-mini-stat-info">

                <small>Ditolak</small>

                <strong>{{ $ditolakCount }}</strong>

            </div>

        </div>

    </div>



    {{-- Toolbar --}}

    <div class="kps-panel-toolbar">

        <div class="kps-toolbar-left">

            @if($adaDisetujuiBelumDikunci)

                <form method="POST" action="/kps/approve/kunci-semua" class="kps-lock-all-form">

                    @csrf

                    <button type="submit" class="kps-btn-lock-all"

                            onclick="return confirm('Kunci semua nilai yang berstatus Disetujui? Dosen tidak dapat mengubah nilai setelah dikunci.')">

                        <i class="fa-solid fa-lock"></i>

                        Kunci Semua Nilai

                    </button>

                </form>

            @endif

        </div>



        <div class="kps-toolbar-right">

            <input type="text" id="kpsApproveSearch" class="kps-search-input"

                   placeholder="Cari NIM, nama, atau mata kuliah...">

            <select id="kpsApproveFilter" class="kps-filter-select">

                <option value="">Semua Status</option>

                <option value="pending">Pending</option>

                <option value="disetujui">Disetujui</option>

                <option value="ditolak">Ditolak</option>

                <option value="locked">Terkunci</option>

            </select>

        </div>

    </div>



    {{-- Tabel --}}

    <div class="kps-data-table-panel">

        <div class="kps-data-table-header">

            <h3><i class="fa-solid fa-table-list"></i> Daftar Mahasiswa</h3>

            <span class="kps-result-info">Menampilkan <strong id="kpsApproveCount">{{ $totalMahasiswa }}</strong> mahasiswa</span>

        </div>



        <div class="kps-data-table-scroll">

            @if($mahasiswaList->isEmpty())

                <div class="kps-empty-state">

                    <i class="fa-solid fa-inbox"></i>

                    <p>Belum ada data nilai untuk divalidasi.</p>

                </div>

            @else

                <table class="kps-data-table" id="kpsApproveTable">

                    <thead>

                        <tr>

                            <th>NIM</th>

                            <th>Mahasiswa</th>

                            <th>Jumlah MK</th>

                            <th>Ringkasan</th>

                            <th>Status Validasi</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($mahasiswaList as $mhs)

                            @php

                                $initial = strtoupper(substr($mhs->nama, 0, 1));

                                $detailItems = $mhs->nilais->map(function ($nilai) {

                                    $status = in_array($nilai->status, ['Pending', 'Menunggu Approval'])

                                        ? 'Pending'

                                        : $nilai->status;

                                    $terkunci = \App\Models\Nilai::isLockedValue($nilai->kunci_nilai);



                                    return [

                                        'kode_mk' => $nilai->kode_mk,

                                        'nama_mk' => $nilai->nama_mk ?? $nilai->kode_mk,

                                        'nilai_huruf' => $nilai->nilai_huruf ?? '-',

                                        'nilai_akhir' => number_format($nilai->nilai_akhir ?? 0, 1),

                                        'index_nilai' => $nilai->index_nilai ?? '-',

                                        'status' => $terkunci ? 'Terkunci' : $status,

                                    ];

                                })->values();

                            @endphp

                            <tr data-search="{{ $mhs->search_text }}" data-status="{{ $mhs->status }}">

                                <td>

                                    <span class="kps-kode-tag">{{ $mhs->nim }}</span>

                                </td>

                                <td>

                                    <div class="kps-student-cell">

                                        <div class="kps-student-avatar">{{ $initial }}</div>

                                        <div>

                                            <strong>{{ $mhs->nama }}</strong>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <strong>{{ $mhs->jumlah_mk }}</strong>

                                    <br>

                                    <small class="kps-td-muted">mata kuliah</small>

                                </td>

                                <td>

                                    <p class="kps-approve-summary">{{ \Illuminate\Support\Str::limit($mhs->ringkasan, 55) }}</p>

                                    <button type="button"

                                            class="kps-btn-detail-link kps-approve-detail-btn"

                                            data-nim="{{ $mhs->nim }}"

                                            data-nama="{{ $mhs->nama }}"

                                            data-detail='@json($detailItems)'>

                                        <i class="fa-solid fa-eye"></i>

                                        Lihat Detail

                                    </button>

                                </td>

                                <td>

                                    @if($mhs->status === 'locked')

                                        <span class="kps-badge locked"><i class="fa-solid fa-lock"></i> Terkunci</span>

                                    @elseif($mhs->status === 'pending')

                                        <span class="kps-badge waiting"><i class="fa-solid fa-clock"></i> Pending</span>

                                    @elseif($mhs->status === 'disetujui')

                                        <span class="kps-badge approved"><i class="fa-solid fa-check"></i> Disetujui</span>

                                    @else

                                        <span class="kps-badge rejected"><i class="fa-solid fa-xmark"></i> Ditolak</span>

                                    @endif

                                </td>

                                <td class="kps-action-cell">

                                    @if($mhs->status === 'locked')

                                        <span class="kps-action-muted"><i class="fa-solid fa-lock"></i> Sudah dikunci</span>

                                    @elseif($mhs->can_act)

                                        <div class="kps-approve-action-group">

                                            <a href="/kps/approve/setujui/{{ $mhs->nim }}/{{ $mhs->first_kode_mk }}"

                                               class="kps-btn-action approve-all"

                                               onclick="return confirm('Setujui semua nilai Pending mahasiswa {{ $mhs->nama }}?')">

                                                <i class="fa-solid fa-check"></i>

                                                Setujui Semua

                                            </a>

                                            <a href="/kps/approve/tolak/{{ $mhs->nim }}/{{ $mhs->first_kode_mk }}"

                                               class="kps-btn-action reject-all"

                                               onclick="return confirm('Tolak semua nilai mahasiswa {{ $mhs->nama }}?')">

                                                <i class="fa-solid fa-xmark"></i>

                                                Tolak Semua

                                            </a>

                                        </div>

                                    @elseif($mhs->status === 'disetujui')

                                        <span class="kps-action-muted"><i class="fa-solid fa-hourglass-half"></i> Menunggu dikunci</span>

                                    @else

                                        <span class="kps-action-muted">—</span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>



                <div class="kps-empty-state kps-filter-empty" id="kpsApproveEmpty" hidden>

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <p>Tidak ada data yang cocok dengan pencarian.</p>

                </div>

            @endif

        </div>

    </div>



</div>



{{-- Modal Detail --}}

<div class="kps-approve-modal" id="kpsApproveModal" hidden>

    <div class="kps-approve-modal-backdrop" data-close-modal></div>

    <div class="kps-approve-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="kpsApproveModalTitle">

        <div class="kps-approve-modal-header">

            <div>

                <span class="kps-approve-modal-badge"><i class="fa-solid fa-list-check"></i> Detail Nilai</span>

                <h3 id="kpsApproveModalTitle">—</h3>

                <p id="kpsApproveModalSubtitle">—</p>

            </div>

            <button type="button" class="kps-approve-modal-close" data-close-modal aria-label="Tutup">&times;</button>

        </div>

        <div class="kps-approve-modal-body">

            <table class="kps-data-table kps-approve-detail-table">

                <thead>

                    <tr>

                        <th>Mata Kuliah</th>

                        <th>Nilai</th>

                        <th>Index</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody id="kpsApproveModalBody"></tbody>

            </table>

        </div>

    </div>

</div>



@endsection



@push('scripts')

<script src="{{ asset('js/kps-approve.js') }}"></script>

@endpush


