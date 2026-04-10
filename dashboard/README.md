# CRM Travel Dashboard

Panel admin CRM berbasis PHP + MySQL untuk operasional travel: kelola customer, booking, paket wisata, pembayaran, konten landing page, partner, dan klien korporasi dalam satu dashboard.

> [!NOTE]
> Proyek ini menggunakan URL tanpa ekstensi `.php` via aturan Apache rewrite di `.htaccess`.

## Fitur Utama

- Dashboard ringkasan (total customer, booking, paket, pendapatan, data terbaru)
- Manajemen data customer, booking, paket wisata, dan pembayaran
- Manajemen konten landing page: kategori, galeri, testimoni
- Manajemen relasi bisnis: partner maskapai dan klien korporasi
- Pengaturan profil perusahaan (kontak, deskripsi, media sosial)
- Upload gambar untuk paket wisata dan galeri ke folder `uploads/`
- Login admin berbasis session

## Tech Stack

- PHP (native)
- MySQL / MariaDB
- Apache (`mod_rewrite`)
- Bootstrap 5 + Bootstrap Icons
- CSS kustom (`src/css/dashboard.css`, `src/css/login.css`)

## Struktur Proyek

```text
.
|-- index.php
|-- login.php
|-- sidebar.php
|-- manajemen-*.php
|-- data-manajemen-*.php
|-- edit-manajemen-*.php
|-- setting-profil.php
|-- config.php
|-- .htaccess
|-- data/
|   `-- schema.sql
|-- src/
|   |-- api/
|   |   |-- process-login.php
|   |   |-- submit-*.php
|   |   |-- update-*.php
|   |   `-- hapus-*.php
|   `-- css/
|       |-- dashboard.css
|       `-- login.css
`-- uploads/
```

## Prasyarat

- XAMPP (Apache + MySQL/MariaDB)
- PHP 8.x direkomendasikan
- Browser modern

> [!IMPORTANT]
> Pastikan Apache mengizinkan `.htaccess` (`AllowOverride All`) dan modul `rewrite` aktif.

## Menjalankan Secara Lokal

1. Letakkan proyek di direktori web server (contoh: `c:/xampp/htdocs/sekolah/web-crm-travel/dashboard`).
2. Jalankan `Apache` dan `MySQL` dari XAMPP.
3. Buat database baru dengan nama `web_crm_travel`.
4. Import file `data/schema.sql` ke database tersebut.
5. Sesuaikan koneksi DB di `config.php` bila diperlukan.
6. Akses aplikasi melalui browser:
   - `http://localhost/sekolah/web-crm-travel/dashboard/login`

## Konfigurasi Database

Default konfigurasi ada di `config.php`:

- Host: `localhost`
- User: `root`
- Password: *(kosong)*
- Database: `web_crm_travel`

Jika environment Anda berbeda, ubah nilainya sesuai konfigurasi lokal.

## Akun Login Default

Data awal pada `data/schema.sql` menyertakan user admin berikut:

- Email: `admin@gmail.com`
- Password: `123`

> [!WARNING]
> Kredensial default ini hanya untuk pengembangan lokal. Ganti segera sebelum dipakai di lingkungan publik.

## Modul yang Tersedia

- Dashboard
- Customer
- Booking
- Paket Wisata
- Pembayaran
- Kategori
- Galeri
- Testimoni
- Partner Maskapai
- Klien Korporasi
- Setting Profil

## Catatan URL & Routing

- URL seperti `/login` atau `/data-manajemen-customer` akan diarahkan ke file `.php` terkait.
- URL yang masih menggunakan `.php` akan di-redirect ke versi tanpa ekstensi.

Jika route tidak bekerja, cek kembali:

- `mod_rewrite` Apache aktif
- `.htaccess` terbaca oleh Apache
- Lokasi proyek sesuai URL yang diakses

## Troubleshooting Cepat

- Gagal konek database
  - Cek host/user/password/database di `config.php`
  - Pastikan service MySQL aktif
- Halaman redirect terus ke login
  - Pastikan session PHP aktif
  - Login ulang dan cek tabel `user`
- Upload gambar gagal
  - Pastikan folder `uploads/` ada dan bisa ditulis
  - Pastikan format file sesuai (khusus galeri: `jpg`, `jpeg`, `png`, `gif`, `webp`)

## Roadmap Singkat

- Hash password user
- Prepared statement untuk query SQL
- Validasi upload file yang lebih ketat
- Pagination & pencarian pada halaman data
- Audit logging aktivitas admin
