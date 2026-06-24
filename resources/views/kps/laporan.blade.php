<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai - KPS</title>

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
    width:250px;
    height:100vh;
    background:white;
    position:fixed;
    left:0;
    top:0;
    border-right:1px solid #e5e7eb;
}

.logo{
    text-align:center;
    padding:18px;
}

.logo img{
    width:95px;
}

.logo h2{
    margin-top:8px;
    font-size:18px;
    color:#374151;
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
    font-size:14px;
    transition:.3s;
}

.sidebar a:hover{
    background:#eef6ff;
}

.sidebar a.active{
    background:#27a4ff;
    color:white;
}

/* LOGOUT */

.logout{
    position:absolute;
    bottom:15px;
    left:0;
    width:100%;
    padding:0 15px;
}

.logout button{
    width:100%;
    border:none;
    background:#ef4444;
    color:white;
    padding:10px;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
    font-weight:600;
}

/* CONTENT */

.content{
    margin-left:250px;
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
    font-size:18px;
    color:#374151;
}

.profile{
    font-size:14px;
    font-weight:600;
    color:#374151;
}

.main{
    padding:20px;
}

.page-title{
    font-size:26px;
    margin-bottom:15px;
    color:#1f2937;
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
    gap:12px;
    align-items:end;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
}

.filter-group label{
    margin-bottom:5px;
    font-size:13px;
    font-weight:600;
}

.filter-group select{
    width:250px;
    padding:10px;
    border:1px solid #ddd;
    border-radius:8px;
    font-size:13px;
}

/* BUTTON */

.btn-filter,
.btn-pdf,
.btn-excel{
    border:none;
    padding:10px 16px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
    font-weight:600;
}

.btn-filter{
    background:#0d6efd;
    color:white;
}

.btn-pdf{
    background:#ef4444;
    color:white;
}

.btn-excel{
    background:#16a34a;
    color:white;
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
    width:48px;
    height:48px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.blue{
    background:#e8f1ff;
    color:#0d6efd;
}

.green{
    background:#dcfce7;
    color:#16a34a;
}

.red{
    background:#fee2e2;
    color:#dc2626;
}

.stat-text p{
    font-size:13px;
    color:#6b7280;
}

.stat-text h2{
    font-size:24px;
    margin-top:3px;
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
    font-size:13px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:13px;
}

.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
}

.approved{
    background:#dcfce7;
    color:#166534;
}

.locked{
    background:#fee2e2;
    color:#991b1b;
}

.btn-detail{
    background:#0d6efd;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    text-decoration:none;
    font-size:12px;
    font-weight:600;
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

        <a href="/kps/approve">
            <i class="fa fa-check-circle"></i>
            Approve Nilai
        </a>

        <a href="/kps/kunci">
            <i class="fa fa-lock"></i>
            Kunci Nilai
        </a>

        <div class="menu-title">Laporan</div>

        <a href="/kps/laporan" class="active">
            <i class="fa fa-file"></i>
            Laporan Nilai
        </a>

    </div>

    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <i class="fa fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
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
            Laporan Nilai
        </h1>

        <div class="filter-box">
<form method="GET" action="/kps/laporan">
            <div class="filter-row">

                <div class="filter-group">
                    <label>Semester</label>



<select name="semester">
    <option value="Semua Semester">
    Semua Semester
</option>
    <option value="Ganjil">Ganjil</option>
    <option value="Genap">Genap</option>
</select>
                </div>

                <div class="filter-group">
                    <label>Program Studi</label>
                    <select name="prodi">
                        <option>Semua Program Studi</option>
                        <option>D3 Teknik Informatika</option>
                        <option>D3 Teknik Geomatika</option>
                        <option>D4 Animasi</option>
                        <option>D4 Teknologi Rekayasa Multimedia</option>
                        <option>D4 Keamanan Siber</option>
                        <option>D4 Rekayasa Perangkat Lunak</option>
                        <option>D4 Teknologi Permainan</option>
                        <option>Magister Terapan Teknik Komputer</option>
                    </select>
                </div>

                <button class="btn-filter" type="submit">
    <i class="fa fa-filter"></i>
    Filter
</button>

                <a href="/kps/laporan/pdf" class="btn-pdf" style="text-decoration:none;display:inline-block;">
    <i class="fa fa-file-pdf"></i>
    PDF
</a>

                <a href="/kps/laporan/excel"
   class="btn-excel"
   style="text-decoration:none;display:inline-block;">
    Excel
</a>

</form>

            </div>

        </div>

        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fa fa-book"></i>
                </div>

                <div class="stat-text">
                    <p>Total Mata Kuliah</p>
                    <h2>{{ $total }}</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fa fa-check-circle"></i>
                </div>

                <div class="stat-text">
                    <p>Nilai Disetujui</p>
                    <h2>{{ $disetujui }}</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fa fa-lock"></i>
                </div>

                <div class="stat-text">
                    <p>Nilai Terkunci</p>
                    <h2>{{ $terkunci }}</h2>
                </div>
            </div>

        </div>

        <div class="table-box">

            <table>

                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

@foreach($data as $item)

<tr>

    <td>{{ $item->nama_mk }}</td>

    <td>{{ $item->nama_dosen }}</td>

    <td>{{ $item->nama_prodi }}</td>

    <td>Genap</td>

    <td>
        @if($item->kunci_nilai == 'Terkunci')
            <span class="badge locked">
                Terkunci
            </span>
        @else
            <span class="badge approved">
                Disetujui
            </span>
        @endif
    </td>

    <td>
    <a href="/kps/laporan/detail/{{ $item->nim }}/{{ $item->kode_mk }}"
       class="btn-detail"
       style="text-decoration:none;">

        <i class="fa fa-eye"></i>
        Detail

    </a>
</td>

</tr>

@endforeach

</tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>