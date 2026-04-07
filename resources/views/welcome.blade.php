@extends('layouts.app')

@section('content')

<!-- HERO -->
 <div class="header">
    <div class="header-content">

        <!-- KIRI -->
        <div class="header-text">
            <h1>Sistem Pengelolaan KRS & KHS Mahasiswa</h1>
        </div>

        <!-- KANAN -->
        <div class="header-image">
            <img src="{{ asset('img/krs.png') }}" alt="KRS">
        </div>

    </div>
</div>

@include('components.cards')

@include('components.menu')

@include('components.contact')
@endsection