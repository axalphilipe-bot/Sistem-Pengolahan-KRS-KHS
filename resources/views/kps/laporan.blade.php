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
    padding:25px;
}

.logo img{
    width:120px;
}

.logo h2{
    margin-top:10px;
    color:#374151;
}

.menu{
    padding:0 20px;
}

.menu-title{
    font-size:14px;
    font-weight:700;
    color:#6b7280;
    margin:15px 0;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:12px;
    text-decoration:none;
    color:#374151;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:8px;
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
    bottom:20px;
    left:0;
    width:100%;
    padding:0 20px;
}

.logout button{
    width:100%;
    border:none;
    background:#ef4444;
    color:white;
    padding:12px;
    border-radius:10px;
    cursor:pointer;
    font-size:15px;
    font-weight:600;
}

.logout button:hover{
    background:#dc2626;
}

/* CONTENT */

.content{
    margin-left:270px;
}

.topbar{
    height:70px;
    background:white;
    border-bottom:1px solid #e5e7eb;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
}

.topbar h2{
    color:#374151;
}

.profile{
    font-weight:600;
    color:#374151;
}

.main{
    padding:30px;
}

.page-title{
    margin-bottom:20px;
    color:#1f2937;
}

/* FILTER */

.filter-box{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.filter-row{
    display:flex;
    gap:20px;
    align-items:end;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
}

.filter-group label{
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

.filter-group select{
    width:280px;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;
}

/* BUTTON */

.btn-filter{
    background:#0d6efd;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
}

.btn-pdf{
    background:#ef4444;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
}

.btn-excel{
    background:#16a34a;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:10px;
    cursor:pointer;
}

/* STAT */

.stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-bottom:25px;
}

.stat-card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
    display:flex;
    align-items:center;
    gap:20px;
}

.stat-icon{
    width:60px;
    height:60px;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
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
    color:#6b7280;
}

.stat-text h2{
    font-size:32px;
}

/* TABLE */

.table-box{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#eef6ff;
    padding:15px;
    text-align:left;
}

td{
    padding:15px;
    border-bottom:1px solid #eee;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
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
    padding:10px 18px;
    border-radius:8px;
    cursor:pointer;
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

                <button class="btn-pdf">
                    <i class="fa fa-file-pdf"></i>
                    PDF
                </button>

                <button class="btn-excel">
                    <i class="fa fa-file-excel"></i>
                    Excel
                </button>

            </div>

        </div>

        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fa fa-book"></i>
                </div>

                <div class="stat-text">
                    <p>Total Mata Kuliah</p>
                    <h2>50</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fa fa-check-circle"></i>
                </div>

                <div class="stat-text">
                    <p>Nilai Disetujui</p>
                    <h2>42</h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fa fa-lock"></i>
                </div>

                <div class="stat-text">
                    <p>Nilai Terkunci</p>
                    <h2>30</h2>
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

                    <tr>
                        <td>Basis Data</td>
                        <td>Dr. Ahmad Fauzi, M.Kom</td>
                        <td>D3 Teknik Informatika</td>
                        <td>Genap</td>

                        <td>
                            <span class="badge locked">
                                Terkunci
                            </span>
                        </td>

                        <td>
                            <button class="btn-detail">
                                <i class="fa fa-eye"></i>
                                Detail
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Pemrograman Web</td>
                        <td>Dra. Siti Nurhayati, M.Kom</td>
                        <td>D3 Teknik Informatika</td>
                        <td>Genap</td>

                        <td>
                            <span class="badge approved">
                                Disetujui
                            </span>
                        </td>

                        <td>
                            <button class="btn-detail">
                                <i class="fa fa-eye"></i>
                                Detail
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>