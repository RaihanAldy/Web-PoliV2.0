<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

if (isset($_POST['add'])) {
    // Validate required fields
    if (empty($_POST['nama']) || empty($_POST['kemasan']) || empty($_POST['harga'])) {
        die("All fields are required.");
    }

    // Sanitize inputs
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $kemasan = trim(mysqli_real_escape_string($con, $_POST['kemasan']));
    $harga = trim(mysqli_real_escape_string($con, $_POST['harga']));

    // Insert into database
    $query = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama', '$kemasan', '$harga')";
    mysqli_query($con, $query) or die(mysqli_error($con));

    // Redirect
    echo "<script>window.location='data.php';</script>";
} elseif (isset($_POST['edit'])) {
    // Validate required fields
    if (empty($_POST['id']) || empty($_POST['nama']) || empty($_POST['kemasan']) || empty($_POST['harga'])) {
        die("All fields are required.");
    }

    // Sanitize inputs
    $id = trim(mysqli_real_escape_string($con, $_POST['id']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $kemasan = trim(mysqli_real_escape_string($con, $_POST['kemasan']));
    $harga = trim(mysqli_real_escape_string($con, $_POST['harga']));

    // Update the database
    $query = "UPDATE obat SET nama_obat = '$nama', kemasan = '$kemasan', harga = '$harga' WHERE id = '$id'";
    mysqli_query($con, $query) or die(mysqli_error($con));

    // Redirect
    echo "<script>window.location='data.php';</script>";
}

?>