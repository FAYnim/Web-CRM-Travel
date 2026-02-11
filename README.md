# Web CRM Travel

Aplikasi CRM (Customer Relationship Management) untuk agen perjalanan travel berbasis PHP dan MySQL.

## Deskripsi

Web CRM Travel adalah sistem manajemen perjalanan yang memungkinkan admin untuk mengelola data customer, booking, pembayaran, dan paket wisata. Aplikasi ini dibangun menggunakan PHP native dengan Bootstrap 5 untuk tampilan responsif.

## Fitur

- **Login System** - Autentikasi pengguna admin
- **Manajemen Customer** - Tambah, edit, hapus data customer
- **Manajemen Booking** - Proses pemesanan paket wisata
- **Manajemen Pembayaran** - Pencatatan pembayaran customer
- **Paket wisata** - Tampilan paket wisata unggulan

## Teknologi

- **Backend**: PHP 8.x
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Tailwind CSS (untuk halaman paket)
- **Server**: XAMPP / Apache

## Struktur Folder

```
web-crm-travel/
├── config.php              # Konfigurasi database
├── login.php               # Halaman login
├── process-login.php       # Proses autentikasi
├── navbar.php              # Komponen navigasi
├── manajemen-customer.php  # Form input customer
├── data-manajemen-customer.php  # Data customer
├── edit-manajemen-customer.php  # Edit customer
├── hapus-manajemen-customer.php # Hapus customer
├── submit-manajemen-customer.php # Proses simpan customer
├── manajemen-booking.php   # Form booking
├── data-manajemen-booking.php   # Data booking
├── manajemen-pembayaran.php # Form pembayaran
├── data-manajemen-pembayaran.php # Data pembayaran
├── paket.php               # Halaman paket wisata
├── src/
│   └── css/
│       └── login.css       # Styling login
└── data/
    ├── manajemen_customer.sql
    ├── manajemen_booking.sql
    ├── manajemen_paket.sql
    └── manajemen_pembayaran.sql
```

## Instalasi

1. Pastikan sudah terinstall XAMPP atau server PHP lainnya
2. Clone atau copy project ke folder `htdocs`
3. Buat database baru dengan nama `web_crm_travel`
4. Import file SQL dari folder `data/`
5. Sesuaikan konfigurasi database di `config.php`
6. Akses aplikasi melalui browser: `http://localhost/web-crm-travel`

## Database Tables

- `manajemen_customer` - Data customer
- `manajemen_booking` - Data booking
- `manajemen_paket` - Data paket wisata
- `manajemen_pembayaran` - Data pembayaran

## Akses Aplikasi

1. Buka browser dan akses `http://localhost/web-crm-travel/login.php`
2. Login dengan kredensial yang sesuai

## Lisensi

[Tidak ditentukan]
