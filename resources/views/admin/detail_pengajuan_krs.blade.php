@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
        Detail Pengajuan KRS
    </h1>

    <div class="card">

        <h3>Data Mahasiswa</h3>

        <p>
            <b>NIM :</b>
            {{ $mahasiswa->nim }}
        </p>

        <p>
            <b>Nama :</b>
            {{ $mahasiswa->nama }}
        </p>

        <p>
            <b>Prodi :</b>
            {{ $mahasiswa->kode_prodi }}
        </p>

        <p>
            <b>Semester :</b>
            {{ $mahasiswa->semester }}
        </p>

    </div>

    <br>

    <div class="table-wrapper">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                </tr>
            </thead>

            <tbody>

            @foreach($krs as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_mk }}</td>
                    <td>{{ $item->matkul->nama_mk ?? '-' }}</td>
                    <td>{{ $item->matkul->sks ?? '-' }}</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    <br>

    <h3>
        Total SKS :
        {{ $totalSks }}
    </h3>

</div>

@endsection