<!DOCTYPE html>
<html>
<head>
    <title>KPS - Sistem KRS KHS</title>

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

    .sidebar{
        width:270px;
        height:100vh;
        background:#fff;
        position:fixed;
        left:0;
        top:0;
        border-right:1px solid #e5e7eb;
        display:flex;
        flex-direction:column;
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
        flex:1;
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

    .logout{
        padding:20px;
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

    .welcome-box{
        background:linear-gradient(135deg,#0d6efd,#27a4ff);
        color:white;
        padding:25px;
        border-radius:15px;
        margin-bottom:25px;
    }

    .welcome-box h1{
        margin-bottom:10px;
    }

    .cards{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:20px;
        margin-bottom:30px;
    }

    .card{
        background:white;
        padding:25px;
        border-radius:15px;
        box-shadow:0 2px 10px rgba(0,0,0,.05);
        transition:.3s;
    }

    .card:hover{
        transform:translateY(-5px);
    }

    .card i{
        font-size:28px;
        margin-bottom:15px;
    }

    .card p{
        color:#6b7280;
        margin-bottom:10px;
        font-size:18px;
    }

    .card h2{
        font-size:42px;
    }

    .blue{
        color:#0d6efd;
    }

    .green{
        color:#22c55e;
    }

    .red{
        color:#ef4444;
    }

    .table-box{
        background:white;
        border-radius:15px;
        padding:25px;
        box-shadow:0 2px 10px rgba(0,0,0,.05);
    }

    .table-box h2{
        margin-bottom:20px;
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
        background:#dcfce7;
        color:#166534;
        padding:6px 12px;
        border-radius:20px;
        font-size:12px;
        font-weight:bold;
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

        <a href="/kps" class="active">
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

        <a href="/kps/kunci">
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

    <div class="main">

        <div class="welcome-box">
            <h1>Dashboard KPS</h1>
            <p>
                Kelola proses approval nilai, penguncian nilai,
                dan monitoring aktivitas akademik.
            </p>
        </div>

        <div class="cards">

            <div class="card">
                <i class="fa fa-clock blue"></i>
                <p>Menunggu Approve</p>
                <h2 class="blue">15</h2>
            </div>

            <div class="card">
                <i class="fa fa-check-circle green"></i>
                <p>Sudah Approve</p>
                <h2 class="green">50</h2>
            </div>

            <div class="card">
                <i class="fa fa-lock red"></i>
                <p>Nilai Terkunci</p>
                <h2 class="red">30</h2>
            </div>

        </div>

        <div class="table-box">

            <h2>Aktivitas Terbaru</h2>

            <table>

                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Aktivitas</th>
                        <th>Detail</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>14 Juni 2026</td>
                        <td>Approve Nilai</td>
                        <td>Basis Data</td>
                        <td>
                            <span class="badge">Berhasil</span>
                        </td>
                    </tr>

                    <tr>
                        <td>14 Juni 2026</td>
                        <td>Kunci Nilai</td>
                        <td>Pemrograman Web</td>
                        <td>
                            <span class="badge">Berhasil</span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>