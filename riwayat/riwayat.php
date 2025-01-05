<?php
require_once "../_config/config.php";
include_once('../_header.php');

// Ambil data pasien
$id_pasien = $_GET['id']; // ID pasien yang dipilih
$query_pasien = mysqli_query($con, "SELECT * FROM pasien WHERE id = '$id_pasien'");
$data_pasien = mysqli_fetch_assoc($query_pasien);

// Ambil data riwayat dari tabel periksa
$query_riwayat = mysqli_query($con, "
    SELECT 
        periksa.tgl_periksa, 
        periksa.catatan, 
        periksa.biaya_periksa,
        daftar_poli.keluhan, 
        dokter.nama AS nama_dokter,
        GROUP_CONCAT(obat.nama_obat SEPARATOR ', ') AS obat
    FROM periksa
    JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id
    JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id
    JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
    LEFT JOIN detail_periksa ON periksa.id = detail_periksa.id_periksa
    LEFT JOIN obat ON detail_periksa.id_obat = obat.id
    WHERE daftar_poli.id_pasien = '$id_pasien'
    GROUP BY periksa.id
    ORDER BY periksa.tgl_periksa DESC
");
?>

<div class="slides">
    <div class="slide" id="2">
        <div class="content second-content">
            <h1 style="color: black;">Riwayat Pasien</h1>

            <h3 style="color: black;">Informasi Pasien</h3>
            <table class="table table-bordered" style="color: black;">
                <tr>
                    <th style="color: black;">Nama</th>
                    <td style="color: black;"><?= $data_pasien['nama'] ?></td>
                </tr>
                <tr>
                    <th style="color: black;">Alamat</th>
                    <td style="color: black;"><?= $data_pasien['alamat'] ?></td>
                </tr>
                <tr>
                    <th style="color: black;">No. KTP</th>
                    <td style="color: black;"><?= $data_pasien['no_ktp'] ?></td>
                </tr>
                <tr>
                    <th style="color: black;">No. HP</th>
                    <td style="color: black;"><?= $data_pasien['no_hp'] ?></td>
                </tr>
            </table>

            <h3 style="color: black;">Riwayat Pemeriksaan</h3>
            <table class="table table-bordered table-hover" style="color: black;">
                <thead>
                    <tr>
                        <th style="color: black;">Tanggal Periksa</th>
                        <th style="color: black;">Keluhan</th>
                        <th style="color: black;">Catatan</th>
                        <th style="color: black;">Dokter</th>
                        <th style="color: black;">Obat</th>
                        <th style="color: black;">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query_riwayat)) : ?>
                        <tr>
                            <td style="color: black;"><?= $row['tgl_periksa'] ?></td>
                            <td style="color: black;"><?= $row['keluhan'] ?></td>
                            <td style="color: black;"><?= $row['catatan'] ?></td>
                            <td style="color: black;"><?= $row['nama_dokter'] ?></td>
                            <td style="color: black;"><?= $row['obat'] ?: '-' ?></td>
                            <td style="color: black;">Rp<?= number_format($row['biaya_periksa'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="data.php" class="btn btn-primary" style="color: black; background-color: #3498db; border-color: #2980b9;">Kembali</a>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>
