<?php
require_once "_config/config.php";
require "_assets/libs/vendor/autoload.php";

// Cek jika user belum login
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
    exit;
}

// Ambil level pengguna dari sesi
$level = isset($_SESSION['level']) ? $_SESSION['level'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" href="<?= base_url('_assets/medical.png') ?>">
    <title>Medical Center</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url('_assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('_assets/css/bootstrap-theme.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('_assets/css/fontAwesome.css') ?>">
    <link rel="stylesheet" href="<?= base_url('_assets/css/light-box.css') ?>">
    <link rel="stylesheet" href="<?= base_url('_assets/css/templatemo-main.css') ?>">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="<?= base_url('_assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') ?>"></script>
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <ul>
            <li><a href="<?= base_url('dashboard/') ?>"><i class="fa fa-home"></i> <em>Home</em></a></li>

            <?php if ($level == '1') { ?>
                <!-- Menu untuk Admin -->
                <li><a href="<?= base_url('pasien/data.php') ?>"><i class="fa fa-user"></i> <em>Data Pasien</em></a></li>
                <li><a href="<?= base_url('dokter/data.php') ?>"><i class="fa fa-pencil"></i> <em>Data Dokter</em></a></li>
                <li><a href="<?= base_url('poliklinik/data.php') ?>"><i class="fa fa-image"></i> <em>Data Poliklinik</em></a></li>
                <li><a href="<?= base_url('obat/data.php') ?>"><i class="fa fa-cog"></i> <em>Data Obat</em></a></li>

            <?php } elseif ($level == '2') { ?>
                <!-- Menu untuk Dokter -->
                <li><a href="<?= base_url('profil_dokter/edit_dokter.php') ?>"><i class="fa fa-users"></i> <em>Update Profil</em></a></li>
                <li><a href="<?= base_url('jadwal_periksa/data.php') ?>"><i class="fa fa-calendar"></i> <em>Jadwal Periksa</em></a></li>
                <li><a href="<?= base_url('daftar_periksa/data.php') ?>"><i class="fa fa-pencil"></i> <em>Daftar Periksa</em></a></li>
                <li><a href="<?= base_url('riwayat/data.php') ?>"><i class="fa fa-image"></i> <em>Riwayat Periksa</em></a></li>

            <?php } elseif ($level == '3') { ?>
                <!-- Menu untuk Pasien -->
                <li><a href="<?= base_url('daftar_poli/data.php') ?>"><i class="fa fa-calendar"></i> <em>Daftar Poliklinik</em></a></li>

            <?php } ?>

            <li><a href="<?= base_url('auth/logout.php') ?>"><i class="fa fa-sign-out"></i> <em>Logout</em></a></li>
        </ul>
    </nav>