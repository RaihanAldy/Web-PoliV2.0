<?php
require_once "../_config/config.php";

// Pastikan hanya dokter yang dapat mengakses
if ($_SESSION['level'] !== '2') {
    echo "<script>alert('Akses ditolak!'); window.location='../dashboard';</script>";
    exit;
}

$id_dokter = $_SESSION['id_user']; // ID dokter dari sesi

// Ambil data dokter
$query_dokter = mysqli_query($con, "SELECT * FROM dokter WHERE id = '$id_dokter'");
$data_dokter = mysqli_fetch_assoc($query_dokter);

include_once('../_header.php');
?>

<div class="slides">
    <div class="slide" id="2">
        <div class="content second-content" style="color: white;">
            <h1>Profil Dokter</h1>
            <h4>
                <small>Edit Data Profil Dokter</small>
                <div class="pull-right">
                    <a href="../dashboard" class="btn btn-warning btn-xs">
                        <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                    </a>
                </div>
            </h4>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form action="proses.php" method="post">
                        <table class="table">
                            <tr>
                                <th>Nama Dokter</th>
                                <td>
                                    <select name="id_nama" class="form-control" required>
                                        <?php
                                        $query_nama = mysqli_query($con, "SELECT id, nama FROM dokter");
                                        while ($row_nama = mysqli_fetch_assoc($query_nama)) {
                                            $selected = $row_nama['id'] == $data_dokter['id'] ? 'selected' : '';
                                            echo "<option value='{$row_nama['id']}' $selected>{$row_nama['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>
                                    <textarea type="text" name="alamat" value="<?= $data_dokter['alamat'] ?>" 
                                           class="form-control" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Poli</th>
                                <td>
                                    <select name="id_poli" class="form-control" required>
                                        <?php
                                        $query_poli = mysqli_query($con, "SELECT * FROM poli");
                                        while ($row_poli = mysqli_fetch_assoc($query_poli)) {
                                            $selected = $row_poli['id'] == $data_dokter['id_poli'] ? 'selected' : '';
                                            echo "<option value='{$row_poli['id']}' $selected>{$row_poli['nama_poli']}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Password Baru</th>
                                <td>
                                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                                           class="form-control">
                                </td>
                            </tr>
                        </table>
                        <div class="form-group pull-right">
                            <input type="submit" name="edit" value="Simpan Perubahan" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>
