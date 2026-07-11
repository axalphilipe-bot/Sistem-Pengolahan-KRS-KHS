<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Login | Sistem KRS & KHS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-page">
    <div class="login-wrapper">

        <div class="login-hero">
            <span class="login-badge">
                <i class="fa-solid fa-graduation-cap"></i>
                Sistem Akademik
            </span>
            <img src="{{ asset('img/logo.png') }}" alt="Polibatam" class="login-logo">
            <h1>Sistem Pengelolaan<br>KRS & KHS</h1>
            <p>Politeknik Negeri Batam</p>
        </div>

        <div class="login-body">
            <h2>Masuk ke Akun</h2>
            <p class="subtitle">Pilih role dan masukkan kredensial Anda</p>

            @if(session('error'))
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="role-tabs">
                    <label class="role-tab">
                        <input type="radio" name="role" id="role" value="mahasiswa" checked>
                        <span><i class="fa-solid fa-user-graduate"></i> Mahasiswa</span>
                    </label>
                    <label class="role-tab">
                        <input type="radio" name="role" value="dosen">
                        <span><i class="fa-solid fa-chalkboard-user"></i> Dosen</span>
                    </label>
                    <label class="role-tab">
                        <input type="radio" name="role" value="admin">
                        <span><i class="fa-solid fa-shield-halved"></i> Admin</span>
                    </label>
                    <label class="role-tab">
                        <input type="radio" name="role" value="kps">
                        <span><i class="fa-solid fa-user-tie"></i> KPS</span>
                    </label>
                </div>

                <label class="form-label" for="loginInput">Kredensial</label>
                <div class="input-group">
                    <i class="fa-solid fa-id-card input-icon"></i>
                    <input
                        type="text"
                        id="loginInput"
                        name="login"
                        placeholder="Masukkan NIM"
                        required
                        autocomplete="username">
                </div>

                <label class="form-label" for="passwordInput">Password</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input
                        type="password"
                        id="passwordInput"
                        name="password"
                        placeholder="Password"
                        required
                        autocomplete="current-password">
                    <button type="button" class="toggle-password" aria-label="Tampilkan password">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Masuk
                </button>
            </form>

            <p class="login-footer">
                &copy; {{ date('Y') }} Politeknik Negeri Batam
            </p>
        </div>

    </div>
</div>

<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
