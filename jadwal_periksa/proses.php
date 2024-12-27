<?php
require_once "../_config/config.php";

// Tambah jadwal
if (isset($_POST['add'])) {
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    // Query untuk menambah data jadwal
    mysqli_query($con, "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')")
        or die(mysqli_error($con));

    header('Location: data.php');
    exit;
}

// Edit jadwal
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    // Query untuk memperbarui data jadwal
    mysqli_query($con, "UPDATE jadwal_periksa SET id_dokter = '$id_dokter', hari = '$hari', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai' WHERE id = '$id'")
        or die(mysqli_error($con));

    header('Location: data.php');
    exit;
}
?>
