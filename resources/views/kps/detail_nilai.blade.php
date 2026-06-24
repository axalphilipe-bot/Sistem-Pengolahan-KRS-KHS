@extends('kps.layout')

@section('content')

<style>

.detail-wrapper{
    display:flex;
    justify-content:center;
}

.detail-card{
    width:550px;
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.detail-title{
    text-align:center;
    margin-bottom:15px;
    color:#1f2937;
    font-size:28px;
    font-weight:700;
}

.info{
    margin-bottom:15px;
    line-height:1.8;
    font-size:15px;
}

.info strong{
    color:#111827;
}

.nilai-table{
    width:100%;
    border-collapse:collapse;
}

.nilai-table td{
    padding:10px;
    border-bottom:1px solid #eee;
    font-size:15px;
}

.nilai-table td:first-child{
    font-weight:600;
    color:#374151;
}

.nilai-table td:last-child{
    text-align:right;
    font-weight:bold;
}

.summary{
    display:flex;
    justify-content:space-between;
    gap:10px;
    margin-top:18px;
}

.summary-card{
    flex:1;
    padding:12px;
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:10px;
    text-align:center;
}

.summary-card h5{
    color:#6b7280;
    margin-bottom:8px;
    font-size:13px;
}

.summary-card h2{
    color:#2563eb;
    margin:0;
    font-size:28px;
}

.grade{
    display:inline-block;
    background:#22c55e;
    color:white;
    padding:5px 12px;
    border-radius:8px;
    font-size:18px;
    font-weight:bold;
}

.btn-back{
    display:inline-block;
    margin-top:18px;
    background:#2563eb;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
}

.btn-back:hover{
    background:#1d4ed8;
}

</style>

<div class="detail-wrapper">

    <div class="detail-card">

        <h1 class="detail-title">
            Detail Nilai Mahasiswa
        </h1>

        <div class="info">
            <strong>Nama Mahasiswa :</strong>
            {{ $nilai->nama }}
            <br>

            <strong>Mata Kuliah :</strong>
            {{ $nilai->nama_mk }}
            <br>

            <strong>Dosen :</strong>
            {{ $nilai->nama_dosen }}
        </div>

        <table class="nilai-table">

            <tr>
                <td>Keaktifan</td>
                <td>{{ $nilai->keaktifan }}</td>
            </tr>

            <tr>
                <td>Proyek</td>
                <td>{{ $nilai->proyek }}</td>
            </tr>

            <tr>
                <td>Tugas</td>
                <td>{{ $nilai->tugas }}</td>
            </tr>

            <tr>
                <td>Kuis</td>
                <td>{{ $nilai->kuis }}</td>
            </tr>

            <tr>
                <td>UTS</td>
                <td>{{ $nilai->uts }}</td>
            </tr>

            <tr>
                <td>UAS</td>
                <td>{{ $nilai->uas }}</td>
            </tr>

        </table>

        <div class="summary">

            <div class="summary-card">
                <h5>Nilai Akhir</h5>
                <h2>{{ $nilai->nilai_akhir }}</h2>
            </div>

            <div class="summary-card">
                <h5>Nilai Huruf</h5>
                <span class="grade">
                    {{ $nilai->nilai_huruf }}
                </span>
            </div>

            <div class="summary-card">
                <h5>Index Nilai</h5>
                <h2>{{ $nilai->index_nilai }}</h2>
            </div>

        </div>

        <a href="/kps/laporan" class="btn-back">
            ← Kembali ke Laporan
        </a>

    </div>

</div>

@endsection