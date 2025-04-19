-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2025 at 04:53 PM
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

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama_dokumen` varchar(255) DEFAULT NULL,
  `role` enum('admin','pegawai') DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `path` text,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `nip`, `nama_dokumen`, `role`, `bidang`, `path`, `keterangan`) VALUES
(26, '987976AS231', 'ATSCVRobyAkshay.pdf', 'pegawai', 'SDM', '../assetss/img/dokumen/ATSCVRobyAkshay.pdf', '-');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int NOT NULL,
  `nip` varchar(50) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `nip`, `no_hp`, `nama`, `bidang`, `status`, `created_at`) VALUES
(1, '13213343123', '321313134123123', 'seasddad', 'asdasdasd', 'completed', '2025-04-18 16:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `nama`, `password`, `role`, `bidang`, `avatar`, `email`, `token`) VALUES
(12, '987976AS231', 'Roy Martin', '$2y$10$MyeOM62osn6ftrJbv.7L3elJrH0K8VpTBUhTuCMsjfyQ0nnp..KJG', 'pegawai', 'SDM', '', NULL, NULL),
(13, '1234521DFSD123', 'Beki', '$2y$10$xWpEOaELApZao6UcE3psVOmX6x2djGu6lkVzoLXnp8rSavm6EOptO', 'pegawai', 'TL Pelaksana K4', '', NULL, NULL),
(16, '123456', 'Admin', '$2y$10$mbZuXDZhmEwcR78MK9GoHe45o7CsDDoqqvyacDjSLjliIZyEWd8CK', 'admin', 'TI', 'avatar_6803a5af08b2d.png', 'testwebsite723@gmail.com', NULL),
(19, 'HBU21837123', 'Ganjar Pranowo', '$2y$10$g7DpdYJL16Fk0HD.y/5Q.eH5fOetpbnC9CO9WHnR4ADGG1w1I.xqK', 'pegawai', 'TL Pelaksana K4', 'avatar_6803a8b094509.png', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `users` (`nip`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
