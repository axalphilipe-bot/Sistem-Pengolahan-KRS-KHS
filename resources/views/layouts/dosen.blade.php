<!DOCTYPE html>
<html>
<head>
    <title>Dosen</title>

    <link rel="stylesheet" href="{{ asset('css/dosen.css') }}">
</head>

<body>

<div class="wrapper">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar_dosen')

    {{-- CONTENT --}}
    <div class="main-content">

        {{-- NAVBAR --}}
        <div class="topbar">
            <h3>Dosen Panel</h3>
        </div>

        @yield('content')

    </div>

</div>

</body>
</html>