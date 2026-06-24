@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Pengajuan KRS</h1>

    <p class="page-subtitle">
        Daftar pengajuan KRS yang diajukan oleh mahasiswa.
    </p>

    <!-- SEARCH -->
    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>

        <input type="text"
        placeholder="Cari NIM atau nama mahasiswa...">
    </div>

    <!-- TABLE -->
    <div class="table-wrappe">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                    <th>Semester</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

@foreach($krs as $item)

<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->nim }}</td>

<td>
    {{ $item->mahasiswa->nama ?? '-' }}
</td>

<td>
    {{ $item->mahasiswa->kode_prodi ?? '-' }}
</td>

<td>
    {{ $item->mahasiswa->semester ?? '-' }}
</td>
    <td>
    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
</td>
    <td>
        <span class="status pending">
            {{ $item->status }}
        </span>
    </td>
    <td>

@if($item->status == 'Pending')

    <a href="#"
       class="btn-setujui">
        Setujui
    </a>

    <a href="#"
       class="btn-tolak">
        Tolak
    </a>

@else

    <a href="/admin/krs/{{ $item->nim }}"
       class="btn-lihat">
        Lihat
    </a>

@endif

</td>
</tr>

@endforeach

</tbody>

        </table>

    </div>

</div>

@endsection