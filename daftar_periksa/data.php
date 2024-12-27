<?php
require_once "../_config/config.php"; // Pastikan koneksi tersedia
include_once('../_header.php');
?>

<div class="slides">
    <div class="slide" id="2">
        <div class="content second-content" style="color: white;">
            <h1>Daftar Periksa Pasien</h1>
            <h4>
                <small>Data Pasien Terdaftar</small>
            </h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="daftar_poli" style="color: white; background-color: #3b3b3b;">
                    <thead>
                        <tr>
                            <th><center>No. Antrian</center></th>
                            <th><center>Nama Pasien</center></th>
                            <th><center>Keluhan</center></th>
                            <th><center>Aksi</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT dp.id, dp.no_antrian, p.nama AS nama_pasien, dp.keluhan 
                              FROM daftar_poli dp 
                              JOIN pasien p ON dp.id_pasien = p.id";
                    $sql = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($data = mysqli_fetch_array($sql)) { ?>
                        <tr style="background-color: #222222;">
                            <td><center><?=$data['no_antrian']?></center></td>
                            <td><?=$data['nama_pasien']?></td>
                            <td><?=$data['keluhan']?></td>
                            <td align="center">
                                <?php
                                // Cek apakah sudah ada pemeriksaan untuk pasien ini
                                $id_daftar = $data['id']; // id pasien dari tabel daftar_poli
                                $query_periksa = mysqli_query($con, "SELECT * FROM periksa WHERE id_daftar_poli = '$id_daftar'");
                                $periksa_data = mysqli_fetch_assoc($query_periksa);
                                
                                // Jika ada data pemeriksaan, tampilkan tombol Edit, jika tidak tampilkan tombol Periksa
                                if ($periksa_data) {
                                    // Jika sudah diperiksa, tampilkan tombol Edit
                                    echo '<a href="periksa.php?id=' . $periksa_data['id'] . '" class="btn btn-warning btn-xs">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>';
                                } else {
                                    // Jika belum diperiksa, tampilkan tombol Periksa
                                    echo '<a href="periksa.php?id=' . $id_daftar . '" class="btn btn-success btn-xs">
                                            <i class="glyphicon glyphicon-check"></i> Periksa
                                        </a>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#daftar_poli').DataTable();
    });
</script>

<?php include_once('../_footer.php'); ?>
