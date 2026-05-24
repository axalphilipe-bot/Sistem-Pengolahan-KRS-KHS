@extends('layouts.dosen')

@section('content')

    <div class="nilai-container">

        <h2 class="nilai-title">
            Input Nilai - {{ $matkul->nama ?? 'Mata Kuliah' }}
        </h2>

        <table class="nilai-table">

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>UTS</th>
                    <th>Harian</th>
                    <th>Praktik</th>
                    <th>Tugas</th>
                    <th>Kehadiran</th>
                    <th>Nilai Akhir</th>
                    <th>Huruf</th>
                    <th>Index</th>
                </tr>
            </thead>

            <tbody>

                <tr>

                    <td>Diva</td>
                    <td>12345678</td>

                    <td>
                        <input type="number" class="nilai-input uts" value="-">
                    </td>

                    <td>
                        <input type="number" class="nilai-input harian" value="-">
                    </td>

                    <td>
                        <input type="number" class="nilai-input praktik" value="-">
                    </td>

                    <td>
                        <input type="number" class="nilai-input tugas" value="-">
                    </td>

                    <td>
                        <input type="number" class="nilai-input hadir" value="-">
                    </td>

                    <td>
                        <input type="text" id="nilaiAkhir" class="nilai-akhir" readonly>
                    </td>
                    <td>
                        <input type="text" id="nilaiHuruf" class="nilai-akhir" readonly>
                    </td>

                    <td>
                        <input type="text" id="nilaiIndex" class="nilai-akhir" readonly>
                    </td>
                </tr>

            </tbody>

        </table>

        <button class="btn-simpan">
            Simpan Nilai
        </button>

    </div>

@endsection

<script>

document.addEventListener("DOMContentLoaded", function () {

    const inputs = document.querySelectorAll(".nilai-input");

    function hitungNilai() {

        let uts = parseFloat(document.querySelector(".uts").value) || 0;
        let harian = parseFloat(document.querySelector(".harian").value) || 0;
        let praktik = parseFloat(document.querySelector(".praktik").value) || 0;
        let tugas = parseFloat(document.querySelector(".tugas").value) || 0;
        let hadir = parseFloat(document.querySelector(".hadir").value) || 0;

        let hasil =
            (uts * 0.25) +
            (harian * 0.20) +
            (praktik * 0.25) +
            (tugas * 0.20) +
            (hadir * 0.10);

        document.getElementById("nilaiAkhir").value =
            hasil.toFixed(2);

        let huruf = "";
        let index = "";

        if (hasil >= 85) {
            huruf = "A";
            index = "4.00";
        }

        else if (hasil >= 80) {
            huruf = "A-";
            index = "3.75";
        }

        else if (hasil >= 75) {
            huruf = "B+";
            index = "3.50";
        }

        else if (hasil >= 70) {
            huruf = "B";
            index = "3.00";
        }

        else if (hasil >= 65) {
            huruf = "C+";
            index = "2.50";
        }

        else if (hasil >= 60) {
            huruf = "C";
            index = "2.00";
        }

        else if (hasil >= 50) {
            huruf = "D";
            index = "1.00";
        }

        else {
            huruf = "E";
            index = "0.00";
        }

        document.getElementById("nilaiHuruf").value = huruf;
        document.getElementById("nilaiIndex").value = index;
    }

    inputs.forEach(input => {
        input.addEventListener("input", hitungNilai);
    });

    hitungNilai();

});

</script>