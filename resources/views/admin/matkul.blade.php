@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Mata Kuliah</h1>
    <p class="page-subtitle">
        Kelola data mata kuliah
    </p>
<div class="toolbar">

    <a href="/admin/matkul/create" class="btn-success">
        <i class="fa-solid fa-plus"></i>
        Tambah Mata Kuliah
    </a>

    <input
        type="text"
        class="search-input"
        placeholder="Cari Mata Kuliah...">

    <select class="filter-prodi">
        <option value="">Semua Prodi</option>

        @foreach($prodi as $p)
        <option value="{{ $p->kode_prodi }}">
            {{ $p->nama_prodi }}
        </option>
        @endforeach

    </select>

    <button class="btn-info">
    <i class="fa-solid fa-magnifying-glass"></i>
</button>

</div>

    <!-- TABLE -->
    <div class="table-wrappe">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

@foreach($matkul as $m)

<tr>

    <td>{{ $m->kode_mk }}</td>

    <td>{{ $m->nama_mk }}</td>

    <td>{{ $m->sks }}</td>

    <td>{{ $m->kode_prodi }}</td>

    <td class="aksi" style="white-space:nowrap;">

    <a href="/admin/matkul/{{ $m->kode_mk }}" class="btn btn-info">
    <i class="fa-solid fa-eye"></i>
    Lihat
</a>

<a href="/admin/matkul/{{ $m->kode_mk }}/edit" class="btn btn-warning">
    <i class="fa-solid fa-pen"></i>
    Edit
</a>

<a href="/admin/matkul/{{ $m->kode_mk }}/hapus"
   class="btn btn-danger"
   onclick="return confirm('Yakin hapus data?')">
    <i class="fa-solid fa-trash"></i>
    Hapus
</a>

</td>

</tr>

@endforeach

</tbody>

        </table>

    </div>

</div>

@endsection