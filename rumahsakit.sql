-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk rumahsakit
CREATE DATABASE IF NOT EXISTS `rumahsakit` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rumahsakit`;

-- membuang struktur untuk table rumahsakit.daftar_poli
CREATE TABLE IF NOT EXISTS `daftar_poli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pasien` int NOT NULL,
  `id_poli` int NOT NULL,
  `id_dokter` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_daftar_poli_jadwal_periksa` (`id_jadwal`),
  KEY `FK_daftar_poli` (`id_poli`),
  KEY `FK_daftar_poli_dokter` (`id_dokter`),
  KEY `FK_daftar_poli_pasien` (`id_pasien`),
  CONSTRAINT `FK_daftar_poli` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`),
  CONSTRAINT `FK_daftar_poli_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`),
  CONSTRAINT `FK_daftar_poli_jadwal_periksa` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`),
  CONSTRAINT `FK_daftar_poli_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.daftar_poli: ~4 rows (lebih kurang)
INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_poli`, `id_dokter`, `id_jadwal`, `keluhan`, `no_antrian`) VALUES
	(2, 1, 1, 1, 1, 'Sakit Tipes', 1),
	(4, 2, 2, 3, 2, 'Flu', 2),
	(5, 3, 1, 1, 2, 'Anemia / Kurang Darah', 3),
	(7, 4, 2, 3, 2, 'Batuk Berdahak', 5);

-- membuang struktur untuk table rumahsakit.detail_periksa
CREATE TABLE IF NOT EXISTS `detail_periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_periksa` int NOT NULL,
  `id_obat` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detail_periksa_periksa` (`id_periksa`),
  KEY `FK_detail_periksa_obat` (`id_obat`),
  CONSTRAINT `FK_detail_periksa_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  CONSTRAINT `FK_detail_periksa_periksa` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.detail_periksa: ~2 rows (lebih kurang)
INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
	(5, 1, 2),
	(6, 1, 3),
	(7, 4, 3),
	(8, 4, 4);

-- membuang struktur untuk table rumahsakit.dokter
CREATE TABLE IF NOT EXISTS `dokter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` int unsigned NOT NULL,
  `id_poli` int NOT NULL,
  `id_user` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_dokter_poli` (`id_poli`),
  KEY `FK_dokter_tb_user` (`id_user`),
  CONSTRAINT `FK_dokter_poli` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`),
  CONSTRAINT `FK_dokter_tb_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.dokter: ~1 rows (lebih kurang)
INSERT INTO `dokter` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`, `id_user`) VALUES
	(1, 'Dr.Mcd', 'Binjai Utara', 845634642, 3, 4),
	(3, 'Dr.KFC', 'Bandung', 45523523, 1, 5);

-- membuang struktur untuk table rumahsakit.jadwal_periksa
CREATE TABLE IF NOT EXISTS `jadwal_periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_dokter` int NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jadwal_periksa_dokter` (`id_dokter`),
  CONSTRAINT `FK_jadwal_periksa_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.jadwal_periksa: ~3 rows (lebih kurang)
INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
	(1, 1, 'Selasa', '12:45:00', '16:00:00'),
	(2, 3, 'Jumat', '18:00:00', '21:00:00'),
	(6, 3, 'Senin', '14:10:00', '15:50:00');

-- membuang struktur untuk table rumahsakit.obat
CREATE TABLE IF NOT EXISTS `obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) DEFAULT NULL,
  `harga` int unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.obat: ~7 rows (lebih kurang)
INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
	(1, 'Big Mac', 'pieces', 35000),
	(2, 'Paracetamol', 'kaplet', 26000),
	(3, 'Bodrex', 'tablet', 3500),
	(4, 'Acarbose', 'Tablet, Kapsul', 5000),
	(5, 'Albumin', 'Obat infus', 10000),
	(6, 'Bacitracin', 'Suntik', 15000),
	(7, 'Diazepam', 'Tablet, Obat cair, Suntikan', 12000),
	(8, 'Captopril', 'Tablet', 52000);

-- membuang struktur untuk table rumahsakit.pasien
CREATE TABLE IF NOT EXISTS `pasien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `no_ktp` int NOT NULL,
  `no_hp` int NOT NULL,
  `no_rm` char(10) DEFAULT NULL,
  `id_user` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_pasien_tb_user` (`id_user`),
  CONSTRAINT `FK_pasien_tb_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.pasien: ~3 rows (lebih kurang)
INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`, `id_user`) VALUES
	(1, 'Sasuke', 'Jl. mataram uhuy no 90, Solo', 42142145, 1731263789, '4', 6),
	(2, 'Agus', 'Surabaya', 32456778, 455574534, '3', 7),
	(3, 'Nur', 'malang', 4244256, 3213124, '4', 8),
	(4, 'Han', 'Semarang', 425351, 4212425, '5', 9);

-- membuang struktur untuk table rumahsakit.periksa
CREATE TABLE IF NOT EXISTS `periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_daftar_poli` int NOT NULL,
  `tgl_periksa` date NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int DEFAULT '150000',
  PRIMARY KEY (`id`),
  KEY `FK_periksa_daftar_poli` (`id_daftar_poli`),
  CONSTRAINT `FK_periksa_daftar_poli` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.periksa: ~2 rows (lebih kurang)
INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
	(1, 4, '2024-12-04', 'Istirahat aja yang cukup', 179500),
	(4, 7, '2024-12-17', 'MInum Obat', 158500);

-- membuang struktur untuk table rumahsakit.poli
CREATE TABLE IF NOT EXISTS `poli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_poli` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.poli: ~2 rows (lebih kurang)
INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
	(1, 'Harapan Bundo', 'Jalan Serambi kanan usus no 13'),
	(2, 'Sari Rasa', 'Jalan Pankreas timur no 2'),
	(3, 'Sederhana', 'Jalan Paru basah no 2');

-- membuang struktur untuk table rumahsakit.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '3',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rumahsakit.tb_user: ~6 rows (lebih kurang)
INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
	(3, 'Wajahasli', 'admin', '8cb2237d0679ca88db6464eac60da96345513964', '1'),
	(4, 'Dr.Mcd', 'dokter1', 'ae285bc5b17d074a8c31b74aec572f45a280a419', '2'),
	(5, 'Dr.KFC', 'dokter2', '2a2e21d434356f886c84371eebac6e44f1337fda', '2'),
	(6, 'Sasuke', 'pasien1', 'ee9e3307d98c01699b4aa24e429a3725d79e19e1', '3'),
	(7, 'agus', 'pasien2', '0525885565bb6a150db63f19bf42f11bd2db4702', '3'),
	(8, 'nur', 'pasien3', '2216b5374d8580c2617ded023d58277bc1c5c686', '3'),
	(9, 'han', 'pasien4', '4ff615253469989932532e926006ae5c995e5dd6', '3');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
