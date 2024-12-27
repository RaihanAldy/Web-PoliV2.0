<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

if (isset($_POST['add'])) {
    // Handle input and sanitize data
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    
    // Ensure no_ktp and no_hp are numeric (phone numbers and ID numbers may be treated as strings)
    $no_ktp = isset($_POST['no_ktp']) && is_numeric($_POST['no_ktp']) ? $_POST['no_ktp'] : '';
    $no_hp = isset($_POST['no_hp']) && is_numeric($_POST['no_hp']) ? $_POST['no_hp'] : '';
    $no_rm = isset($_POST['no_rm']) ? mysqli_real_escape_string($con, $_POST['no_rm']) : '';
    $id_user = isset($_POST['id_user']) ? mysqli_real_escape_string($con, $_POST['id_user']) : ''; // Adding id_user

    // Insert data into pasien table (id is auto-increment, no need to include it)
    $sql = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm, id_user) 
            VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp', '$no_rm', '$id_user')";
    
    if (mysqli_query($con, $sql)) {
        echo "<script>window.location='data.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }

} else if (isset($_POST['edit'])) {
    // Get ID from URL (use $_GET['id'])
    $id = $_GET['id'];
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $ktp = mysqli_real_escape_string($con, $_POST['ktp']);
    $telp = mysqli_real_escape_string($con, $_POST['telp']);
    $rm = mysqli_real_escape_string($con, $_POST['rm']);
    $id_user = mysqli_real_escape_string($con, $_POST['id_user']); // Adding id_user to update

    // Update data in pasien table
    $sql = "UPDATE pasien SET nama = '$nama', alamat = '$alamat', no_ktp = '$ktp', 
            no_hp = '$telp', no_rm = '$rm', id_user = '$id_user' WHERE id = '$id'";

    if (mysqli_query($con, $sql)) {
        echo "<script>window.location='data.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
