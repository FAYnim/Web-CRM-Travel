# SnD Tour Travel — Website Resmi

> **Liburan Pasti Berangkat** — Website profil dan katalog layanan untuk SnD Tour Travel, travel agent terpercaya di Surabaya sejak 2017.

---

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur](#fitur)
- [Struktur Halaman](#struktur-halaman)
- [Teknologi](#teknologi)
- [Instalasi & Menjalankan Lokal](#instalasi--menjalankan-lokal)
- [Konfigurasi Database](#konfigurasi-database)
- [Struktur Folder](#struktur-folder)
- [Kontak Bisnis](#kontak-bisnis)

---

## Tentang Proyek

Website ini adalah company profile sekaligus katalog layanan untuk **SnD Tour Travel**, sebuah travel agent yang berdiri sejak 2017 dan berdomisili di Surabaya, Jawa Timur. Website dibangun menggunakan PHP native dengan koneksi MySQL melalui XAMPP, tanpa framework tambahan.

Website menampilkan seluruh layanan utama perusahaan: paket wisata domestik & Asia, program outbond, layanan catering & event, galeri dokumentasi, dan blog tips perjalanan.

---

## Fitur

| Fitur | Keterangan |
|---|---|
| **Hero Slider** | Slideshow gambar otomatis dengan dot navigation |
| **Search & Filter** | Pencarian paket berdasarkan kategori dan kata kunci |
| **Katalog Paket Wisata** | Filter tab: Semua / Domestik / Asia |
| **Paket Spesial Liburan** | Tahun Baru, Natal, Idul Fitri, Libur Sekolah, Imlek |
| **Kategori Wisata** | Religi, Edukasi, Bulan Madu, Keluarga, Perusahaan, Adventure |
| **Program Outbond** | Team Building, Leadership Training, Fun Games, Adventure Challenge |
| **Layanan Catering** | Nasi Box, Paket Buffet, Coffee Break, Event Organizer |
| **Galeri Foto** | Grid foto dengan lightbox & filter kategori |
| **Blog / Artikel** | Tips Traveling, Fun Facts Destinasi, Panduan Wisata |
| **Testimoni Slider** | Carousel ulasan pelanggan |
| **Formulir Kontak** | Form pesan + info kontak lengkap + peta lokasi |
| **Sticky Header** | Navbar sticky dengan efek scroll + hamburger mobile |
| **Responsive Design** | Tampilan optimal di desktop, tablet, dan mobile |
| **SEO Optimized** | Meta tags lengkap, Open Graph, Twitter Card, Schema.org JSON-LD |
| **Scroll Reveal** | Animasi muncul saat elemen masuk viewport |
| **Counter Animasi** | Angka statistik perusahaan yang dianimasikan saat di-scroll |

---

## Struktur Halaman

```
index.php          → Beranda (Hero, Search, Keunggulan, Paket Terbaru, Blog, Testimoni)
profil.php         → Tentang Kami (Visi, Misi, Tim, Nilai Perusahaan)
paket-wisata.php   → Katalog Paket Wisata (filter Domestik / Asia)
detail-paket.php   → Detail Paket Wisata (itinerary, harga, fasilitas)
outbond.php        → Program Outbond & Team Building
catering.php       → Layanan Catering & Event Organizer
galeri.php         → Galeri Foto Perjalanan
blog.php           → Daftar Artikel & Tips Traveling
blog-detail.php    → Detail Artikel Blog
kontak.php         → Hubungi Kami (form, lokasi, info kontak)
```

---

## Teknologi

| Layer | Teknologi |
|---|---|
| **Backend** | PHP 7+ (native, tanpa framework) |
| **Database** | MySQL via MySQLi |
| **Frontend** | HTML5, CSS3 (custom properties / CSS variables), Vanilla JavaScript (ES6+) |
| **Server** | XAMPP (Apache + MySQL) |
| **Font** | Google Fonts (via preconnect) |
| **Gambar** | Unsplash CDN (untuk demo) |
| **SEO** | Schema.org JSON-LD (TravelAgency, LocalBusiness, ItemList, TouristTrip) |

---

## Instalasi & Menjalankan Lokal

### Prasyarat

- [XAMPP](https://www.apachefriends.org/) versi 7.x atau lebih baru
- PHP 7.4+
- MySQL 5.7+ / MariaDB 10.x

### Langkah-langkah

1. **Clone / salin proyek** ke folder htdocs XAMPP:
   ```
   C:\xampp\htdocs\sekolah\snd-tour\
   ```

2. **Jalankan XAMPP** — aktifkan modul **Apache** dan **MySQL**.

3. **Buat database** di phpMyAdmin:
   - Buka `http://localhost/phpmyadmin`
   - Buat database baru dengan nama: `web_crm_travel`

4. **Import skema** (jika tersedia file `.sql`):
   - Pilih database `web_crm_travel`
   - Klik tab **Import**, pilih file SQL, lalu jalankan

5. **Buka website** di browser:
   ```
   http://localhost/sekolah/snd-tour/
   ```

---

## Konfigurasi Database

File konfigurasi koneksi database: **`config.php`**

```php
<?php
session_start();
$server   = "localhost";
$user     = "root";
$password = "";         // Sesuaikan jika MySQL Anda menggunakan password
$nama_db  = "web_crm_travel";

$koneksi = mysqli_connect($server, $user, $password, $nama_db);
```

> **Catatan:** Ubah nilai `$password` jika instalasi MySQL Anda menggunakan kata sandi.

---

## Struktur Folder

```
snd-tour/
├── index.php           # Beranda
├── profil.php          # Tentang Kami
├── paket-wisata.php    # Katalog paket wisata
├── detail-paket.php    # Detail satu paket
├── outbond.php         # Program outbond
├── catering.php        # Layanan catering & event
├── galeri.php          # Galeri foto
├── blog.php            # Daftar artikel blog
├── blog-detail.php     # Detail artikel
├── kontak.php          # Halaman kontak
├── config.php          # Konfigurasi koneksi database
├── css/
│   └── style.css       # Stylesheet utama (CSS variables, BEM)
├── js/
│   └── main.js         # JavaScript utama (slider, filter, animasi)
└── images/             # Folder aset gambar lokal
```

---

## Kontak Bisnis

| Info | Detail |
|---|---|
| **Perusahaan** | SnD Tour Travel |
| **Slogan** | Liburan Pasti Berangkat |
| **Berdiri** | 2017 |
| **Alamat** | Jl. Raya Darmo No. 123, Surabaya, Jawa Timur 60241 |
| **Telepon / WhatsApp** | +62 812-3456-7890 |
| **Email** | info@sndtour.co.id |
| **Website** | https://sndtour.com |
| **Instagram** | [@sndtour](https://instagram.com/sndtour) |
| **Facebook** | [sndtour](https://facebook.com/sndtour) |
| **Jam Operasional** | Senin–Sabtu, 09.00–17.00 WIB |
