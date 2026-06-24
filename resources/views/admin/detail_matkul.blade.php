@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Detail Mata Kuliah</h1>
    <p class="page-subtitle">
        Informasi lengkap mata kuliah
    </p>

    <div class="detail-card">

        <div class="detail-item">
            <label>Kode Mata Kuliah</label>
            <span>{{ $matkul->kode_mk }}</span>
        </div>

        <div class="detail-item">
            <label>Nama Mata Kuliah</label>
            <span>{{ $matkul->nama_mk }}</span>
        </div>

        <div class="detail-item">
            <label>SKS</label>
            <span>{{ $matkul->sks }}</span>
        </div>

        <div class="detail-item">
            <label>Program Studi</label>
            <span>{{ $matkul->kode_prodi }}</span>
        </div>

        <div class="detail-item">
            <label>Semester</label>
            <span>{{ $matkul->semester }}</span>
        </div>

    </div>

    <div style="margin-top:20px;">
        <a href="/admin/matkul" class="btn btn-info">
            Kembali
        </a>
    </div>

</div>

@endsection