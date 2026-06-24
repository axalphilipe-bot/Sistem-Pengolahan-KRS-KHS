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
        background:white;
        position:fixed;
        left:0;
        top:0;
        border-right:1px solid #e5e7eb;
        overflow-y:auto;
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
        padding:0 20px 20px;
    }

    .menu-title{
        font-size:14px;
        font-weight:700;
        color:#6b7280;
        margin:18px 0 12px;
    }

    .menu a{
        display:flex;
        align-items:center;
        gap:12px;
        text-decoration:none;
        color:#374151;
        padding:14px 15px;
        border-radius:12px;
        margin-bottom:8px;
        transition:.3s;
        font-size:16px;
    }

    .menu a:hover{
        background:#eef6ff;
    }

    .menu a.active{
        background:#1da1ff;
        color:white;
    }

    .content{
        margin-left:270px;
        min-height:100vh;
    }

    .topbar{
        height:75px;
        background:white;
        border-bottom:1px solid #e5e7eb;
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:0 30px;
    }

    .topbar h2{
        color:#1f2937;
    }

    .profile{
        font-weight:600;
        color:#374151;
    }

    .main{
        padding:30px;
    }

    .card{
        background:white;
        border-radius:15px;
        padding:25px;
        box-shadow:0 2px 10px rgba(0,0,0,.05);
    }

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
        background:#f3f4f6;
        padding:15px;
        text-align:left;
    }

    td{
        padding:15px;
        border-bottom:1px solid #eee;
    }

    .btn{
        padding:10px 16px;
        border:none;
        border-radius:8px;
        color:white;
        text-decoration:none;
        cursor:pointer;
        display:inline-block;
    }

    .btn-success{
        background:#22c55e;
    }

    .btn-danger{
        background:#ef4444;
    }

    .btn-primary{
        background:#2563eb;
    }

    .badge{
        padding:6px 12px;
        border-radius:20px;
        font-size:12px;
        font-weight:bold;
    }

    .badge-success{
        background:#dcfce7;
        color:#166534;
    }

    .badge-danger{
        background:#fee2e2;
        color:#991b1b;
    }

    .badge-warning{
        background:#fef3c7;
        color:#92400e;
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

        <a href="/kps"
        class="{{ request()->is('kps') ? 'active' : '' }}">
            <i class="fa fa-home"></i>
            Dashboard
        </a>

        <div class="menu-title">
            Pengelolaan Nilai
        </div>

        <a href="/kps/approve"
        class="{{ request()->is('kps/approve*') ? 'active' : '' }}">
            <i class="fa fa-check-circle"></i>
            Approve Nilai
        </a>

        <a href="/kps/kunci"
        class="{{ request()->is('kps/kunci*') ? 'active' : '' }}">
            <i class="fa fa-lock"></i>
            Kunci Nilai
        </a>

        <div class="menu-title">
            Laporan
        </div>

        <a href="/kps/laporan"
        class="{{ request()->is('kps/laporan*') ? 'active' : '' }}">
            <i class="fa fa-file"></i>
            Laporan Nilai
        </a>

    </div>

</div>

<div class="content">

    <div class="topbar">

        <h2>
            Sistem Pengelolaan KRS & KHS
        </h2>

        <div class="profile">
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