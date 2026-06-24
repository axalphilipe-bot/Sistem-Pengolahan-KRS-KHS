<!DOCTYPE html>
<html>
<head>
    <title>Kunci Nilai - KPS</title>

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
    color:#1f2937;
    margin-bottom:15px;
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

.filter-group label{
    display:block;
    margin-bottom:5px;
    font-size:13px;
    font-weight:600;
}

.filter-group select{
    width:240px;
    padding:10px;
    border:1px solid #ddd;
    border-radius:8px;
    font-size:13px;
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

.orange{
    background:#fff7db;
    color:#d97706;
}

.red{
    background:#fee2e2;
    color:#dc2626;
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

.unlocked{
    background:#fef3c7;
    color:#92400e;
}

.locked{
    background:#dcfce7;
    color:#166534;
}

.btn{
    border:none;
    padding:8px 12px;
    border-radius:8px;
    color:white;
    cursor:pointer;
    font-weight:600;
    display:inline-flex;
    align-items:center;
    gap:5px;
    text-decoration:none;
    font-size:12px;
}

.btn-lock{
    background:#ef4444;
    min-width:105px;
}

.btn-unlock{
    background:#22c55e;
    min-width:105px;
}

.btn-lock:hover{
    background:#dc2626;
}

.btn-unlock:hover{
    background:#16a34a;
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

.logout button:hover{
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

        <div class="menu-title">
            Menu Utama
        </div>

        <a href="/kps">
            <i class="fa fa-home"></i>
            Dashboard
        </a>

        <div class="menu-title">
            Pengelolaan Nilai
        </div>

        <a href="/kps/approve">
            <i class="fa fa-check-circle"></i>
            Approve Nilai
        </a>

        <a href="/kps/kunci" class="active">
            <i class="fa fa-lock"></i>
            Kunci Nilai
        </a>

        <div class="menu-title">
            Laporan
        </div>

        <a href="/kps/laporan">
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

    <div class="main"></div>

        <h1 class="page-title">
            Kunci Nilai
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

                <button class="btn-filter">
                    <i class="fa fa-filter"></i>
                    Filter
                </button>

            </div>

        </div>

        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fa fa-unlock"></i>
                </div>

                <div class="stat-text">
                    <p>Belum Dikunci</p>
                    <h2>{{ $belumTerkunci }}</h2>
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

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fa fa-book"></i>
                </div>

                <div class="stat-text">
                    <p>Total Mata Kuliah</p>
                    <h2>{{ $total }}</h2>
                </div>
            </div>

        </div>

        <div class="table-box">

            <table>

                <thead>
                    <tr>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Tanggal Kunci</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

<tbody>

@foreach($nilais as $nilai)

<tr>
<td>{{ $nilai->kode_mk }}</td>
<td>{{ $nilai->nama_mk }}</td>
<td>{{ $nilai->nama_dosen }}</td>

<td>Genap</td>

<td>
    @if($nilai->kunci_nilai == 'Terkunci')
        <span class="badge locked">
            Terkunci
        </span>
    @else
        <span class="badge unlocked">
            Belum Terkunci
        </span>
    @endif
</td>

<td>
    {{ $nilai->tanggal_kunci ?? '-' }}
</td>


    <td>

        @if($nilai->kunci_nilai == 'Terkunci')

            <a href="/kps/kunci/unlock/{{ $nilai->nim }}"
               class="btn btn-unlock"
               onclick="return confirm('Buka kunci nilai ini?')">

                <i class="fa fa-unlock"></i>
                Buka Kunci

            </a>

        @else

            <a href="/kps/kunci/lock/{{ $nilai->nim }}"
               class="btn btn-lock"
               onclick="return confirm('Yakin ingin mengunci nilai ini?')">

                <i class="fa fa-lock"></i>
                Kunci

            </a>

        @endif

    </td>

</tr>

@endforeach

</tbody>
</table>
</div>


        </div>

    </div>

</div>

</body>
</html>