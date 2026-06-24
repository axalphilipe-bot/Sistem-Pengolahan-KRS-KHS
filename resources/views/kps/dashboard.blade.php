@extends('kps.layout')

@section('content')

<style>

.dashboard-header{
    background:linear-gradient(135deg,#0d6efd,#27a4ff);
    color:white;
    padding:14px 20px;
    border-radius:12px;
    margin-bottom:15px;
}

.dashboard-header h1{
    font-size:22px;
    margin-bottom:4px;
}

.dashboard-header p{
    font-size:13px;
    opacity:.95;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    margin-bottom:15px;
}

.stat-card{
    background:#fff;
    border-radius:12px;
    padding:15px;
    box-shadow:0 2px 8px rgba(0,0,0,.05);
}

.stat-icon{
    width:42px;
    height:42px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    margin-bottom:10px;
}

.blue-bg{
    background:#eaf2ff;
    color:#2563eb;
}

.green-bg{
    background:#dcfce7;
    color:#16a34a;
}

.red-bg{
    background:#fee2e2;
    color:#dc2626;
}

.stat-label{
    color:#6b7280;
    font-size:13px;
    margin-bottom:5px;
}

.stat-value{
    font-size:24px;
    font-weight:700;
}

.blue{
    color:#2563eb;
}

.green{
    color:#16a34a;
}

.red{
    color:#dc2626;
}

.activity-box{
    background:#fff;
    border-radius:12px;
    padding:15px;
    box-shadow:0 2px 8px rgba(0,0,0,.05);
}

.activity-box h2{
    margin-bottom:12px;
    color:#1f2937;
    font-size:20px;
}

.activity-table{
    width:100%;
    border-collapse:collapse;
}

.activity-table th{
    background:#f3f4f6;
    padding:10px;
    text-align:left;
    font-size:13px;
}

.activity-table td{
    padding:10px;
    border-bottom:1px solid #eee;
    font-size:13px;
}

.badge-success{
    background:#dcfce7;
    color:#166534;
    padding:4px 8px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
}

</style>

<div class="dashboard-header">
    <h1>Dashboard KPS</h1>
    <p>
        Kelola proses approval nilai,
        penguncian nilai,
        dan monitoring aktivitas akademik.
    </p>
</div>

<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon blue-bg">
            <i class="fa fa-clock"></i>
        </div>

        <div class="stat-label">
            Menunggu Approval
        </div>

        <div class="stat-value blue">
            {{ $menunggu }}
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon green-bg">
            <i class="fa fa-check-circle"></i>
        </div>

        <div class="stat-label">
            Sudah Disetujui
        </div>

        <div class="stat-value green">
            {{ $disetujui }}
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon red-bg">
            <i class="fa fa-lock"></i>
        </div>

        <div class="stat-label">
            Nilai Terkunci
        </div>

        <div class="stat-value red">
            {{ $terkunci }}
        </div>

    </div>

</div>

<div class="activity-box">

    <h2>Aktivitas Terbaru</h2>

    <table class="activity-table">

        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Aktivitas</th>
                <th>Mata Kuliah</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

        @forelse($aktivitas as $item)

        <tr>

            <td>
                {{ date('d M Y', strtotime($item->updated_at)) }}
            </td>

            <td>
                {{ $item->status }}
            </td>

            <td>
                {{ $item->nama_mk ?? '-' }}
            </td>

            <td>
                <span class="badge-success">
                    Berhasil
                </span>
            </td>

        </tr>

        @empty

        <tr>
            <td colspan="4" style="text-align:center;">
                Belum ada aktivitas
            </td>
        </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection