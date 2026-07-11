    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'KPS') | Sistem Pengelolaan KRS & KHS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/kps-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kps.css') }}">

    @stack('styles')
</head>
<body>

<div class="kps-layout">

    @include('layouts.sidebar_kps')

    <button type="button" class="kps-sidebar-toggle" id="kpsSidebarToggle" aria-label="Buka menu">
        <i class="fa-solid fa-bars"></i>
    </button>

    <main class="main-content">

        @if(session('success'))
            <div class="kps-alert kps-alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="kps-alert kps-alert-error">
                <i class="fa-solid fa-circle-xmark"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

</div>

<script src="{{ asset('js/kps-sidebar.js') }}"></script>

@stack('scripts')

</body>
</html>
