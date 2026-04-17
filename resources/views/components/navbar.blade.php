<div class="navbar">
    <div class="logo">
    <img src="{{ asset('img/logo.png') }}" alt="Logo">

</div>

    <div class="menu">
        <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
    Beranda
</a>
        <a href="{{ url('/krs') }}" class="{{ request()->is('/') ? 'active' : '' }}">
    KRS</a>
        <a href="{{ route('khs') }}" class="{{ request()->is('/') ? 'active' : '' }}">
        KHS</a>
        <a href="#">Panduan</a>
    </div>

 <a href="{{ route('profil') }}" class="user-link">
    <div class="user">
        <i class="fas fa-user-circle"></i>
        Nama Mahasiswa
    </div>
</a>
</div>