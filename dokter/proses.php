<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";



if(isset($_POST['add'])) {
    // Sanitize and get form data
    $nama = trim(mysqli_real_escape_string($con,$_POST['nama']));
    $id_poli = trim(mysqli_real_escape_string($con,$_POST['id_poli']));
    $alamat = trim(mysqli_real_escape_string($con,$_POST['alamat']));
    $no_hp = trim(mysqli_real_escape_string($con,$_POST['no_hp']));
    $id_user = trim(mysqli_real_escape_string($con,$_POST['id_user']));

    // Insert data into the dokter table
    mysqli_query($con, "INSERT INTO dokter(nama, id_poli, alamat, no_hp, id_user) VALUES ( '$nama', '$id_poli', '$alamat', '$no_hp', '$id_user')") 
        or die(mysqli_error($con));

    // Redirect
    echo "<script>window.location='data.php';</script>";
} elseif(isset($_POST['edit'])) {
    // Sanitize and get form data
    $id = $_POST['id'];
    $nama = trim(mysqli_real_escape_string($con,$_POST['nama']));
    $id_poli = trim(mysqli_real_escape_string($con,$_POST['id_poli']));
    $alamat = trim(mysqli_real_escape_string($con,$_POST['alamat']));
    $no_hp = trim(mysqli_real_escape_string($con,$_POST['no_hp']));
    $id_user = trim(mysqli_real_escape_string($con,$_POST['id_user']));

    // Update data in the dokter table
    mysqli_query($con, "UPDATE dokter SET nama = '$nama', id_poli = '$id_poli', alamat = '$alamat', no_hp = '$no_hp', id_user = '$id_user' WHERE id = '$id'")
        or die(mysqli_error($con));

    // Redirect
    echo "<script>window.location='data.php';</script>";
}
?>
