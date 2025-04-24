-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2025 at 03:43 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_pln`
--

-- --------------------------------------------------------

-- Table structure for table `dokumen`
CREATE TABLE `dokumen` (
  `id` int NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama_dokumen` varchar(255) DEFAULT NULL,
  `role` enum('admin','pegawai') DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `path` text,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `dokumen`
INSERT INTO `dokumen` (`id`, `nip`, `nama_dokumen`, `role`, `bidang`, `path`, `keterangan`) VALUES
(26, '987976AS231', 'ATSCVRobyAkshay.pdf', 'pegawai', 'SDM', '../assetss/img/dokumen/ATSCVRobyAkshay.pdf', '-'),
(27, '1234521DFSD123', 'avatar_6803a8677fa5a.png', 'pegawai', 'TL Pelaksana K4', '../assetss/img/dokumen/avatar_6803a8677fa5a.png', '-'),
(28, 'HBU21837123', '4.png', 'pegawai', 'TL Pelaksana K4', '../assetss/img/dokumen/4.png', '-');

-- --------------------------------------------------------

-- Table structure for table `log_dokumen`
CREATE TABLE `log_dokumen` (
  `id` int NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `aksi` enum('lihat','download') NOT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `log_dokumen`
INSERT INTO `log_dokumen` (`id`, `nip`, `nama_dokumen`, `aksi`, `waktu`) VALUES
(1, '1234521DFSD123', 'ATSCVRobyAkshay.pdf', 'lihat', '2025-04-23 20:29:57'),
(2, '1234521DFSD123', 'ATSCVRobyAkshay.pdf', 'lihat', '2025-04-23 21:00:42'),
(3, '1234521DFSD123', 'avatar_6803a8677fa5a.png', 'lihat', '2025-04-23 21:01:31'),
(4, '123456', 'avatar_6803a8677fa5a.png', 'lihat', '2025-04-23 21:07:26'),
(5, '1234521DFSD123', 'avatar_6803a8677fa5a.png', 'lihat', '2025-04-23 21:10:02'),
(6, '1234521DFSD123', 'ATSCVRobyAkshay.pdf', 'lihat', '2025-04-23 21:10:10'),
(7, '123456', 'ATSCVRobyAkshay.pdf', 'lihat', '2025-04-23 21:34:30');

-- --------------------------------------------------------

-- Table structure for table `reset_password`
CREATE TABLE `reset_password` (
  `id` int NOT NULL,
  `nip` varchar(50) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `reset_password`
INSERT INTO `reset_password` (`id`, `nip`, `no_hp`, `nama`, `bidang`, `status`, `created_at`) VALUES
(15, '123345', '09876543234', 'Gcor Bang', 'TL Gacor', 'completed', '2025-04-23 14:36:19');

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pegawai') NOT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `nip`, `nama`, `password`, `role`, `bidang`, `avatar`, `email`, `token`) VALUES
(12, '987976AS231', 'Roy Martin', '$2y$10$MyeOM62osn6ftrJbv.7L3elJrH0K8VpTBUhTuCMsjfyQ0nnp..KJG', 'pegawai', 'SDM', 'avatar_6805cf0863109.png', NULL, NULL),
(13, '1234521DFSD123', 'Beki', '$2y$10$xWpEOaELApZao6UcE3psVOmX6x2djGu6lkVzoLXnp8rSavm6EOptO', 'pegawai', 'TL Pelaksana K4', 'avatar_6808e8aec3e81.png', NULL, NULL),
(16, '123456', 'Admin', '$2y$10$mbZuXDZhmEwcR78MK9GoHe45o7CsDDoqqvyacDjSLjliIZyEWd8CK', 'admin', 'TI', 'avatar_6808fb3100e36.png', 'testwebsite723@gmail.com', NULL),
(19, 'HBU21837123', 'Ganjar Pranowo', '$2y$10$g7DpdYJL16Fk0HD.y/5Q.eH5fOetpbnC9CO9WHnR4ADGG1w1I.xqK', 'pegawai', 'TL Pelaksana K4', 'avatar_6803a8b094509.png', NULL, NULL);

-- Indexes
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_dokumen` (`nama_dokumen`),
  ADD KEY `nip` (`nip`);

ALTER TABLE `log_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nama_dokumen` (`nama_dokumen`);

ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

-- AUTO_INCREMENT
ALTER TABLE `dokumen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

ALTER TABLE `log_dokumen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `reset_password`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

-- Foreign Keys
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `users` (`nip`) ON DELETE CASCADE;

ALTER TABLE `log_dokumen`
  ADD CONSTRAINT `log_dokumen_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `users` (`nip`),
  ADD CONSTRAINT `log_dokumen_ibfk_2` FOREIGN KEY (`nama_dokumen`) REFERENCES `dokumen` (`nama_dokumen`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
