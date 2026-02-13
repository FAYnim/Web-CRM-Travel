-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2026 at 01:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_crm_travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `manajemen_booking`
--

CREATE TABLE `manajemen_booking` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `paket_id` int(11) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manajemen_booking`
--

INSERT INTO `manajemen_booking` (`id`, `customer_id`, `paket_id`, `tanggal`) VALUES
(3, 8, 5, '2026-02-11 21:56:04'),
(4, 1, 5, '2026-02-11 21:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `manajemen_customer`
--

CREATE TABLE `manajemen_customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `handphone` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manajemen_customer`
--

INSERT INTO `manajemen_customer` (`id`, `nama`, `email`, `handphone`, `alamat`) VALUES
(1, 'Dummy User 1', 'johndoe@gmail.com', 0821497971, 'Jl. Driyorejo'),
(8, 'Dummy User 2', 'janedoe@gmail.com', 0824107251, 'Jl. Kemang Raya');

-- --------------------------------------------------------

--
-- Table structure for table `manajemen_paket`
--

CREATE TABLE `manajemen_paket` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(120) NOT NULL,
  `durasi` varchar(60) NOT NULL,
  `lokasi` varchar(120) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `label` varchar(50) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manajemen_paket`
--

INSERT INTO `manajemen_paket` (`id`, `nama_paket`, `durasi`, `lokasi`, `harga`, `gambar`, `label`, `rating`, `created_at`) VALUES
(6, 'Tokyo', '4 Hari 3 Malam', 'Tokyo, Jepang', 6749999, 'https://placehold.co/400x300', 'Promo', 5, '2026-02-11 23:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `manajemen_pembayaran`
--

CREATE TABLE `manajemen_pembayaran` (
  `id` int(11) NOT NULL,
  `booking` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jumlah` int(11) NOT NULL,
  `metode` enum('cash','transfer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manajemen_pembayaran`
--

INSERT INTO `manajemen_pembayaran` (`id`, `booking`, `tanggal`, `jumlah`, `metode`) VALUES
(2, 'BK001', '0000-00-00 00:00:00', 50, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `handphone` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manajemen_booking`
--
ALTER TABLE `manajemen_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manajemen_customer`
--
ALTER TABLE `manajemen_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manajemen_paket`
--
ALTER TABLE `manajemen_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manajemen_pembayaran`
--
ALTER TABLE `manajemen_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manajemen_booking`
--
ALTER TABLE `manajemen_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manajemen_customer`
--
ALTER TABLE `manajemen_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manajemen_paket`
--
ALTER TABLE `manajemen_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manajemen_pembayaran`
--
ALTER TABLE `manajemen_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
