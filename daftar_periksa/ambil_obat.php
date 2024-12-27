<?php
// Koneksi database
require_once "../_config/config.php";

// Ambil data obat untuk autocomplete
$query_obat = mysqli_query($con, "SELECT id, nama_obat, harga FROM obat");
$obat = [];
while ($row_obat = mysqli_fetch_assoc($query_obat)) {
    $obat[] = $row_obat;
}

// Kembalikan dalam format JSON
echo json_encode($obat);
?>
