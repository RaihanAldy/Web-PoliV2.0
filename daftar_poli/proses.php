<?php
require_once "../_config/config.php"; // Memasukkan koneksi ke database

// Periksa apakah koneksi berhasil
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mengambil id_pasien dari session
$id_pasien = $_POST['id_pasien']; // Ambil ID pasien dari sesi
$id_poli = $_POST['id_poli'];
$id_dokter = $_POST['id_dokter'];
$id_jadwal = $_POST['id_jadwal'];
$keluhan = mysqli_real_escape_string($con, $_POST['keluhan']); // Menggunakan koneksi untuk escape string

// Periksa apakah id_jadwal valid di tabel jadwal_periksa
$query_jadwal = mysqli_query($con, "SELECT id FROM jadwal_periksa WHERE id = '$id_jadwal'");
if (mysqli_num_rows($query_jadwal) == 0) {
    echo "<script>alert('ID Jadwal tidak valid.');</script>";
    exit;
}

// Dapatkan nomor antrian terakhir
$query_antrian = mysqli_query($con, "SELECT MAX(no_antrian) AS last_antrian 
                                      FROM daftar_poli 
                                      WHERE id_poli = $id_poli AND id_dokter = $id_dokter AND id_jadwal = $id_jadwal");
if ($query_antrian) {
    $data_antrian = mysqli_fetch_assoc($query_antrian);
    $nomor_antrian = $data_antrian['last_antrian'] + 1; // Nomor antrian berikutnya
} else {
    // Tangani jika query gagal
    echo "<script>alert('Gagal mendapatkan nomor antrian.');</script>";
    exit;
}

// Simpan data pendaftaran poli
$insert_daftar_poli = mysqli_query($con, "INSERT INTO daftar_poli (id_pasien, id_poli, id_dokter, id_jadwal, keluhan, no_antrian) 
                                          VALUES ('$id_pasien', '$id_poli', '$id_dokter', '$id_jadwal', '$keluhan', '$nomor_antrian')");

if ($insert_daftar_poli) {
    echo "<script>alert('Pendaftaran berhasil! Nomor Antrian Anda: $nomor_antrian'); window.location='data.php';</script>";
} else {
    echo "<script>alert('Pendaftaran gagal, silakan coba lagi');</script>";
}
?>
