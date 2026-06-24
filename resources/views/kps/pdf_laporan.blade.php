<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai</title>

    <style>
        body{
            font-family: Arial, sans-serif;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #000;
            padding:8px;
            text-align:left;
        }

        th{
            background:#eeeeee;
        }
    </style>
</head>
<body>

<h2>Laporan Nilai</h2>

<table>
    <thead>
        <tr>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>Program Studi</th>
            <th>Semester</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    @foreach($data as $item)

    <tr>
        <td>{{ $item->nama_mk }}</td>
        <td>{{ $item->nama_dosen }}</td>
        <td>{{ $item->nama_prodi }}</td>
        <td>{{ ucfirst($item->semester) }}</td>
        <td>{{ $item->kunci_nilai }}</td>
    </tr>

    @endforeach

    </tbody>
</table>

</body>
</html>