<!DOCTYPE html>
<html>
<head>
    <title>Approve Nilai - KPS</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f5f7fb;
}

/* SIDEBAR */

.sidebar{
    width:270px;
    height:100vh;
    background:white;
    position:fixed;
    left:0;
    top:0;
    border-right:1px solid #e5e7eb;
}

.logo{
    text-align:center;
    padding:20px;
}

.logo img{
    width:100px;
}

.logo h2{
    margin-top:8px;
    color:#374151;
    font-size:18px;
}

.menu{
    padding:0 15px;
}

.menu-title{
    font-size:13px;
    font-weight:700;
    color:#6b7280;
    margin:12px 0;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
    color:#374151;
    padding:10px 12px;
    border-radius:8px;
    margin-bottom:6px;
    transition:.3s;
    font-size:14px;
}

.sidebar a:hover{
    background:#eef6ff;
}

.sidebar a.active{
    background:#27a4ff;
    color:white;
}

/* CONTENT */

.content{
    margin-left:270px;
}

.topbar{
    height:60px;
    background:white;
    border-bottom:1px solid #e5e7eb;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 25px;
}

.topbar h2{
    color:#374151;
    font-size:20px;
}

.profile{
    font-weight:600;
    color:#374151;
    font-size:14px;
}

.main{
    padding:20px;
}

.page-title{
    margin-bottom:15px;
    color:#1f2937;
    font-size:38px;
}

/* FILTER */

.filter-box{
    background:white;
    padding:15px;
    border-radius:12px;
    margin-bottom:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.filter-row{
    display:flex;
    gap:15px;
    align-items:end;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
}

.filter-group label{
    margin-bottom:6px;
    font-weight:600;
    color:#374151;
    font-size:13px;
}

.filter-group select{
    width:250px;
    padding:10px;
    border:1px solid #ddd;
    border-radius:8px;
    font-size:14px;
}

.btn-filter{
    background:#0d6efd;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
}

.btn-reset{
    background:white;
    border:1px solid #ddd;
    padding:10px 18px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
}

/* STAT */

.stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
    margin-bottom:15px;
}

.stat-card{
    background:white;
    border-radius:12px;
    padding:18px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
    display:flex;
    align-items:center;
    gap:15px;
}

.stat-icon{
    width:50px;
    height:50px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.blue{
    background:#e8f1ff;
    color:#0d6efd;
}

.yellow{
    background:#fff7db;
    color:#d97706;
}

.green{
    background:#dcfce7;
    color:#16a34a;
}

.stat-text p{
    color:#6b7280;
    font-size:13px;
}

.stat-text h2{
    margin-top:3px;
    font-size:26px;
}

/* TABLE */

.table-box{
    background:white;
    border-radius:12px;
    padding:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#eef6ff;
    padding:12px;
    text-align:left;
    font-size:14px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:14px;
}

.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:11px;
    font-weight:bold;
}

.waiting{
    background:#fef3c7;
    color:#92400e;
}

.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:5px;
    text-decoration:none;
    border:none;
    padding:8px 14px;
    border-radius:7px;
    color:white;
    cursor:pointer;
    font-weight:600;
    font-size:12px;
}

.btn-success{
    background:#22c55e;
}

.btn-danger{
    background:#ef4444;
}

.btn-success:hover{
    background:#16a34a;
}

.btn-danger:hover{
    background:#dc2626;
}

</style>
</head>
<body>

<div class="sidebar">

    <div class="logo">
        <img src="{{ asset('img/logo.png') }}">
        <h2>KPS</h2>
    </div>

    <div class="menu">

        <div class="menu-title">Menu Utama</div>

        <a href="/kps">
            <i class="fa fa-home"></i>
            Dashboard
        </a>

        <div class="menu-title">Pengelolaan Nilai</div>

        <a href="/kps/approve" class="active">
            <i class="fa fa-check-circle"></i>
            Approve Nilai
        </a>

        <a href="/kps/kunci">
            <i class="fa fa-lock"></i>
            Kunci Nilai
        </a>

        <div class="menu-title">Laporan</div>

        <a href="/kps/laporan">
            <i class="fa fa-file"></i>
            Laporan Nilai
        </a>

    </div>

</div>

<div class="content">

    <div class="topbar">

        <h2>Sistem Pengelolaan KRS & KHS</h2>

        <div class="profile">
            <i class="fa fa-user-circle"></i>
            KPS Informatika
        </div>

    </div>

    <div class="main">

        <h1 class="page-title">
            Approve Nilai
        </h1>

        <div class="filter-box">

            <div class="filter-row">

                <div class="filter-group">
    <label>Semester</label>

    <select>
        <option>2025/2026 Ganjil</option>
        <option selected>2025/2026 Genap</option>
    </select>

</div>

<div class="filter-group">
    <label>Program Studi</label>

    <select>

        <option selected>
            Semua Program Studi
        </option>

        <option>
            D3 Teknik Informatika
        </option>

        <option>
            D3 Teknik Geomatika
        </option>

        <option>
            D4 Animasi
        </option>

        <option>
            D4 Teknologi Rekayasa Multimedia
        </option>

        <option>
            D4 Keamanan Siber
        </option>

        <option>
            D4 Rekayasa Perangkat Lunak
        </option>

        <option>
            D4 Teknologi Permainan
        </option>

        <option>
            Magister Terapan Teknik Komputer
        </option>

    </select>

</div>

                <button class="btn-filter">
                    <i class="fa fa-filter"></i>
                    Filter
                </button>

                <button class="btn-reset">
                    <i class="fa fa-rotate-right"></i>
                    Reset
                </button>

            </div>

        </div>

        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fa fa-clock"></i>
                </div>

                <div class="stat-text">
                    <p>Menunggu Approval</p>
                    <h2>42</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon yellow">
                    <i class="fa fa-users"></i>
                </div>

                <div class="stat-text">
                    <p>Total Mahasiswa</p>
                    <h2>1.248</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fa fa-book"></i>
                </div>

                <div class="stat-text">
                    <p>Total Nilai</p>
                    <h2>42</h2>
                </div>
            </div>

        </div>

        <div class="table-box">

            <table>

                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

@foreach($nilais as $nilai)

<tr>

    <td>{{ $nilai->kode_mk }}</td>

    <td>Dosen Informatika</td>

    <td>
        {{ date('d M Y', strtotime($nilai->created_at)) }}
    </td>

    <td>

        @if($nilai->status == 'Menunggu Approval')

            <span class="badge waiting">
                Menunggu
            </span>

        @elseif($nilai->status == 'Disetujui')

            <span class="badge"
            style="background:#dcfce7;color:#166534;">
                Disetujui
            </span>

        @else

            <span class="badge"
            style="background:#fee2e2;color:#991b1b;">
                Ditolak
            </span>

        @endif

    </td>

    <td>

        <a href="/kps/approve/setujui/{{ $nilai->nim }}"
           class="btn btn-success">

            <i class="fa fa-check"></i>
            Approve

        </a>

        <a href="/kps/approve/tolak/{{ $nilai->nim }}"
           class="btn btn-danger">

            <i class="fa fa-times"></i>
            Tolak

        </a>

    </td>

</tr>

@endforeach

</tbody>
</html>