<?php include_once('../_header.php'); ?>

<div class="slides">
    <div class="slide" id="2">
        <div class="content second-content" style="color: white;">
            <h1>Poliklinik</h1>
            <h4>
                <small>Tambah Data Poliklinik</small>
                <div class="pull-right">
                    <a href="data.php" class="btn btn-info btn-xs">Data</a>
                    <a href="generate.php" class="btn btn-primary btn-xs">Tambah Data Lagi</a>
                </div>
            </h4>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form action="proses.php" method="post">
                        <input type="hidden" name="total" value="<?= isset($_POST['count_add']) ? $_POST['count_add'] : 1 ?>">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Nama Poliklinik</th>
                                <th>Alamat</th>
                            </tr>
                            <?php
                            for ($i = 1; $i <= $_POST['count_add']; $i++) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td>
                                        <input type="text" name="nama-<?= $i ?>" class="form-control" placeholder="Masukkan nama poliklinik" required>
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan-<?= $i ?>" class="form-control" placeholder="Masukkan alamat" required>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div class="form-group pull-right">
                            <input type="submit" name="add" value="Simpan Semua" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menyimpan semua data?')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>