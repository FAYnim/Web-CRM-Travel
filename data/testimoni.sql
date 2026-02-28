-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2026 pada 03.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `tanggal` date DEFAULT CURRENT_DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama_pelanggan`, `pesan`, `rating`, `status`, `tanggal`) VALUES
(1, 'Budi Santoso', 'Pelayanan sangat memuaskan, perjalanan wisata ke Jepang berjalan lancar dan menyenangkan. Tour guide sangat ramah dan berpengalaman.', 5, 'Aktif', '2026-02-15'),
(2, 'Ani Wijaya', 'Paket wisata domestik ke Bali sangat worth it. Hotel yang disediakan bagus dan makanannya enak. Terima kasih CRM Travel!', 5, 'Aktif', '2026-02-20'),
(3, 'Dedi Kurniawan', 'Pengalaman pertama liburan ke luar negeri bersama keluarga. Semua diurus dengan baik dari visa hingga akomodasi. Sangat recommended!', 4, 'Aktif', '2026-02-25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
