<?php include_once('../_header.php'); ?>

<div class="slides">
    <div class="slide" id="data_pendaftaran">
        <div class="content third-content">
            <h1 style="color: black;">Daftar Pendaftaran Poli</h1>
            <h4>
                <small style="color: black;">Daftar Pendaftaran Pasien</small>
                <div class="pull-right">
                    <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Pendaftaran</a>
                </div>
            </h4>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="color: black; ">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Poli</th>
                            <th>Nama Dokter</th>
                            <th>Jadwal</th>
                            <th>Keluhan</th>
                            <th>No Antrian</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $batas = 5;
                        $hal = @$_GET['hal'];
                        if (empty($hal)) {
                            $posisi = 0;
                            $hal = 1;
                        } else {
                            $posisi = ($hal - 1) * $batas;
                        }
                        $no = 1;

                        // Corrected SQL query to join the necessary tables
                        $query = 
                            "SELECT dp.*, p.nama_poli, d.nama AS dokter_name, jp.hari, jp.jam_mulai, jp.jam_selesai
                            FROM daftar_poli dp
                            JOIN poli p ON dp.id_poli = p.id
                            JOIN jadwal_periksa jp ON dp.id_jadwal = jp.id
                            JOIN dokter d ON jp.id_dokter = d.id
                            LIMIT $posisi, $batas";
                        $sql = mysqli_query($con, $query);
                        if (!$sql) {
                            echo "Error: " . mysqli_error($con); // Show error if query fails
                        } else {
                            while ($data = mysqli_fetch_array($sql)) {
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_poli'] ?></td>
                                <td><?= $data['dokter_name'] ?></td>
                                <td><?= $data['hari'] . ' ' . $data['jam_mulai'] . ' - ' . $data['jam_selesai'] ?></td>
                                <td><?= $data['keluhan'] ?></td>
                                <td><?= $data['no_antrian'] ?></td>
                            </tr>
                    <?php 
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <?php
            // Pagination
            $query_jml = "SELECT COUNT(*) AS total FROM daftar_poli";
            $result = mysqli_query($con, $query_jml);
            $data_jml = mysqli_fetch_assoc($result);
            $jml_data = $data_jml['total'];
            $jml_hal = ceil($jml_data / $batas);
            ?>
            <div style="float:left;">
                Jumlah Data : <b><?= $jml_data ?></b>
            </div>
            <div style="float:right;">
                <ul class="pagination pagination-sm" style="margin:0">
                    <?php
                    for ($i = 1; $i <= $jml_hal; $i++) {
                        if ($i != $hal) {
                            echo "<li><a href=\"?hal=$i\">$i</a></li>";
                        } else {
                            echo "<li class=\"active\"><a>$i</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>
