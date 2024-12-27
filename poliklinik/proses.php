<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if (isset($_POST['add'])) {
	$total = $_POST['total']; 
	$stmt = $con->prepare("INSERT INTO poli (nama_poli, keterangan) VALUES (?, ?)");
	for ($i = 1; $i <= $total; $i++) {
		$nama = trim($_POST['nama-' . $i] ?? '');
		$ket = trim($_POST['keterangan-' . $i] ?? '');
		
		if (!$nama || !$ket) {
			die("Missing data for entry $i. Please check your inputs.");
		}
	
		$stmt->bind_param("ss", $nama, $ket);
		$stmt->execute();
	}
	
	$stmt->close();
	echo "<script>alert('Data berhasil ditambahkan!'); window.location='data.php';</script>";
} elseif (isset($_POST['edit'])) {
    $stmt = $con->prepare("UPDATE poli SET nama_poli = ?, keterangan = ? WHERE id = ?");
    
    foreach ($_POST['id'] as $index => $id) {
        $nama = $_POST['nama'][$index];
        $ket = $_POST['keterangan'][$index];
        $stmt->bind_param("sss", $nama, $ket, $id);
        $stmt->execute();
    }
    $stmt->close();
    
    echo "<script>alert('Data berhasil di update'); window.location='data.php';</script>";
}
?>