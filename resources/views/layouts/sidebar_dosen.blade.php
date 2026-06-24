<div class="sidebar-dosen">

    <!-- LOGO -->
    <div class="sidebar-logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
    </div>

    <!-- MENU -->
    <div class="sidebar-menu">

        <div class="menu-title">
    Menu Utama
</div>

        <a href="/dosen" 
           class="menu-item {{ request()->is('dosen') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <a href="/dosen/kelas" 
           class="menu-item {{ request()->is('dosen/kelas') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Data Kelas</span>
        </a>

        <a href="/dosen/validasi" 
           class="menu-item {{ request()->is('dosen/validasi') ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i>
            <span>Validasi KRS</span>
        </a>

        <a href="/dosen/panduan" 
           class="menu-item {{ request()->is('dosen/panduan') ? 'active' : '' }}">
            <i class="fas fa-book"></i>
            <span>Panduan</span>
        </a>

        <hr>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
<div class="menu-title">
    Akun
</div>
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>

    </div>

</div>  