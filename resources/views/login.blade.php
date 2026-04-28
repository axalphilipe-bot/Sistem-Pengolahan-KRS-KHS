<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login KRS KHS</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="login-container">
    <div class="login-card">

        <img src="{{ asset('img/logo.png') }}" class="login-logo">

        <h2>SISTEM PENGELOLAAN <br> KRS DAN KHS</h2>

        @if(session('error'))
            <p style="color:red; margin-bottom:10px;">
                {{ session('error') }}
            </p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <select name="role" required>
                <option value="">Pilih Jenis User</option>
                <option value="admin">Admin</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
            </select>

            <input 
                type="text" 
                name="login" 
                placeholder="Masukkan Email / NIM / NIDN"
                required
            >

            <input 
                type="password" 
                name="password" 
                placeholder="Password"
                required
            >

            <button type="submit">Login</button>
        </form>

    </div>
</div>


<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>