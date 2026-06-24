@extends('layouts.admin')

@section('content')

<div class="admin-page">

<div class="detail-header">
    <h1>👨‍🎓 Detail Mahasiswa</h1>
    <p>Informasi lengkap data mahasiswa</p>
</div>

<div class="detail-grid">

    <div class="detail-item">
        <label>NIM</label>
        <div>{{ $mahasiswa->nim }}</div>
    </div>

    <div class="detail-item">
        <label>Nama Mahasiswa</label>
        <div>{{ $mahasiswa->nama }}</div>
    </div>

    <div class="detail-item">
        <label>Email</label>
        <div>{{ $mahasiswa->email }}</div>
    </div>

    <div class="detail-item">
        <label>Program Studi</label>
        <div>{{ $mahasiswa->kode_prodi }}</div>
    </div>

    <div class="detail-item">
        <label>Semester</label>
        <div>{{ $mahasiswa->semester }}</div>
    </div>

    <div class="detail-item">
        <label>Kelas</label>
        <div>{{ $mahasiswa->kelas }}</div>
    </div>

    <div class="detail-item">
        <label>Kelas Huruf</label>
        <div>{{ $mahasiswa->kelas_huruf }}</div>
    </div>

    <div class="detail-item">
        <label>Status</label>
        <div>
            <span class="badge-success">
                Aktif
            </span>
        </div>
    </div>

</div>

<div class="detail-action">

    <a href="/admin/mahasiswa"
       class="btn-small btn-back">
        <i class="fa fa-arrow-left"></i>
        Kembali
    </a>

</div>
```

</div>

@endsection
