<!DOCTYPE html>
<html>
<head>
    <title>Laporan KRS</title>

    <style>
        body{
            font-family: Arial, sans-serif;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:8px;
            text-align:left;
        }
    </style>
</head>
<body>

<h2>Laporan KRS Mahasiswa</h2>

<table>
    <thead>
        <tr>
            <th>NIM</th>
            <th>Kode MK</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>

    <tbody>

    @foreach($krs as $item)

    <tr>
        <td>{{ $item->nim }}</td>
        <td>{{ $item->kode_mk }}</td>
        <td>{{ $item->status }}</td>
        <td>{{ $item->created_at }}</td>
    </tr>

    @endforeach

    </tbody>
</table>

</body>
</html>