<?php
require_once "../_config/config.php";  // Pastikan koneksi ke database sudah ada
include_once('../_header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    // Insert data ke tabel jadwal_periksa
    $sql = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai)
            VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')";
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
            <h1>Tambah Jadwal Periksa</h1>
            <h4>
                <small>Formulir Penambahan Jadwal</small>
                <div class="pull-right">
                    <a href="data.php" class="btn btn-warning btn-xs">
                        <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                    </a>
                </div>
            </h4>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form action="add.php" method="post">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Dokter</th>
                                <td>
                                    <select name="id_dokter" class="form-control" required>
                                        <?php
                                        $query_dokter = mysqli_query($con, "SELECT * FROM dokter");
                                        while ($row_dokter = mysqli_fetch_assoc($query_dokter)) {
                                            echo "<option value='{$row_dokter['id']}'>{$row_dokter['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Hari</th>
                                <td>
                                    <input type="text" name="hari" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Jam Mulai</th>
                                <td>
                                    <input type="time" name="jam_mulai" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Jam Selesai</th>
                                <td>
                                    <input type="time" name="jam_selesai" class="form-control" required>
                                </td>
                            </tr>
                        </table>
                        <div class="form-group pull-right">
                            <input type="submit" value="Simpan Jadwal" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>
