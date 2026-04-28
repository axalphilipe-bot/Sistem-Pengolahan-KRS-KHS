@extends('layouts.app')

@section('content')
<div class="nilai-container">

    <h2 class="nilai-title">Input Nilai - {{ $matkul->nama ?? 'Mata Kuliah' }}</h2>

    <table class="nilai-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Nilai</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Diva</td>
                <td>12345678</td>
                <td>
                    <input type="text" class="nilai-input" placeholder="A / B / C">
                </td>
            </tr>
        </tbody>
    </table>

    <button class="btn-simpan">Simpan Nilai</button>

</div>
@endsection