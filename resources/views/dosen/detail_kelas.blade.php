@extends('layouts.dosen')

@section('content')

<h2>Detail Kelas - {{ $matkul->nama }}</h2>

<table>
    <thead>
        <tr>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Status KRS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Diva</td>
            <td>12345678</td>
            <td><span class="badge pending">Menunggu</span></td>
        </tr>
    </tbody>
</table>

@endsection