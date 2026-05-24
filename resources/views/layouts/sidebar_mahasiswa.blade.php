<div class="sidebar">

    <!-- LOGO -->
    <div class="logo-section">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
    </div>

    <!-- MENU -->
    <div class="menu-section">

        <!-- MENU UTAMA -->
        <h4 class="menu-title">Menu Utama</h4>

        <a href="/home"
           class="{{ request()->is('home') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            Dashboard
        </a>

        <a href="/krs"
           class="{{ request()->is('krs') ? 'active' : '' }}">
            <i class="fas fa-book"></i>
            KRS
        </a>

        <a href="/khs"
           class="{{ request()->is('khs') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i>
            KHS
        </a>

        <!-- GARIS -->
        <div class="menu-divider"></div>

        <!-- AKUN -->
        <h4 class="menu-title">Akun</h4>

        <a href="/profil"
           class="{{ request()->is('profil') ? 'active' : '' }}">
            <i class="fas fa-user"></i>
            Profil
        </a>

        <a href="/panduan"
           class="{{ request()->is('panduan') ? 'active' : '' }}">
            <i class="fas fa-circle-info"></i>
            Panduan
        </a>
  <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
    </div>

</div>