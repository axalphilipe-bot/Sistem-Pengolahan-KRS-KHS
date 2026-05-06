<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <div class="topbar">

    <div class="topbar-left">
    </div>

    <div class="topbar-right">
        <i class="fa-regular fa-id-badge"></i>
        <span>Nama Dosen</span>
    </div>

</div>
</head>
<body>

<div class="admin-container">

    <!-- SIDEBAR -->
   <div class="sidebar">

    <img src="{{ asset('img/logo.png') }}" class="sidebar-logo">

    <h3>Menu Utama</h3>

   <a href="/admin"
class="{{ request()->is('admin') ? 'active' : '' }}">
    <i class="fa fa-home"></i>
    Dashboard
</a>

<a href="/admin/mahasiswa"
class="{{ request()->is('admin/mahasiswa') ? 'active' : '' }}">
    <i class="fa fa-users"></i>
    Data Mahasiswa
</a>

<a href="/admin/dosen"
class="{{ request()->is('admin/dosen') ? 'active' : '' }}">
    <i class="fa fa-user"></i>
    Data Dosen
</a>

<a href="/admin/matkul"
class="{{ request()->is('admin/matkul') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Mata Kuliah
</a>

    <div class="sidebar-title">
        Pengelolaan KRS
    </div>

    <a href="/admin/krs"
class="{{ request()->is('admin/krs') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Pengajuan KRS
</a>

    <a href="/admin/krs-approve"
class="{{ request()->is('admin/krs-approve') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Persetujuan KRS
</a>    

    <div class="sidebar-title">
        Pengelolaan KHS
    </div>

       <a href="/admin/nilai"
class="{{ request()->is('admin/nilai') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Input Nilai
</a>   

    <a href="/admin/validasi"
class="{{ request()->is('admin/validasi') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Validasi Nilai
</a>  

    <div class="sidebar-title">
        Laporan
    </div>

       <a href="/admin/laporan-krs"
class="{{ request()->is('admin/laporan-krs') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Laporan KRS
</a> 

    <a href="/admin/laporan-khs"
class="{{ request()->is('admin/laporan-khs') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Laporan KHS
</a> 

    <div class="sidebar-title">
        Sistem
    </div>

   <a href="/admin/pengaturan"
class="{{ request()->is('admin/pengaturan') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Pengaturan
</a> 

    <a href="/admin/pengguna"
class="{{ request()->is('admin/pengguna') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Pengguna & Hak Akses
</a> 

    <a href="/admin/log"
class="{{ request()->is('admin/log') ? 'active' : '' }}">
    <i class="fa fa-book"></i>
    Log Aktivitas
</a> 

    <div class="sidebar-footer">
        <button>
            <i class="fa fa-sign-out"></i>
        </button>
    </div>

</div>

    <!-- CONTENT -->
    <div class="main-content">


        @yield('content')

    </div>

</div>

</body>
</html>