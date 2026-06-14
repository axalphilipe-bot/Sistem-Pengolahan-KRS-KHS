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
        background:#f4f7fb;
    }

    .sidebar{
        width:260px;
        height:100vh;
        background:linear-gradient(180deg,#0d6efd,#0a58ca);
        position:fixed;
        left:0;
        top:0;
        color:white;
        padding:20px;
    }

    .logo{
        text-align:center;
        margin-bottom:20px;
    }

    .logo img{
        width:90px;
    }

    .logo h3{
        margin-top:10px;
    }

    .menu a{
        display:block;
        color:white;
        text-decoration:none;
        padding:14px;
        border-radius:10px;
        margin-bottom:10px;
        transition:.3s;
    }

    .menu a:hover{
        background:rgba(255,255,255,.15);
    }

    .content{
        margin-left:260px;
    }

    .topbar{
        height:70px;
        background:white;
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:0 30px;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
    }

    .user{
        font-weight:600;
        color:#555;
    }

    .main{
        padding:30px;
    }

    .cards{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:20px;
        margin-top:20px;
    }

    .card{
        background:white;
        padding:25px;
        border-radius:15px;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
    }

    .card i{
        font-size:35px;
        color:#0d6efd;
        margin-bottom:10px;
    }

    .card h2{
        color:#0d6efd;
        margin-top:10px;
    }

    .table-box{
        background:white;
        margin-top:30px;
        padding:20px;
        border-radius:15px;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th{
        background:#eef4ff;
    }

    th,td{
        padding:12px;
        text-align:left;
        border-bottom:1px solid #eee;
    }

    </style>

</head>
<body>

<div class="sidebar">

    <div class="logo">
        <img src="{{ asset('img/logo.png') }}">
        <h3>KPS</h3>
    </div>

    <div class="menu">

        <a href="/kps">
            <i class="fa fa-home"></i>
            Dashboard
        </a>

        <a href="/kps/approve">
            <i class="fa fa-check-circle"></i>
            Approve Nilai
        </a>

        <a href="/kps/kunci">
            <i class="fa fa-lock"></i>
            Kunci Nilai
        </a>

        <a href="/kps/laporan">
            <i class="fa fa-file"></i>
            Laporan
        </a>

    </div>

</div>

<div class="content">

    <div class="topbar">

        <h2>Sistem Pengelolaan KRS & KHS</h2>

        <div class="user">
            <i class="fa fa-user-circle"></i>
            KPS Informatika
        </div>

    </div>

    <div class="main">

        @yield('content')

    </div>

</div>

</body>
</html>