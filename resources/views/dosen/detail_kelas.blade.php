@extends('layouts.dosen')

@section('content')

<style>
.detail-container{
    padding:20px;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-header h2{
    color:#1f4e79;
    margin:0;
}

.btn-group{
    display:flex;
    gap:10px;
}

.btn-back{
    background:#6c757d;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    font-weight:600;
}

.btn-back:hover{
    opacity:.9;
}

.btn-nilai{
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    font-weight:600;
}

.btn-nilai:hover{
    opacity:.9;
}

.info-card{
    background:white;
    border-radius:16px;
    padding:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
    margin-bottom:20px;
}

.info-card h3{
    margin-top:0;
    color:#1f4e79;
}

.stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin-bottom:25px;
}

.stat-card{
    background:white;
    border-radius:14px;
    padding:20px;
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
}

.stat-card h2{
    margin:0;
    color:#2563eb;
}

.stat-card p{
    margin-top:8px;
    color:#666;
}

.table-card{
    background:white;
    border-radius:16px;
    padding:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

.table-card h3{
    margin-top:0;
    color:#1f4e79;
}

.custom-table{
    width:100%;
    border-collapse:collapse;
}

.custom-table th{
    background:#dbeafe;
    padding:14px;
    text-align:center;
}

.custom-table td{
    padding:14px;
    text-align:center;
    border-bottom:1px solid #e5e7eb;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    color:white;
    font-size:13px;
    font-weight:600;
}

.badge-success{
    background:#22c55e;
}

.badge-warning{
    background:#f59e0b;
}

.btn-detail{
    background:#3b82f6;
    color:white;
    text-decoration:none;
    padding:8px 14px;
    border-radius:8px;
}

@media(max-width:900px){

.stats{
    grid-template-columns:1fr 1fr;
}

.page-header{
    flex-direction:column;
    align-items:flex-start;
    gap:10px;
}
}
</style>

<div class="detail-container">
<div class="page-header">

    <div>
        <h2 class="page-title">
    <i class="fas fa-chalkboard-teacher"></i>
    Detail Kelas
</h2>
        <p>Informasi mata kuliah dan daftar mahasiswa.</p>
    </div>

    <div class="btn-group">

        <a href="/dosen/kelas" class="btn-kembali">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>

        <a href="/dosen/nilai/{{ $matkul->kode_mk }}"
class="btn-input">
    <i class="fas fa-pen"></i>
    Input Nilai
</a>
    </div>

</div>

<div class="info-card">

    <h3>{{ $matkul->nama_mk }}</h3>

    <p><strong>Kode MK :</strong> {{ $matkul->kode_mk }}</p>
    <p><strong>SKS :</strong> {{ $matkul->sks }}</p>
    <p><strong>Semester :</strong> {{ ucfirst($matkul->semester) }}</p>

</div>

<div class="stats">

    <div class="stat-card">
    <h2>{{ $peserta->count() }}</h2>
    <p>Total Mahasiswa</p>
</div>

    <div class="stat-card">
        <h2>{{ $matkul->sks }}</h2>
        <p>Jumlah SKS</p>
    </div>

    <div class="stat-card">
        <h2>{{ ucfirst($matkul->semester) }}</h2>
        <p>Semester</p>
    </div>

    <div class="stat-card">
    <h2>{{ $peserta->count() }}</h2>
    <p>KRS Disetujui</p>
</div>

</div>

<div class="table-card">

    <h3>Daftar Mahasiswa</h3>

    <table class="custom-table">

        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Status KRS</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

@forelse($peserta as $item)

<tr>

```
<td>{{ $loop->iteration }}</td>

<td>{{ $item->nim }}</td>

<td>{{ $item->mahasiswa->nama ?? '-' }}</td>

<td>
    <span class="badge badge-success">
        Disetujui
    </span>
</td>

<td>
    <a href="/dosen/nilai/{{ $matkul->kode_mk }}"
class="btn-nilai-soft">
    <i class="fas fa-pen"></i>
    Nilai
</a>
</td>
```

</tr>

@empty

<tr>
    <td colspan="5">
        Belum ada mahasiswa yang mengambil mata kuliah ini
    </td>
</tr>

@endforelse

</tbody>


    </table>

</div>
```

</div>

@endsection
