<?php
require_once "../_config/config.php";

// Pastikan hanya dokter yang dapat mengakses
if ($_SESSION['level'] !== '2') {
    echo "<script>alert('Akses ditolak!'); window.location='../dashboard';</script>";
    exit;
}

$id_dokter = $_SESSION['id_user']; // Ambil id_dokter dari session

// Cek apakah session id_dokter ada
if (!isset($id_dokter)) {
    die("ID dokter tidak ditemukan di session.");
}

// Query untuk mengambil jadwal periksa
$query_jadwal = mysqli_query($con, "SELECT * FROM jadwal_periksa WHERE id_dokter = '$id_dokter'");

if (!$query_jadwal) {
    die("Query gagal: " . mysqli_error($con));
}

include_once('../_header.php');
?>

<div class="slides">
    <div class="slide" id="2">
        <div class="content second-content" style="color: black;">
            <h1>Jadwal Periksa</h1>
            <h4>
                <small style="color: black;">Data Jadwal Periksa</small>
                <div class="pull-right">
                    <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Jadwal Periksa</a>
                </div>
            </h4>
            <form method="post" name="proses" action="del.php">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="jadwal_periksa" style="color: black;">
                        <thead>
                            <tr>
                                <th>
                                    <center>
                                        <input type="checkbox" id="select_all" value="">
                                    </center>
                                </th>
                                <th><center>No.</center></th>
                                <th><center>Nama Dokter</center></th>
                                <th><center>Hari</center></th>
                                <th><center>Jam Mulai</center></th>
                                <th><center>Jam Selesai</center></th>
                                <th><i class="glyphicon glyphicon-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // Mengambil data jadwal periksa dan relasi dengan dokter
                            $sql_jadwal = mysqli_query($con, "SELECT jadwal_periksa.*, dokter.nama AS nama_dokter FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id") or die(mysqli_error($con));
                            while ($data = mysqli_fetch_array($sql_jadwal)) { 
                            ?>
                                <tr>
                                    <td align="center">
                                        <input type="checkbox" name="checked[]" class="check" value="<?=$data['id']?>">
                                    </td>
                                    <td><?=$no++?>.</td>
                                    <td><?=$data['nama_dokter']?></td>
                                    <td><?=$data['hari']?></td>
                                    <td><?=$data['jam_mulai']?></td>
                                    <td><?=$data['jam_selesai']?></td>
                                    <td align="center">
                                        <a href="edit.php?id=<?=$data['id']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="box pull-right">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
//script multiple checked
$(document).ready(function() {

    $('#jadwal_periksa').DataTable({
        columnDefs: [
            { 
            "searchable": false,
            "orderable": false,
            "target": [0, 6]
            }
        ],
        "order": [1,"asc"]
    });

    $('#select_all').on('click',function(){
        if(this.checked) {
            $('.check').each(function() {
                this.checked = true;
            })
        } else {
            $('.check').each(function() {
                this.checked = false;
            })
        }
    });

    $('.check').on('click', function() {
        if($('.check:checked').length == $('.check').length) {
            $('#select_all').prop('checked',true)
        } else {
            $('#select_all').prop('checked',false)
        }
    })
})
</script>

<?php include_once('../_footer.php'); ?>
