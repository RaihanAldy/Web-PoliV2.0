<?php
require_once "../_config/config.php";

if (isset($_POST['edit'])) {
    $id_dokter = $_SESSION['id_user']; // ID dokter dari sesi
    $nama = mysqli_real_escape_string($con, $_POST['id_nama']); // Nama dokter
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']); // Alamat dokter
    $id_poli = mysqli_real_escape_string($con, $_POST['id_poli']); // ID Poli
    $password = $_POST['password']; // Password baru (jika ada)

    // Cek apakah password kosong, jika tidak, hash password baru
    if (!empty($password)) {
        $password = sha1($password);
        $query = "UPDATE dokter SET nama = '$nama', alamat = '$alamat', id_poli = '$id_poli', password = '$password' WHERE id = '$id_dokter'";
    } else {
        // Jika password kosong, jangan update password
        $query = "UPDATE dokter SET nama = '$nama', alamat = '$alamat', id_poli = '$id_poli' WHERE id = '$id_dokter'";
    }

    // Eksekusi query
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='../dashboard';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil!'); window.location='edit_dokter.php';</script>";
    }
}
?>
