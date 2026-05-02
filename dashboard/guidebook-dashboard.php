<?php
include 'config.php';

if (($_SESSION['login'] ?? false) != true) {
    header("Location: login");
    exit;
}

$page_title = 'Guidebook Dashboard';
$current_page = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);

$guidebook_sections = [
    [
        'id' => 'persiapan-data',
        'icon' => 'bi-clipboard-check',
        'title' => 'Bagaimana menyiapkan data awal sebelum memakai CRM?',
        'goal' => 'Menyiapkan data dasar agar proses operasional CRM berjalan runtut dan tidak perlu input ulang.',
        'steps' => [
            'Periksa halaman dashboard untuk melihat ringkasan jumlah customer, booking, paket, dan pembayaran.',
            'Pastikan data paket wisata sudah tersedia sebelum membuat booking baru.',
            'Siapkan informasi customer seperti nama, nomor telepon, email, dan alamat sebelum input data.',
            'Pastikan konten landing page seperti kategori, galeri, testimoni, partner, dan klien korporasi sudah disiapkan dalam format yang benar.',
        ],
        'links' => [
            ['label' => 'Dashboard', 'href' => 'index'],
            ['label' => 'Data Paket', 'href' => 'data-manajemen-paket'],
        ],
    ],
    [
        'id' => 'customer',
        'icon' => 'bi-people',
        'title' => 'Bagaimana mengelola data customer?',
        'goal' => 'Mencatat calon pelanggan atau pelanggan aktif agar dapat digunakan pada proses booking.',
        'steps' => [
            'Buka menu Customer, lalu pilih Data Customer untuk memeriksa apakah customer sudah pernah dibuat.',
            'Jika belum ada, buka Tambah Customer.',
            'Isi seluruh informasi customer sesuai data yang diterima dari pelanggan.',
            'Simpan data, lalu kembali ke Data Customer untuk memastikan record baru muncul.',
            'Gunakan fitur edit jika ada kesalahan penulisan atau perubahan kontak.',
        ],
        'links' => [
            ['label' => 'Data Customer', 'href' => 'data-manajemen-customer'],
            ['label' => 'Tambah Customer', 'href' => 'manajemen-customer'],
        ],
    ],
    [
        'id' => 'booking',
        'icon' => 'bi-calendar-check',
        'title' => 'Bagaimana membuat booking baru?',
        'goal' => 'Membuat catatan pemesanan perjalanan yang menghubungkan customer dengan paket wisata.',
        'steps' => [
            'Pastikan customer dan paket wisata sudah tersedia.',
            'Buka menu Booking, lalu pilih Tambah Booking.',
            'Pilih customer, pilih paket, dan isi tanggal keberangkatan atau tanggal booking sesuai form yang tersedia.',
            'Periksa kembali informasi pesanan sebelum menyimpan.',
            'Buka Data Booking untuk memastikan booking baru tercatat.',
        ],
        'links' => [
            ['label' => 'Data Booking', 'href' => 'data-manajemen-booking'],
            ['label' => 'Tambah Booking', 'href' => 'manajemen-booking'],
        ],
    ],
    [
        'id' => 'pembayaran',
        'icon' => 'bi-credit-card',
        'title' => 'Bagaimana mencatat pembayaran?',
        'goal' => 'Mencatat pembayaran pelanggan agar total pendapatan dan status transaksi dapat dipantau.',
        'steps' => [
            'Pastikan booking yang akan dibayar sudah tercatat.',
            'Buka menu Pembayaran, lalu pilih Tambah Pembayaran.',
            'Pilih booking yang sesuai dan isi jumlah pembayaran.',
            'Pilih metode pembayaran sesuai bukti transaksi.',
            'Simpan pembayaran, lalu cek Data Pembayaran dan ringkasan pendapatan pada dashboard.',
        ],
        'links' => [
            ['label' => 'Data Pembayaran', 'href' => 'data-manajemen-pembayaran'],
            ['label' => 'Tambah Pembayaran', 'href' => 'manajemen-pembayaran'],
        ],
    ],
    [
        'id' => 'paket-wisata',
        'icon' => 'bi-suitcase-lg',
        'title' => 'Bagaimana mengelola paket wisata?',
        'goal' => 'Mengelola daftar paket wisata yang ditampilkan dan digunakan dalam proses booking.',
        'steps' => [
            'Buka menu Paket Wisata, lalu pilih Data Paket untuk melihat paket yang sudah tersedia.',
            'Pilih Tambah Paket untuk membuat paket baru.',
            'Isi nama paket, harga, deskripsi, gambar, dan informasi lain sesuai form.',
            'Simpan paket dan pastikan tampil pada Data Paket.',
            'Edit paket jika ada perubahan harga, fasilitas, atau materi promosi.',
        ],
        'links' => [
            ['label' => 'Data Paket', 'href' => 'data-manajemen-paket'],
            ['label' => 'Tambah Paket', 'href' => 'manajemen-paket'],
        ],
    ],
    [
        'id' => 'landing-page',
        'icon' => 'bi-window-sidebar',
        'title' => 'Bagaimana mengatur konten landing page?',
        'goal' => 'Menjaga konten landing page tetap rapi, kredibel, dan sesuai penawaran bisnis travel.',
        'steps' => [
            'Buka menu Kategori untuk mengelola pengelompokan paket atau konten utama.',
            'Buka menu Galeri untuk menambah gambar destinasi, aktivitas, atau dokumentasi perjalanan.',
            'Buka menu Testimoni untuk menampilkan ulasan pelanggan yang relevan.',
            'Periksa setiap daftar data setelah menambah atau mengedit konten.',
            'Buka landing page publik untuk memastikan konten tampil sesuai kebutuhan promosi.',
        ],
        'links' => [
            ['label' => 'Data Kategori', 'href' => 'data-manajemen-kategori'],
            ['label' => 'Data Galeri', 'href' => 'data-manajemen-galeri'],
            ['label' => 'Data Testimoni', 'href' => 'data-manajemen-testimoni'],
        ],
    ],
    [
        'id' => 'partner-klien',
        'icon' => 'bi-building',
        'title' => 'Bagaimana mengelola partner dan klien korporasi?',
        'goal' => 'Mengelola logo atau data mitra yang memperkuat kredibilitas bisnis pada landing page.',
        'steps' => [
            'Buka menu Partner Maskapai untuk mengelola data partner perjalanan.',
            'Tambahkan partner baru jika ada kerja sama atau referensi brand yang perlu ditampilkan.',
            'Buka menu Klien Korporasi untuk mengelola daftar klien perusahaan.',
            'Pastikan logo atau nama partner dan klien tampil dengan format yang rapi.',
            'Periksa halaman publik setelah perubahan untuk memastikan tampilan tidak rusak.',
        ],
        'links' => [
            ['label' => 'Data Partner', 'href' => 'data-manajemen-partner'],
            ['label' => 'Data Klien Korporasi', 'href' => 'data-manajemen-klien-korporasi'],
        ],
    ],
    [
        'id' => 'setting-profil',
        'icon' => 'bi-gear',
        'title' => 'Bagaimana memperbarui setting profil bisnis?',
        'goal' => 'Memperbarui informasi profil bisnis agar identitas, kontak, dan informasi publik tetap akurat.',
        'steps' => [
            'Buka menu Setting Profil dari sidebar.',
            'Periksa nama bisnis, deskripsi, alamat, kontak, dan informasi pendukung lain.',
            'Ubah data yang sudah tidak sesuai.',
            'Simpan perubahan dan pastikan tidak ada pesan error.',
            'Buka landing page publik untuk memeriksa perubahan profil yang tampil.',
        ],
        'links' => [
            ['label' => 'Setting Profil', 'href' => 'setting-profil'],
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - CRM Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/dashboard.css">
</head>
<body>
    <?php include "sidebar.php"; ?>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="main-content">
        <header class="top-header">
            <div class="d-flex align-items-center gap-3">
                <button class="btn-sidebar-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="page-title"><?php echo htmlspecialchars($page_title); ?></h1>
            </div>
            <div class="header-actions">
                <span class="text-muted small d-none d-md-inline">
                    <i class="bi bi-calendar3 me-1"></i>
                    <?php echo date('d M Y'); ?>
                </span>
            </div>
        </header>

        <div class="page-content">
            <div class="guidebook-wrapper">
                <section class="guidebook-hero">
                    <div>
                        <p class="guidebook-kicker">Panduan Operasional CRM Travel</p>
                        <h2>Gunakan alur kerja ini untuk menjalankan dashboard secara konsisten.</h2>
                        <p>
                            Guidebook ini membantu admin dan pemilik bisnis memahami urutan kerja utama:
                            menyiapkan data dasar, mencatat customer, membuat booking, mencatat pembayaran,
                            mengelola paket, memperbarui konten landing page, menjaga data partner, dan
                            memperbarui profil bisnis.
                        </p>
                    </div>
                </section>

                <section class="guidebook-faq" aria-label="FAQ Guidebook Dashboard">
                    <div class="guidebook-faq-header">
                        <p class="guidebook-kicker">Guidebook</p>
                    </div>

                    <div class="accordion guidebook-accordion" id="guidebookAccordion">
                        <?php foreach ($guidebook_sections as $index => $section): ?>
                            <?php
                                $heading_id = 'guidebook-heading-' . $section['id'];
                                $collapse_id = 'guidebook-collapse-' . $section['id'];
                                $is_open = $index === 0;
                            ?>
                            <div class="accordion-item guidebook-faq-item" id="<?php echo htmlspecialchars($section['id']); ?>">
                                <h2 class="accordion-header" id="<?php echo htmlspecialchars($heading_id); ?>">
                                    <button class="accordion-button guidebook-faq-button <?php echo $is_open ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo htmlspecialchars($collapse_id); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo htmlspecialchars($collapse_id); ?>">
                                        <span class="guidebook-faq-icon">
                                            <i class="bi <?php echo htmlspecialchars($section['icon']); ?>"></i>
                                        </span>
                                        <span><?php echo htmlspecialchars($section['title']); ?></span>
                                    </button>
                                </h2>
                                <div id="<?php echo htmlspecialchars($collapse_id); ?>" class="accordion-collapse collapse <?php echo $is_open ? 'show' : ''; ?>" aria-labelledby="<?php echo htmlspecialchars($heading_id); ?>" data-bs-parent="#guidebookAccordion">
                                    <div class="accordion-body guidebook-faq-body">
                                        <h3>Tujuan</h3>
                                        <p><?php echo htmlspecialchars($section['goal']); ?></p>

                                        <h3>Langkah</h3>
                                        <ol class="guidebook-step-list">
                                            <?php foreach ($section['steps'] as $step): ?>
                                                <li><?php echo htmlspecialchars($step); ?></li>
                                            <?php endforeach; ?>
                                        </ol>

                                        <div class="guidebook-links">
                                            <?php foreach ($section['links'] as $link): ?>
                                                <a href="<?php echo htmlspecialchars($link['href']); ?>">
                                                    <?php echo htmlspecialchars($link['label']); ?>
                                                    <i class="bi bi-arrow-up-right"></i>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    </script>
</body>
</html>
