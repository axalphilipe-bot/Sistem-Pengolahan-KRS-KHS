@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <h1 class="page-title">Tambah Mahasiswa</h1>

    <form action="/admin/mahasiswa/store" method="POST">
        @csrf

        <div style="margin-bottom:15px;">
            <label>NIM</label><br>
            <input type="text" name="nim" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Nama Mahasiswa</label><br>
            <input type="text" name="nama" style="width:300px;padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Email</label><br>
            <input type="email" name="email" style="width:300px;padding:8px;">
        </div>

       <div style="margin-bottom:15px;">
    <label>Kelas</label><br>

    <select name="kelas" style="width:300px;padding:8px;">
        <option value="">Pilih Kelas</option>
        <option value="Reguler Pagi">Reguler Pagi</option>
        <option value="Reguler Malam">Reguler Malam</option>
        <option value="Batamindo">Batamindo</option>
    </select>
</div>

<div style="margin-bottom:15px;">
    <label>Kelas Huruf</label><br>

    <select name="kelas_huruf" style="width:300px;padding:8px;">
        <option value="">Pilih Kelas Huruf</option>

        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
    </select>
</div>

<div style="margin-bottom:15px;">
    <label>Jenjang</label><br>

    <select name="jenjang" style="width:300px;padding:8px;">
        <option value="">Pilih Jenjang</option>
        <option value="D3">D3</option>
        <option value="D4">D4</option>
        <option value="S2 Terapan">S2 Terapan</option>
    </select>
</div>

<div style="margin-bottom:15px;">
    <label>Program Studi</label><br>

    <select name="kode_prodi" style="width:300px;padding:8px;">
        <option value="">Pilih Program Studi</option>

        <option value="IF">D3 Teknik Informatika (IF)</option>

        <option value="GM">D3 Teknik Geomatika (GM)</option>

        <option value="AN">D4 Animasi (AN)</option>

        <option value="TRM">D4 Teknologi Rekayasa Multimedia (TRM)</option>

        <option value="KS">D4 Keamanan Siber (KS)</option>

        <option value="RPL">D4 Rekayasa Perangkat Lunak (RPL)</option>

        <option value="TP">D4 Teknologi Permainan (TP)</option>

        <option value="MTK">Magister Terapan Teknik Komputer (MTK)</option>
    </select>
</div>

<div style="margin-bottom:15px;">
    <label>Semester</label><br>

    <select name="semester" style="width:300px;padding:8px;">
        <option value="">Pilih Semester</option>

        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
        <option value="7">Semester 7</option>
        <option value="8">Semester 8</option>
    </select>
</div>

        <button type="submit"
            style="
            background:#0d6efd;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
        ">
            Simpan
        </button>

    </form>

</div>

@endsection