<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet"
    href="{{ asset('css/dosen.css') }}">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="wrapper">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar_dosen')

    {{-- CONTENT --}}
    <div class="main-content">

        {{-- NAVBAR --}}
        <div class="topbar">

    <h2>
        Sistem Pengelolaan KRS & KHS
    </h2>

    <div class="profile">
        <i class="fas fa-user-circle"></i>
        Dosen Informatika
    </div>

</div>
        @yield('content')

    </div>

</div>
@stack('scripts')
</body>
</html>