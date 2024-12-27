<?php
require_once "../_config/config.php";  // Pastikan koneksi ke database sudah ada
include_once('../_header.php');

$id = $_GET['id'];  // Ambil ID jadwal dari URL
$sql_jadwal = mysqli_query($con, "SELECT * FROM jadwal_periksa WHERE id = '$id'");
$data_jadwal = mysqli_fetch_assoc($sql_jadwal);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    // Update data ke tabel jadwal_periksa
    $sql = "UPDATE jadwal_periksa SET id_dokter = '$id_dokter', hari = '$hari', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai' WHERE id = '$id'";
    if (mysqli_query($con, $sql)) {
        echo "<script>window.location='data.php';</script>"; // Redirect setelah sukses
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<div class="slides">
    <div class="slide" id="2">
        <div class="content second-content" style="color: white;">
            <h1>Edit Jadwal Periksa</h1>
            <h4>
                <small>Formulir Edit Jadwal</small>
                <div class="pull-right">
                    <a href="data.php" class="btn btn-warning btn-xs">
                        <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                    </a>
                </div>
            </h4>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form action="edit.php?id=<?=$id?>" method="post">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Dokter</th>
                                <td>
                                    <select name="id_dokter" class="form-control" required>
                                        <?php
                                        $query_dokter = mysqli_query($con, "SELECT * FROM dokter");
                                        while ($row_dokter = mysqli_fetch_assoc($query_dokter)) {
                                            $selected = ($row_dokter['id'] == $data_jadwal['id_dokter']) ? 'selected' : '';
                                            echo "<option value='{$row_dokter['id']}' $selected>{$row_dokter['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Hari</th>
                                <td>
                                    <input type="text" name="hari" value="<?=$data_jadwal['hari']?>" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Jam Mulai</th>
                                <td>
                                    <input type="time" name="jam_mulai" value="<?=$data_jadwal['jam_mulai']?>" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Jam Selesai</th>
                                <td>
                                    <input type="time" name="jam_selesai" value="<?=$data_jadwal['jam_selesai']?>" class="form-control" required>
                                </td>
                            </tr>
                        </table>
                        <div class="form-group pull-right">
                            <input type="submit" value="Simpan Perubahan" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>
