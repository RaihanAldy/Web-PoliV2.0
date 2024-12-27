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
            <h1 style="color: white;">Riwayat Pasien</h1>

            <h3 style="color: white;">Informasi Pasien</h3>
            <table class="table table-bordered" style="background-color: #222222; color: white;">
                <tr>
                    <th style="background-color: #222222; color: white;">Nama</th>
                    <td style="color: white;"><?= $data_pasien['nama'] ?></td>
                </tr>
                <tr>
                    <th style="background-color: #222222; color: white;">Alamat</th>
                    <td style="color: white;"><?= $data_pasien['alamat'] ?></td>
                </tr>
                <tr>
                    <th style="background-color: #222222; color: white;">No. KTP</th>
                    <td style="color: white;"><?= $data_pasien['no_ktp'] ?></td>
                </tr>
                <tr>
                    <th style="background-color: #222222; color: white;">No. HP</th>
                    <td style="color: white;"><?= $data_pasien['no_hp'] ?></td>
                </tr>
            </table>

            <h3 style="color: white;">Riwayat Pemeriksaan</h3>
            <table class="table table-bordered table-hover" style="background-color: #3b3b3b; color: white;">
                <thead>
                    <tr>
                        <th style="background-color: #222222; color: white;">Tanggal Periksa</th>
                        <th style="background-color: #222222; color: white;">Keluhan</th>
                        <th style="background-color: #222222; color: white;">Catatan</th>
                        <th style="background-color: #222222; color: white;">Dokter</th>
                        <th style="background-color: #222222; color: white;">Obat</th>
                        <th style="background-color: #222222; color: white;">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query_riwayat)) : ?>
                        <tr>
                            <td style="color: white;"><?= $row['tgl_periksa'] ?></td>
                            <td style="color: white;"><?= $row['keluhan'] ?></td>
                            <td style="color: white;"><?= $row['catatan'] ?></td>
                            <td style="color: white;"><?= $row['nama_dokter'] ?></td>
                            <td style="color: white;"><?= $row['obat'] ?: '-' ?></td>
                            <td style="color: white;">Rp<?= number_format($row['biaya_periksa'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="data.php" class="btn btn-primary" style="color: white; background-color: #3498db; border-color: #2980b9;">Kembali</a>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>
