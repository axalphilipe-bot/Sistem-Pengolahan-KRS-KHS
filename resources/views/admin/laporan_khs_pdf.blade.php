<!DOCTYPE html>
<html>
<head>
    <title>Laporan KHS</title>

    <style>
        body{
            font-family: Arial, sans-serif;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #000;
            padding:8px;
            text-align:left;
        }

        th{
            background:#f2f2f2;
        }
    </style>
</head>
<body>

<h2>Laporan KHS Mahasiswa</h2>

<table>

    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Kode MK</th>
            <th>Nilai Akhir</th>
            <th>Nilai Huruf</th>
            <th>Index</th>
        </tr>
    </thead>

    <tbody>

    @foreach($nilai as $item)

        <tr>
            <td>{{ $item->nim }}</td>
            <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
            <td>{{ $item->kode_mk }}</td>
            <td>{{ $item->nilai_akhir }}</td>
            <td>{{ $item->nilai_huruf }}</td>
            <td>{{ $item->index_nilai }}</td>
        </tr>

    @endforeach

    </tbody>

</table>

</body>
</html>