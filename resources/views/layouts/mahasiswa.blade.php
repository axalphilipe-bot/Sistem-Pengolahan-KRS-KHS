<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Mahasiswa | Sistem KRS & KHS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mahasiswa-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mahasiswa-dashboard.css') }}">

    @stack('styles')
</head>

<body>

<div class="mhs-layout">

    @include('layouts.sidebar_mahasiswa')

    <button type="button" class="mhs-sidebar-toggle" id="mhsSidebarToggle" aria-label="Buka menu">
        <i class="fa-solid fa-bars"></i>
    </button>

    <main class="main-content">

        @yield('content')

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/mhs-sidebar.js') }}"></script>

@stack('scripts')

</body>
</html>
