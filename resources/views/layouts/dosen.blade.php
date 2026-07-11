<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen | Sistem Pengelolaan KRS & KHS</title>

    <link rel="stylesheet" href="{{ asset('css/dosen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dosen-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dosen-dashboard.css') }}">

    @stack('styles')

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dosen-layout">

    @include('layouts.sidebar_dosen')

    <button type="button" class="dosen-sidebar-toggle" id="dosenSidebarToggle" aria-label="Buka menu">
        <i class="fa-solid fa-bars"></i>
    </button>

    <main class="main-content">

        {{-- NAVBAR --}}
        <div class="topbar">

    <h2>
        Sistem Pengelolaan KRS & KHS
    </h2>

    <div class="profile">
        <i class="fas fa-user-circle"></i>
        {{ auth()->user()->name }}
    </div>

</div>
        @yield('content')

    </main>

</div>
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>

<script src="{{ asset('js/dosen-sidebar.js') }}"></script>

@stack('scripts')
</body>
</html>