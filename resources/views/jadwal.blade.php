@extends('layouts.app')

@section('content')

<div class="container-jadwal">

    <h2>Jadwal Kuliah</h2>

    <!-- Filter -->
  <div class="krs-filter">

        <div class="filter-item">
            <label>Semester</label>
            <select required>
                <option value="">-- Pilih Semester --</option>
                <option>2025/2026 Genap</option>
            </select>
        </div>

        <div class="filter-item">
            <label>Jurusan</label>
            <select required>
                <option value="">-- Pilih Jurusan --</option>
                <option>Teknik Informatika</option>
            </select>
        </div>

        <div class="action-btn">
            <button class="btn-export">📄 Export PDF</button>
        </div>
    </div>

    <!-- Card -->
    <div class="card-jadwal">
        <table>
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>

                <!-- SENIN -->
                <tr class="hari">
                    <td rowspan="7">Senin</td>
                    <td>17:10 - 18:00</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>18:00 - 18:50</td>
                    <td>IF211-Basis Data</td>
                    <td>HW</td>
                    <td>Online</td>
                </tr>
                <tr>
                    <td>18:50 - 19:40</td>
                    <td>IF212-Pemrograman Berorientasi Objek</td>
                    <td>HW</td>
                    <td>Online</td>
                </tr>
                <tr>
                    <td>19:40 - 20:30</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>20:30 - 21:20</td>
                    <td class="praktikum">IF212-Pemrograman Berorientasi Objek (Praktikum)</td>
                    <td>HW</td>
                    <td>GU 706</td>
                </tr>
                <tr>
                    <td>21:20 - 22:10</td>
                    <td class="praktikum">IF212-Pemrograman Berorientasi Objek (Praktikum)</td>
                    <td>HW</td>
                    <td>GU 706</td>
                </tr>
                <tr>
                    <td>22:10 - 23:00</td>
                    <td class="praktikum">IF212-Pemrograman Berorientasi Objek (Praktikunm)</td>
                    <td>HW</td>
                    <td>GU 706</td>
                </tr>
                <!-- SELASA -->
                <tr class="hari">
                    <td rowspan="7">Selasa</td>
                    <td>17:10 - 18:00</td>
                    <td>IF208-Dasar Rekayasa Perangkat Lunak</td>
                    <td>UM</td>
                    <td>Online</td>
                </tr>
                <tr>
                    <td>18:00 - 18:50</td>
                    <td class="praktikum">IF208-Dasar Rekayasa Perangkat Lunak (Praktikum)</td>
                    <td>UM</td>
                    <td>GU 702</td>
                </tr>
                 <tr>
                    <td>18:50 - 19:40</td>
                    <td class="praktikum">IF208-Dasar Rekayasa Perangkat Lunak (Praktikum)</td>
                    <td>UM</td>
                    <td>GU 702</td>
                </tr>
                 <tr>
                    <td>19:40 - 20:30</td>
                    <td class="praktikum">IF208-Dasar Rekayasa Perangkat Lunak (Praktikum)</td>
                    <td>UM</td>
                    <td>GU 702</td>
                </tr>
                <tr>
                    <td>20:30 - 21:20</td>
                    <td class="praktikum">IF211-Basis Data (Praktikum)</td>
                    <td>HW</td>
                    <td>GU 706</td>
                </tr>
                <tr>
                    <td>21:20 - 22:10</td>
                    <td class="praktikum">IF211-Basis Data (Praktikum)</td>
                    <td>HW</td>
                    <td>GU 706</td>
                </tr>
                 <tr>
                    <td>22:10 - 23:00</td>
                    <td class="praktikum">IF-211Basis Data (Praktikum)</td>
                    <td>HW</td>
                    <td>GU 706</td>
                </tr>

                <!-- RABU -->
                <tr class="hari">
                    <td rowspan="7">Rabu</td>
                    <td>17:10 - 18:00</td>
                    <td>IF210-Pemrograman Web</td>
                    <td>GL</td>
                    <td>Online</td>
                </tr>
                <tr>
                    <td>18:00 - 18:50</td>
                    <td class="praktikum">IF210-Pemrograman Web (Praktikum)</td>
                    <td>GL</td>
                    <td>TA 114</td>
                </tr>
                  <tr>
                    <td>18:50 - 19:40</td>
                    <td class="praktikum">IF210-Pemrograman Web (Praktikum)</td>
                    <td>GL</td>
                    <td>TA 114</td>
                </tr>
                  <tr>
                    <td>19:40 - 20:30</td>
                    <td class="praktikum">IF210-Pemrograman Web (Praktikum)</td>
                    <td>GL</td>
                    <td>TA 114</td>
                </tr>
                  <tr>
                    <td>20:30 - 21:20</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                  <tr>
                    <td>21:20 - 22:10</td>
                    <td class="praktikum">IF210-Pemrograman Web (Praktikum)</td>
                    <td>GL</td>
                    <td>TA 114</td>
                </tr>
                <tr>
                    <td>22:10 - 23:00</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                <!-- KAMIS -->
                <tr class="hari">
                    <td rowspan="7">Kamis</td>
                    <td>17:10 - 18:00</td>
                    <td>IF213-Bahasa Inggris Untuk Komunikasi</td>
                    <td>NH</td>
                    <td>Online</td>
                </tr>
                <tr>
                    <td>18:00 - 18:50</td>
                    <td class="praktikum">IF213-Bahasa Inggris Untuk Komunikasi (Praktikum)</td>
                    <td>NH</td>
                    <td>TA 604</td>
                </tr>
                <tr>
                    <td>18:50 - 19:40</td>
                    <td class="praktikum">IF213-Bahasa Inggris Untuk Komunikasi (Praktikum)</td>
                    <td>NH</td>
                    <td>TA 604</td>
                </tr>
                <tr>
                    <td>19:40 - 20:30</td>
                    <td class="praktikum">IF213-Bahasa Inggris Untuk Komunikasi (Praktikum)</td>
                    <td>NH</td>
                    <td>TA 604</td>
                </tr>
                <tr>
                    <td>20:30 - 21:20</td>
                    <td class="praktikum">IF209-Jaringan Komputer (Praktikum)</td>
                    <td>DE</td>
                    <td>GU 601</td>
                </tr>
                <tr>
                    <td>21:20 - 22:10</td>
                    <td class="praktikum">IF209-Jaringan Komputer (Praktikum)</td>
                    <td>DE</td>
                    <td>GU 601</td>
                </tr>
                <tr>
                    <td>22:10 - 23:00</td>
                    <td class="praktikum">IF209-Jaringan Komputer (Praktikum)</td>
                    <td>DE</td>
                    <td>GU 601</td>
                </tr>

                <!-- JUMAT -->
                <tr class="hari">
                    <td rowspan="7">Jumat</td>
                    <td>17:10 - 18:00</td>
                    <td class="praktikum">IF207-Proyek Pembuatan Prototipe (Praktikum)</td>
                    <td>SS</td>
                    <td>GU 705</td>
                </tr>
                <tr>
                    <td>18:00 - 18:50</td>
                    <td class="praktikum">IF207-Proyek Pembuatan Prototipe (Praktikum)</td>
                    <td>SS</td>
                    <td>GU 705</td>
                </tr>
                <tr>
                    <td>18:50 - 19:40</td>
                    <td class="praktikum">IF207-Proyek Pembuatan Prototipe (Praktikum)</td>
                    <td>SS</td>
                    <td>GU 705</td>
                </tr>
                <tr>
                    <td>19:40 - 20:30</td>
                    <td class="praktikum">IF207-Proyek Pembuatan Prototipe (Praktikum)</td>
                    <td>SS</td>
                    <td>GU 705</td>
                </tr>
                <tr>
                    <td>20:30 - 21:20</td>
                    <td class="praktikum">IF207-Proyek Pembuatan Prototipe (Praktikum)</td>
                    <td>HO</td>
                    <td>GU 705</td>
                </tr>
                <tr>
                    <td>21:20 - 22:10</td>
                    <td class="praktikum">IF207-Proyek Pembuatan Prototipe (Praktikum)</td>
                    <td>HO</td>
                    <td>GU 705</td>
                </tr>
                <tr>
                    <td>22:10 - 23:00</td>
                    <td class="praktikum">IF207-Proyek Pembuatan Prototipe (Praktikum)</td>
                    <td>HO</td>
                    <td>GU 705</td>
                </tr>

            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer-jadwal">
            <div>
                <strong>Total Mata Kuliah:</strong> 5 <br>
                <strong>Total SKS:</strong> 15
            </div>

            <button class="btn-detail">Lihat Detail</button>
        </div>
    </div>

</div>

@endsection