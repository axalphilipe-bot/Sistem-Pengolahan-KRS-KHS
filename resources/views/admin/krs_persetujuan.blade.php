@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">
    <i class="fa-solid fa-circle-check"></i>
    Persetujuan KRS
</h1>

    <p class="page-subtitle">
        Setujui atau tolak pengajuan KRS mahasiswa.
    </p>

    {{-- SEARCH --}}
    <form method="GET"
      action="/admin/krs-approve"
      style="
        display:flex;
        align-items:center;
        gap:12px;
        margin-bottom:25px;
      ">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari NIM atau Nama Mahasiswa..."
        style="
            flex:1;
            height:50px;
            border:1px solid #dbe4f1;
            border-radius:12px;
            padding:0 18px;
            font-size:15px;
            outline:none;
        ">

    <button
        type="submit"
        style="
            width:50px;
            height:50px;
            border:none;
            border-radius:12px;
            background:#355872;
            color:white;
            cursor:pointer;
        ">

        <i class="fa-solid fa-magnifying-glass"></i>

    </button>

</form>

    {{-- TABLE --}}
    <div class="table-wrapper">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Semester</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($krs as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nim }}</td>

                    <td>
                        {{ $item->mahasiswa->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->mahasiswa->semester ?? '-' }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                    </td>

                    <td>

                        @if($item->status == 'Pending')

                            <span class="status pending">
                                Pending
                            </span>

                        @elseif($item->status == 'Disetujui')

                            <span class="status approved">
                                Disetujui
                            </span>

                        @else

                            <span class="status rejected">
                                Ditolak
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($item->status == 'Pending')

                            <a href="/admin/krs/setujui/{{ $item->id }}"
class="btn-success-custom">

                            <a href="/admin/krs/tolak/{{ $item->id }}"
class="btn-danger-custom">

                        @else

                            <a href="/admin/krs/{{ $item->nim }}"
   class="btn-icon btn-view"
   title="Detail">

    <i class="fa-solid fa-eye"></i>

</a>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" style="text-align:center;padding:30px;">

                        Tidak ada pengajuan KRS yang menunggu persetujuan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection