-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
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
-- Struktur dari tabel `partner_maskapai`
--

CREATE TABLE `partner_maskapai` (
  `id` int(11) NOT NULL,
  `nama_maskapai` varchar(100) NOT NULL,
  `kode_maskapai` varchar(10) NOT NULL,
  `negara_asal` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `partner_maskapai`
--

INSERT INTO `partner_maskapai` (`id`, `nama_maskapai`, `kode_maskapai`, `negara_asal`, `deskripsi`, `status`) VALUES
(1, 'Garuda Indonesia', 'GA', 'Indonesia', 'Maskapai penerbangan nasional Indonesia dengan jaringan penerbangan domestik dan internasional yang luas.', 'Aktif'),
(2, 'Lion Air', 'JT', 'Indonesia', 'Maskapai penerbangan berbiaya rendah terbesar di Indonesia dengan rute domestik yang sangat luas.', 'Aktif'),
(3, 'Citilink', 'QG', 'Indonesia', 'Anak perusahaan Garuda Indonesia yang beroperasi sebagai maskapai berbiaya rendah.', 'Aktif'),
(4, 'AirAsia', 'QZ', 'Malaysia', 'Maskapai penerbangan berbiaya rendah asal Malaysia dengan jaringan penerbangan Asia yang luas.', 'Aktif'),
(5, 'Singapore Airlines', 'SQ', 'Singapura', 'Maskapai penerbangan premium asal Singapura yang dikenal dengan layanan kelas dunia.', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `partner_maskapai`
--
ALTER TABLE `partner_maskapai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `partner_maskapai`
--
ALTER TABLE `partner_maskapai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
