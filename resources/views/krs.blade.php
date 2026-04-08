@extends('layouts.app')

@section('content')

<div class="krs-container">

    <div class="krs-header">
        <h2>Ambil KRS</h2>

        <div class="krs-actions">
            <button class="btn pdf">Export PDF</button>
            <button class="btn excel">Export</button>
        </div>
    </div>

    <form>

<div class="krs-filter">

    <div class="filter-item">
        <label>Semester</label>
        <select required>
            <option value="">-- Pilih Semester --</option>
            <option value="1">2025/2026 Genap</option>
        </select>
    </div>

    <div class="filter-item">
        <label>Jurusan</label>
        <select required>
            <option value="">-- Pilih Jurusan --</option>
            <option value="TI">Teknik Informatika</option>
        </select>
    </div>

</div>

<button type="submit" class="btn ambil">Submit</button>

</form>

    <div class="krs-alert">
        ⚠ Maksimal SKS yang dapat diambil adalah 24 SKS per semester.
        Pastikan tidak ada bentrok jadwal.
    </div>
    <div class="krs-table">
        <table>
            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Dosen Pengampu</th>
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>IF2020</td>
                    <td>Basis Data</td>
                    <td>3</td>
                    <td>Hilda Widyastuti</td>
                    <td><input type="checkbox" class="matkul" data-sks="3"></td>
                </tr>
                <tr>
                    <td>IF2021</td>
                    <td>Pemograman Web</td>
                    <td>3</td>
                    <td>Gilang Bagus</td>
                    <td><input type="checkbox" class="matkul" data-sks="3"></td>
                </tr>
                <tr>
                    <td>IF2022</td>
                    <td>Proyek Pembuatan Prototype</td>
                    <td>3</td>
                    <td>Holong Marisi</td>
                    <td><input type="checkbox" class="matkul" data-sks="3"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="krs-footer">
        <span>Total SKS diambil: <b><span id="total-sks">0</span>/24 SKS</b></span>
        <button class="btn ambil">Ambil KRS</button>
    </div>

</div>
<script src="{{ asset('js/krs.js') }}"></script>
@endsection