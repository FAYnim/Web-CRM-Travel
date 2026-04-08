# Web CRM Travel

Aplikasi CRM (Customer Relationship Management) untuk agen perjalanan travel berbasis PHP dan MySQL.

## Deskripsi

Web CRM Travel adalah sistem manajemen perjalanan yang memungkinkan admin untuk mengelola data customer, booking, pembayaran, dan paket wisata. Aplikasi ini dibangun menggunakan PHP native dengan Bootstrap 5 untuk tampilan responsif.

## Fitur

- **Login System** - Autentikasi pengguna admin
- **Manajemen Customer** - Tambah, edit, hapus data customer
- **Manajemen Booking** - Proses pemesanan paket wisata
- **Manajemen Pembayaran** - Pencatatan pembayaran customer
- **Manajemen Paket** - Kelola paket wisata
- **Manajemen Kategori** - Kelola kategori paket wisata
- **Manajemen Klien Korporasi** - Kelola klien korporasi
- **Manajemen Partner/Maskapai** - Kelola partner dan maskapai
- **Manajemen Testimoni** - Kelola testimoni customer

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
├── navbar.php              # Komponen navigasi
├── sidebar.php             # Komponen sidebar
├── index.php               # Halaman utama
├── manajemen-customer.php  # Form input customer
├── data-manajemen-customer.php  # Data customer
├── edit-manajemen-customer.php  # Edit customer
├── manajemen-booking.php   # Form booking
├── data-manajemen-booking.php   # Data booking
├── manajemen-pembayaran.php # Form pembayaran
├── data-manajemen-pembayaran.php # Data pembayaran
├── manajemen-paket.php     # Kelola paket wisata
├── data-manajemen-paket.php # Data paket
├── edit-manajemen-paket.php # Edit paket
├── manajemen-kategori.php  # Kelola kategori
├── data-manajemen-kategori.php # Data kategori
├── edit-manajemen-kategori.php # Edit kategori
├── manajemen-klien-korporasi.php # Kelola klien korporasi
├── data-manajemen-klien-korporasi.php # Data klien
├── edit-manajemen-klien-korporasi.php # Edit klien
├── manajemen-partner.php   # Kelola partner/maskapai
├── data-manajemen-partner.php # Data partner
├── edit-manajemen-partner.php # Edit partner
├── manajemen-testimoni.php # Kelola testimoni
├── data-manajemen-testimoni.php # Data testimoni
├── edit-manajemen-testimoni.php # Edit testimoni
├── src/
│   ├── css/
│   │   └── login.css       # Styling login
│   └── api/                # API processing files
│       ├── process-login.php
│       ├── submit-manajemen-*.php
│       ├── update-manajemen-*.php
│       └── hapus-manajemen-*.php
└── data/
    ├── schema.sql
    ├── manajemen_customer.sql
    ├── manajemen_booking.sql
    ├── manajemen_paket.sql
    ├── manajemen_pembayaran.sql
    ├── kategori.sql
    ├── klien_korporasi.sql
    ├── partner_maskapai.sql
    └── testimoni.sql
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
- `manajemen_kategori` - Data kategori paket
- `manajemen_klien_korporasi` - Data klien korporasi
- `manajemen_partner` - Data partner/maskapai
- `manajemen_testimoni` - Data testimoni

## Akses Aplikasi

1. Buka browser dan akses `http://localhost/web-crm-travel/`
2. Login dengan kredensial yang sesuai

## Lisensi

[Tidak ditentukan]
