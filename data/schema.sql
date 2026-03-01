-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2026 at 11:16 AM
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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `deskripsi`, `status`) VALUES
(1, 'Asia', 'Paket wisata ke berbagai negara di Asia', 'Aktif'),
(2, 'Domestik', 'Paket wisata dalam negeri Indonesia', 'Aktif'),
(4, 'Catering', 'Siapin paket makan', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `klien_korporasi`
--

CREATE TABLE `klien_korporasi` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_pic` varchar(100) NOT NULL,
  `jabatan_pic` varchar(100) DEFAULT NULL,
  `telepon_pic` varchar(20) NOT NULL,
  `email_pic` varchar(100) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `tanggal_bergabung` date DEFAULT curdate(),
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klien_korporasi`
--

INSERT INTO `klien_korporasi` (`id`, `nama_perusahaan`, `npwp`, `alamat`, `telepon`, `email`, `nama_pic`, `jabatan_pic`, `telepon_pic`, `email_pic`, `status`, `tanggal_bergabung`, `keterangan`) VALUES
(1, 'PT Telkom Indonesia (Persero) Tbk', '09.123.456.7-123.000', 'Jl. Japati No. 1, Bandung, Jawa Barat 40133', '(022) 4521234', 'corporate@telkom.co.id', 'Ahmad Sudirman', 'Manager Travel & Event', '0812-3456-7890', 'ahmad.sudirman@telkom.co.id', 'Aktif', '2025-01-15', 'Partner utama untuk kebutuhan perjalanan dinas karyawan'),
(2, 'Bank Central Asia (BCA)', '01.234.567.8-123.000', 'Menara BCA, Grand Indonesia, Jakarta Pusat 10310', '(021) 23588000', 'procurement@bca.co.id', 'Siti Rahayu', 'VP Corporate Services', '0813-8765-4321', 'siti.rahayu@bca.co.id', 'Aktif', '2025-02-20', 'Kerjasama untuk program reward nasabah premium'),
(3, 'PT Pertamina (Persero)', '01.000.013.1-093.000', 'Jl. Medan Merdeka Timur No. 1A, Jakarta Pusat 10110', '(021) 1500000', 'corporate.travel@pertamina.com', 'Budi Hartono', 'Senior Manager HR', '0811-2233-4455', 'budi.hartono@pertamina.com', 'Aktif', '2025-03-10', 'Paket wisata tahunan untuk karyawan dan keluarga'),
(4, 'Bank Mandiri (Persero) Tbk', '01.123.456.7-123.000', 'Plaza Mandiri, Jl. Jenderal Gatot Subroto Kav. 36-38, Jakarta Selatan', '(021) 52997777', 'travel.services@bankmandiri.co.id', 'Dewi Kusuma', 'Head of Procurement', '0821-9988-7766', 'dewi.kusuma@bankmandiri.co.id', 'Aktif', '2025-04-05', 'Manajemen perjalanan bisnis dan konferensi'),
(5, 'PT Astra International Tbk', '01.222.333.4-123.000', 'Menara Astra, Jl. Sudirman Kav. 5-6, Jakarta Pusat 10220', '(021) 50843888', 'event.management@astra.co.id', 'Rini Susanti', 'Executive Secretary', '0812-9876-5432', 'rini.susanti@astra.co.id', 'Tidak Aktif', '2025-05-12', 'On hold untuk evaluasi kontrak');

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
(5, 9, 6, '2026-02-12 01:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `manajemen_customer`
--

CREATE TABLE `manajemen_customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `handphone` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manajemen_customer`
--

INSERT INTO `manajemen_customer` (`id`, `nama`, `email`, `handphone`, `alamat`) VALUES
(1, 'Fathan Zada Al Attar', 'fathanzda@gmail.com', 2147483647, 'Jl. Driyorejo'),
(8, 'Brendata Najwa Firki Hidayat', 'brenda@gmail.com', 2147483647, 'Jl. Surabaya'),
(9, 'Eddria', 'eddria@gmail.com', 2147483647, 'Jl. Surabaya'),
(11, 'Dummy 1', 'dummy1@gmail.com', 123456789, 'Jl. Dummy'),
(12, 'Dummy 2', 'dummy2@gmail.com', 2147483647, 'Jl. Dummy');

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
(6, 'Tokyo', '4 Hari 3 Malam', 'Tokyo, Jepang', 6749999, 'https://placehold.co/400x300', 'Promo', 5, '2026-02-11 23:54:32'),
(7, 'Bali Paradise Escape', '5 Hari 4 Malam', 'Bali, Indonesia', 4500000, 'https://placehold.co/400x300', 'Hot Deal', 5, '2026-02-26 00:26:08'),
(8, 'Dummy Paket 1', '5 Sore 3 Pagi', 'Bali, Indonesia', 2147483647, 'https://placehold.co/400x300', 'Promo Random', 4, '2026-02-26 00:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `manajemen_pembayaran`
--

CREATE TABLE `manajemen_pembayaran` (
  `id` int(11) NOT NULL,
  `booking` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jumlah` int(11) NOT NULL,
  `metode` enum('cash','transfer bank','qris') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manajemen_pembayaran`
--

INSERT INTO `manajemen_pembayaran` (`id`, `booking`, `tanggal`, `jumlah`, `metode`) VALUES
(4, 'BK001', '0000-00-00 00:00:00', 7500000, 'cash'),
(5, 'BK001', '0000-00-00 00:00:00', 2147483647, ''),
(6, 'BK001', '0000-00-00 00:00:00', 7500000, ''),
(7, 'BK001', '0000-00-00 00:00:00', 4999997, '');

-- --------------------------------------------------------

--
-- Table structure for table `partner_maskapai`
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
-- Dumping data for table `partner_maskapai`
--

INSERT INTO `partner_maskapai` (`id`, `nama_maskapai`, `kode_maskapai`, `negara_asal`, `deskripsi`, `status`) VALUES
(1, 'Garuda Indonesia', 'GA', 'Indonesia', 'Maskapai penerbangan nasional Indonesia dengan jaringan penerbangan domestik dan internasional yang luas.', 'Aktif'),
(2, 'Lion Air', 'JT', 'Indonesia', 'Maskapai penerbangan berbiaya rendah terbesar di Indonesia dengan rute domestik yang sangat luas.', 'Aktif'),
(3, 'Citilink', 'QG', 'Indonesia', 'Anak perusahaan Garuda Indonesia yang beroperasi sebagai maskapai berbiaya rendah.', 'Aktif'),
(4, 'AirAsia', 'QZ', 'Malaysia', 'Maskapai penerbangan berbiaya rendah asal Malaysia dengan jaringan penerbangan Asia yang luas.', 'Aktif'),
(5, 'Singapore Airlines', 'SQ', 'Singapura', 'Maskapai penerbangan premium asal Singapura yang dikenal dengan layanan kelas dunia.', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama_pelanggan`, `pesan`, `rating`, `status`, `tanggal`) VALUES
(1, 'Budi Santoso', 'Pelayanan sangat memuaskan, perjalanan wisata ke Jepang berjalan lancar dan menyenangkan. Tour guide sangat ramah dan berpengalaman.', 5, 'Aktif', '2026-02-15'),
(2, 'Ani Wijaya', 'Paket wisata domestik ke Bali sangat worth it. Hotel yang disediakan bagus dan makanannya enak. Terima kasih CRM Travel!', 5, 'Aktif', '2026-02-20'),
(3, 'Dedi Kurniawan', 'Pengalaman pertama liburan ke luar negeri bersama keluarga. Semua diurus dengan baik dari visa hingga akomodasi. Sangat recommended!', 4, 'Aktif', '2026-02-25'),
(4, 'Brendata', 'Travel bagus sekali bun', 5, 'Aktif', '2026-02-28');

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
  `pw` varchar(100) NOT NULL COMMENT 'password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `handphone`, `alamat`, `pw`) VALUES
(1, 'Admin', 'admin@gmail.com', 2147483647, 'Jl. Smea', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klien_korporasi`
--
ALTER TABLE `klien_korporasi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `partner_maskapai`
--
ALTER TABLE `partner_maskapai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klien_korporasi`
--
ALTER TABLE `klien_korporasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manajemen_booking`
--
ALTER TABLE `manajemen_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manajemen_customer`
--
ALTER TABLE `manajemen_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `manajemen_paket`
--
ALTER TABLE `manajemen_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manajemen_pembayaran`
--
ALTER TABLE `manajemen_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `partner_maskapai`
--
ALTER TABLE `partner_maskapai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
