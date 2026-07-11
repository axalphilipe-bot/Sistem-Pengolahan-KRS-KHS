@extends('kps.layout')

@section('title', 'Detail Nilai')

@section('content')

@php
    $dosenNama = $nilai->nama_dosen ?: ($nilai->dosen_pengampu ?? '-');
    $gradeKey = strtolower(substr(preg_replace('/[^A-Za-z]/', '', $nilai->nilai_huruf ?? ''), 0, 1)) ?: 'x';
    $isLocked = \App\Models\Nilai::isLockedValue($nilai->kunci_nilai);
    $initial = strtoupper(substr($nilai->nama ?? '-', 0, 1));
    $semesterLabel = ucfirst($nilai->semester_mk ?? '-');

    $components = [
        ['label' => 'Keaktifan', 'value' => $nilai->keaktifan, 'weight' => 15, 'icon' => 'fa-solid fa-hand-sparkles'],
        ['label' => 'Proyek', 'value' => $nilai->proyek, 'weight' => 35, 'icon' => 'fa-solid fa-diagram-project'],
        ['label' => 'Tugas', 'value' => $nilai->tugas, 'weight' => 10, 'icon' => 'fa-solid fa-file-lines'],
        ['label' => 'Kuis', 'value' => $nilai->kuis, 'weight' => 10, 'icon' => 'fa-solid fa-circle-question'],
        ['label' => 'UTS', 'value' => $nilai->uts, 'weight' => 15, 'icon' => 'fa-solid fa-pen-to-square'],
        ['label' => 'UAS', 'value' => $nilai->uas, 'weight' => 15, 'icon' => 'fa-solid fa-clipboard-check'],
    ];
@endphp

<div class="kps-page kps-detail-nilai-page">

    <a href="/kps/laporan" class="kps-detail-back">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Laporan
    </a>

    {{-- Hero --}}
    <div class="kps-page-hero kps-detail-hero">
        <div class="kps-page-hero-content">
            <span class="kps-page-hero-badge">
                <i class="fa-solid fa-user-graduate"></i>
                Detail Nilai Mahasiswa
            </span>
            <h1>
                <span class="kps-detail-avatar">{{ $initial }}</span>
                {{ $nilai->nama }}
            </h1>
            <p>
                <span class="kps-kode-tag kps-detail-nim">{{ $nilai->nim }}</span>
                &middot; {{ $nilai->nama_mk }}
                &middot; {{ $nilai->nama_prodi ?? '-' }}
            </p>
        </div>

        <div class="kps-page-hero-stat kps-detail-grade-stat">
            <small>Nilai Huruf</small>
            <span class="kps-grade-badge grade-{{ $gradeKey }} kps-detail-grade-badge">
                {{ $nilai->nilai_huruf ?? '-' }}
            </span>
        </div>
    </div>

    {{-- Info cards --}}
    <div class="kps-detail-info-grid">
        <div class="kps-detail-info-card">
            <div class="kps-detail-info-icon blue">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <small>Mata Kuliah</small>
                <strong>{{ $nilai->nama_mk }}</strong>
                <span class="kps-td-muted">{{ $nilai->kode_mk }}</span>
            </div>
        </div>

        <div class="kps-detail-info-card">
            <div class="kps-detail-info-icon purple">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div>
                <small>Dosen Pengampu</small>
                <strong>{{ $dosenNama }}</strong>
            </div>
        </div>

        <div class="kps-detail-info-card">
            <div class="kps-detail-info-icon orange">
                <i class="fa-solid fa-calendar"></i>
            </div>
            <div>
                <small>Semester</small>
                <strong>{{ $semesterLabel }}</strong>
            </div>
        </div>

        <div class="kps-detail-info-card">
            <div class="kps-detail-info-icon {{ $isLocked ? 'red' : 'green' }}">
                <i class="fa-solid {{ $isLocked ? 'fa-lock' : 'fa-circle-check' }}"></i>
            </div>
            <div>
                <small>Status Nilai</small>
                @if($isLocked)
                    <span class="kps-badge locked"><i class="fa-solid fa-lock"></i> Terkunci</span>
                @else
                    <span class="kps-badge approved"><i class="fa-solid fa-check"></i> Disetujui</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Komponen nilai --}}
    <div class="kps-data-table-panel kps-detail-panel">
        <div class="kps-data-table-header">
            <h3><i class="fa-solid fa-chart-simple"></i> Komponen Nilai</h3>
            <span class="kps-result-info kps-result-muted">
                Bobot: Aktif 15% · Proyek 35% · Tugas 10% · Kuis 10% · UTS 15% · UAS 15%
            </span>
        </div>

        <div class="kps-detail-components">
            @foreach($components as $component)
                @php
                    $score = (float) ($component['value'] ?? 0);
                    $barWidth = min(max($score, 0), 100);
                @endphp
                <div class="kps-detail-component">
                    <div class="kps-detail-component-head">
                        <div class="kps-detail-component-label">
                            <i class="{{ $component['icon'] }}"></i>
                            <span>{{ $component['label'] }}</span>
                            <small class="kps-td-muted">{{ $component['weight'] }}%</small>
                        </div>
                        <strong>{{ number_format($score, 0) }}</strong>
                    </div>
                    <div class="kps-detail-progress">
                        <div class="kps-detail-progress-bar" style="width: {{ $barWidth }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="kps-detail-summary">
        <div class="kps-detail-summary-card">
            <div class="kps-detail-summary-icon blue">
                <i class="fa-solid fa-calculator"></i>
            </div>
            <small>Nilai Akhir</small>
            <strong>{{ number_format($nilai->nilai_akhir ?? 0, 1) }}</strong>
        </div>

        <div class="kps-detail-summary-card highlight">
            <div class="kps-detail-summary-icon green">
                <i class="fa-solid fa-star"></i>
            </div>
            <small>Nilai Huruf</small>
            <span class="kps-grade-badge grade-{{ $gradeKey }} kps-detail-summary-grade">
                {{ $nilai->nilai_huruf ?? '-' }}
            </span>
        </div>

        <div class="kps-detail-summary-card">
            <div class="kps-detail-summary-icon indigo">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <small>Index Nilai</small>
            <strong>{{ number_format($nilai->index_nilai ?? 0, 2) }}</strong>
        </div>
    </div>

</div>

@endsection
