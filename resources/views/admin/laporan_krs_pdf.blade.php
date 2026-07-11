<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan KRS</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; }
        h2 { text-align: center; margin: 0 0 4px; font-size: 16px; }
        p.sub { text-align: center; margin: 0 0 16px; color: #64748b; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #355872; color: #fff; padding: 7px 8px; text-align: left; font-size: 10px; }
        td { padding: 6px 8px; border-bottom: 1px solid #e2e8f0; }
        tr:nth-child(even) td { background: #f8fafc; }
    </style>
</head>
<body>

<h2>Laporan KRS Mahasiswa</h2>
<p class="sub">Politeknik Negeri Batam · {{ now()->format('d F Y') }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Kode MK</th>
            <th>Mata Kuliah</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($krs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                <td>{{ $item->kode_mk }}</td>
                <td>{{ $item->mataKuliah->nama_mk ?? '-' }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
