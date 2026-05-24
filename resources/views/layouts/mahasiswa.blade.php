<!DOCTYPE html>
<html>
<head>
    <title>Mahasiswa</title>

    <link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">
</head>

<body>

<div class="wrapper">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar_mahasiswa')

    {{-- CONTENT --}}
    <div class="main-content">

        {{-- NAVBAR --}}
        <div class="topbar">
            <h3>Mahasiswa Panel</h3>
        </div>

        @yield('content')

    </div>

</div>

</body>
</html>