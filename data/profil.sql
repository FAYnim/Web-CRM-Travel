-- Tabel untuk menyimpan profil perusahaan
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `alamat` text NOT NULL,
  `tentang_kami` text NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data default
INSERT INTO `profil` (`id`, `nama_perusahaan`, `email`, `telepon`, `whatsapp`, `alamat`, `tentang_kami`, `facebook`, `instagram`, `twitter`, `youtube`, `linkedin`) 
VALUES (1, 'CRM Travel', 'info@crmtravel.com', '021-1234567', '08123456789', 'Jl. Contoh No. 123, Jakarta', 'CRM Travel adalah perusahaan travel terpercaya yang melayani berbagai paket wisata domestik dan internasional.', '', '', '', '', '')
ON DUPLICATE KEY UPDATE `id`=`id`;
