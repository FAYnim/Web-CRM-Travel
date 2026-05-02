# Web CRM Travel

CRM dan Sistem Manajemen Konten (CMS) untuk Agen Perjalanan, dibangun dengan PHP native dan MySQL. Menyediakan situs utama publik bagi pelanggan untuk menelusuri paket wisata, melihat galeri, dan mengakses informasi perusahaan/kontak, beserta dasbor administratif untuk mengelola konten, pemesanan, pelanggan, dan pembayaran.

## ✨ Fitur

### Situs Web Publik
- **Katalog Paket Wisata**: Jelajahi paket wisata, aktivitas outbound, dan layanan katering yang tersedia.
- **Halaman Galeri**: Lihat dokumentasi foto perjalanan dan aktivitas.
- **Profil Perusahaan & Kontak**: Informasi tentang agen perjalanan dengan CTA WhatsApp dan Email.
- **Desain Responsif**: CSS kustom dan Vanilla JS untuk pengalaman yang lancar di berbagai perangkat.

### Dasbor Admin
- **Manajemen Konten**: Kelola paket wisata, galeri, testimoni, kategori, dan mitra/klien perusahaan.
- **CRM Pemesanan & Pelanggan**: Lacak pemesanan pelanggan dengan fitur **tanggal keberangkatan**, kelola data pelanggan yang dioptimalkan, dan catat serta pantau **status pembayaran** (Lunas/Belum Bayar).
- **Pengaturan Perusahaan**: Perbarui informasi profil perusahaan dan branding langsung dari dasbor.
- **Analitik Dasbor**: Lihat statistik utama seperti total pemesanan, pendapatan, dan aktivitas terbaru secara ringkas.

## 🚀 Tech Stack (Teknologi yang Digunakan)

- **Backend**: PHP 8.x
- **Database**: MySQL / MariaDB
- **Frontend (Publik)**: HTML5, CSS Kustom, Vanilla JS
- **Frontend (Admin)**: Bootstrap 5, Bootstrap Icons
- **Arsitektur**: Skrip PHP native dengan endpoint API kustom untuk operasi CRUD. Tanpa framework berat (Tidak menggunakan Node.js, Laravel, atau Symfony).

## 📋 Prasyarat

Untuk menjalankan proyek ini secara lokal, Anda memerlukan:
- Stack server web lokal seperti **XAMPP**, WAMP, atau MAMP (Apache/Nginx + PHP 8.x + MySQL/MariaDB).
- Pengetahuan dasar tentang phpMyAdmin atau MySQL CLI.

## 🛠️ Persiapan & Instalasi Lokal

1. **Klon atau Ekstrak Proyek**
   Tempatkan folder proyek di dalam document root server web Anda.
   - Untuk XAMPP (Windows): `C:\xampp\htdocs\sekolah\web-crm-travel`
   - Untuk Linux/Mac: `/var/www/html/web-crm-travel`

2. **Persiapan Database**
   - Buka alat manajemen MySQL Anda (misalnya, phpMyAdmin atau CLI).
   - Buat database baru bernama `web_crm_travel`.
   - Impor skema SQL dan data dummy yang disediakan dari:
     ```text
     dashboard/data/schema.sql
     ```

3. **Konfigurasi Koneksi Database**
   Buka `config.php` di root proyek dan perbarui kredensial jika berbeda dengan pengaturan lokal Anda:
   ```php
   $server = "localhost";
   $user = "root";
   $password = ""; // Kata sandi MySQL Anda
   $database = "web_crm_travel";
   ```

4. **Izin Direktori (Permissions)**
   Pastikan direktori `dashboard/uploads/` dapat ditulis (writable) oleh server web Anda agar upload gambar berfungsi dengan baik.

5. **Jalankan Aplikasi**
   Jalankan server web dan layanan MySQL Anda, lalu buka browser:
   - **Situs Publik**: `http://localhost/sekolah/web-crm-travel/index.php`
   - **Dasbor Admin**: `http://localhost/sekolah/web-crm-travel/dashboard/login.php`

## 🔐 Kredensial Admin Default

Gunakan kredensial berikut untuk mengakses dasbor admin (diimpor dari dump SQL):

- **Email**: `admin@gmail.com`
- **Kata Sandi**: `123`

> [!WARNING]
> **Catatan Keamanan**: Ini adalah kredensial default dengan kata sandi teks biasa (plain-text). Pastikan Anda mengubah kata sandi dan menerapkan hashing kata sandi yang tepat (misalnya, `password_hash()` dan `password_verify()`) sebelum melakukan deployment ke lingkungan produksi.

## 📁 Struktur Direktori

```text
web-crm-travel/
├── config.php                # Koneksi database dan konfigurasi sesi
├── index.php                 # Halaman utama situs publik (landing page)
├── css/ & js/                # Aset frontend publik (CSS Kustom & Vanilla JS)
├── *.php                     # Halaman publik lainnya (detail-paket.php, galeri.php, dll.)
└── dashboard/                # Panel Admin
    ├── index.php             # Halaman utama dasbor admin
    ├── login.php             # Autentikasi admin
    ├── sidebar.php           # Menu navigasi admin
    ├── data/                 # Berisi schema.sql (Ekspor database)
    ├── src/                  # Aset admin dan API
    │   ├── css/              # Styling admin (berbasis Bootstrap)
    │   └── api/              # Skrip PHP yang menangani operasi CRUD (submit-*, process-login.php)
    └── uploads/              # Direktori untuk gambar/media yang diunggah pengguna
```

## ⚠️ Catatan Penting untuk Produksi

Jika Anda berencana untuk men-deploy aplikasi ini ke server publik (live), harap pertimbangkan peningkatan keamanan berikut:
1. **Hashing Kata Sandi**: Saat ini, kata sandi disimpan dalam teks biasa. Perbarui tabel `user` dan `process-login.php` untuk menggunakan hashing kata sandi PHP yang aman.
2. **Pencegahan SQL Injection**: Skrip API saat ini mungkin menggabungkan input pengguna secara langsung ke dalam query SQL. Refactor bagian ini untuk menggunakan **Prepared Statements** (via `mysqli_prepare` atau PDO).
3. **Keamanan Upload**: Validasi ekstensi file dan tipe MIME pada skrip upload (misalnya, `submit-manajemen-galeri.php`) untuk mencegah eksekusi file berbahaya.
