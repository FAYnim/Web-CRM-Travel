-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2026 pada 04.00
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
-- Struktur dari tabel `klien_korporasi`
--

CREATE TABLE `klien_korporasi` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_pic` varchar(100) NOT NULL,
  `jabatan_pic` varchar(100) DEFAULT NULL,
  `telepon_pic` varchar(20) NOT NULL,
  `email_pic` varchar(100) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `tanggal_bergabung` date DEFAULT CURRENT_DATE,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `klien_korporasi`
--

INSERT INTO `klien_korporasi` (`id`, `nama_perusahaan`, `alamat`, `telepon`, `email`, `nama_pic`, `jabatan_pic`, `telepon_pic`, `email_pic`, `status`, `tanggal_bergabung`, `keterangan`) VALUES
(1, 'PT Telkom Indonesia (Persero) Tbk', 'Jl. Japati No. 1, Bandung, Jawa Barat 40133', '(022) 4521234', 'corporate@telkom.co.id', 'Ahmad Sudirman', 'Manager Travel & Event', '0812-3456-7890', 'ahmad.sudirman@telkom.co.id', 'Aktif', '2025-01-15', 'Partner utama untuk kebutuhan perjalanan dinas karyawan'),
(2, 'Bank Central Asia (BCA)', 'Menara BCA, Grand Indonesia, Jakarta Pusat 10310', '(021) 23588000', 'procurement@bca.co.id', 'Siti Rahayu', 'VP Corporate Services', '0813-8765-4321', 'siti.rahayu@bca.co.id', 'Aktif', '2025-02-20', 'Kerjasama untuk program reward nasabah premium'),
(3, 'PT Pertamina (Persero)', 'Jl. Medan Merdeka Timur No. 1A, Jakarta Pusat 10110', '(021) 1500000', 'corporate.travel@pertamina.com', 'Budi Hartono', 'Senior Manager HR', '0811-2233-4455', 'budi.hartono@pertamina.com', 'Aktif', '2025-03-10', 'Paket wisata tahunan untuk karyawan dan keluarga'),
(4, 'Bank Mandiri (Persero) Tbk', 'Plaza Mandiri, Jl. Jenderal Gatot Subroto Kav. 36-38, Jakarta Selatan', '(021) 52997777', 'travel.services@bankmandiri.co.id', 'Dewi Kusuma', 'Head of Procurement', '0821-9988-7766', 'dewi.kusuma@bankmandiri.co.id', 'Aktif', '2025-04-05', 'Manajemen perjalanan bisnis dan konferensi'),
(5, 'PT Astra International Tbk', 'Menara Astra, Jl. Sudirman Kav. 5-6, Jakarta Pusat 10220', '(021) 50843888', 'event.management@astra.co.id', 'Rini Susanti', 'Executive Secretary', '0812-9876-5432', 'rini.susanti@astra.co.id', 'Tidak Aktif', '2025-05-12', 'On hold untuk evaluasi kontrak');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `klien_korporasi`
--
ALTER TABLE `klien_korporasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `klien_korporasi`
--
ALTER TABLE `klien_korporasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
