@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
        Detail Dosen
    </h1>

    <div class="detail-card">

  <div class="detail-grid">

    <div class="detail-item">
        <label>NUPTK</label>
        <div>{{ $dosen->nuptk }}</div>
    </div>

    <div class="detail-item">
        <label>Nama</label>
        <div>{{ $dosen->nama }}</div>
    </div>

    <div class="detail-item">
        <label>Email</label>
        <div>{{ $dosen->email }}</div>
    </div>

    <div class="detail-item">
        <label>Jabatan</label>
        <div>{{ $dosen->jabatan }}</div>
    </div>

    <div class="detail-item">
        <label>Program Studi</label>
        <div>{{ $dosen->kode_prodi }}</div>
    </div>

</div>

        <br>

        <a href="/admin/dosen"
   class="btn btn-info btn-small">
    <i class="fa-solid fa-arrow-left"></i>Kembali
</a>

    </div>

</div>

@endsection