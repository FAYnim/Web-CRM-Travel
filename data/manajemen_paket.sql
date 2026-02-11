-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Feb 2026 pada 03.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

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
-- Struktur dari tabel `manajemen_paket`
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
-- Dumping data untuk tabel `manajemen_paket`
--

INSERT INTO `manajemen_paket` (`id`, `nama_paket`, `durasi`, `lokasi`, `harga`, `gambar`, `label`, `rating`, `created_at`) VALUES
(5, 'Bali Paradise Escape', '5 Hari 4 Malam', 'Bali, Indonesia', 4500000, 'https://www.upload.ee/image/19065107/bali_paradise.jpg', 'Promo', 5, '2026-02-11 02:00:32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `manajemen_paket`
--
ALTER TABLE `manajemen_paket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `manajemen_paket`
--
ALTER TABLE `manajemen_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
