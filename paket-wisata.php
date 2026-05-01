<?php
require_once __DIR__ . '/config.php';

$kategoriList = [];
$paketList = [];
$selectedKategori = isset($_GET['kategori']) ? trim((string)$_GET['kategori']) : 'semua';

function paket_slugify($text)
{
  $slug = strtolower(trim((string)$text));
  $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
  return trim($slug, '-');
}

function paket_format_harga($harga)
{
  return 'Rp ' . number_format((int)$harga, 0, ',', '.');
}

function paket_resolve_gambar($gambar)
{
  $gambar = trim((string)$gambar);

  if ($gambar === '' || $gambar === '-') {
    return 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&q=80';
  }

  if (preg_match('/^https?:\/\//i', $gambar)) {
    return $gambar;
  }

  if (strpos($gambar, 'uploads/') === 0) {
    return 'dashboard/' . $gambar;
  }

  if (strpos($gambar, 'dashboard/') === 0) {
    return $gambar;
  }

  return 'dashboard/uploads/' . ltrim($gambar, '/');
}

$queryKategori = mysqli_query($koneksi, "SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori ASC");
if ($queryKategori) {
  while ($kategori = mysqli_fetch_assoc($queryKategori)) {
    $slug = paket_slugify($kategori['nama_kategori']);
    $kategori['slug'] = $slug !== '' ? $slug : 'kategori-' . (int)$kategori['id'];
    $kategoriList[] = $kategori;
  }
}

if ($selectedKategori === '') {
  $selectedKategori = 'semua';
}

$kategoriSlugs = array_column($kategoriList, 'slug');
if ($selectedKategori !== 'semua' && !in_array($selectedKategori, $kategoriSlugs, true)) {
  $selectedKategori = 'semua';
}

$queryPaket = mysqli_query(
  $koneksi,
  "SELECT p.id, p.nama_paket, p.durasi, p.lokasi, p.harga, p.gambar, p.label, p.deskripsi, k.nama_kategori
   FROM manajemen_paket p
   LEFT JOIN kategori k ON p.kategori_id = k.id
   ORDER BY p.created_at DESC, p.id DESC"
);

if ($queryPaket) {
  while ($paket = mysqli_fetch_assoc($queryPaket)) {
    $slug = paket_slugify($paket['nama_kategori'] ?? '');
    $paket['kategori_slug'] = $slug !== '' ? $slug : 'tanpa-kategori';
    $paket['nama_kategori'] = trim((string)($paket['nama_kategori'] ?? '')) !== '' ? $paket['nama_kategori'] : 'Tanpa Kategori';
    $paketList[] = $paket;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Primary Meta Tags -->
  <title>Paket Wisata — SnD Tour Travel | Tour Domestik & Asia Terpercaya</title>
  <meta name="title" content="Paket Wisata — SnD Tour Travel | Tour Domestik & Asia Terpercaya">
  <meta name="description" content="Jelajahi berbagai paket wisata domestik &amp; Asia dari SnD Tour Travel. Wisata religi, edukasi, bulan madu, keluarga, perusahaan, dan adventure dengan harga terjangkau. Liburan Pasti Berangkat!">
  <meta name="keywords" content="paket wisata, tour domestik, tour asia, wisata religi, wisata edukasi, bulan madu, wisata keluarga, travel agent surabaya, SnD Tour">
  <meta name="author" content="SnD Tour Travel">
  <meta name="robots" content="index, follow">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://sndtour.com/paket-wisata.php">
  <meta property="og:title" content="Paket Wisata — SnD Tour Travel | Tour Domestik & Asia">
  <meta property="og:description" content="Jelajahi berbagai paket wisata domestik &amp; Asia dari SnD Tour Travel. Wisata religi, edukasi, bulan madu, keluarga, dan adventure.">
  <meta property="og:image" content="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1200&q=80">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="SnD Tour Travel">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://sndtour.com/paket-wisata.php">
  <meta property="twitter:title" content="Paket Wisata — SnD Tour Travel | Tour Domestik & Asia">
  <meta property="twitter:description" content="Jelajahi berbagai paket wisata domestik &amp; Asia dari SnD Tour Travel. Wisata religi, edukasi, bulan madu, keluarga, dan adventure.">
  <meta property="twitter:image" content="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1200&q=80">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%23008080'/%3E%3Ctext x='50' y='68' text-anchor='middle' fill='white' font-family='Georgia' font-size='48' font-weight='bold'%3ESnD%3C/text%3E%3C/svg%3E">

  <!-- Canonical -->
  <link rel="canonical" href="https://sndtour.com/paket-wisata.php">

  <!-- Google Fonts Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Schema.org ItemList for Tour Packages -->
  <script type="application/ld+json">
  <?php
    $schemaItems = [];
    foreach ($paketList as $index => $paket) {
      $schemaItems[] = [
        '@type' => 'ListItem',
        'position' => $index + 1,
        'item' => [
          '@type' => 'TouristTrip',
          'name' => $paket['nama_paket'],
          'description' => substr(strip_tags((string)($paket['deskripsi'] ?? $paket['nama_paket'])), 0, 160),
          'url' => 'https://sndtour.com/detail-paket.php?id=' . (int)$paket['id'],
          'touristType' => $paket['nama_kategori'],
          'offers' => [
            '@type' => 'Offer',
            'price' => (string)(int)$paket['harga'],
            'priceCurrency' => 'IDR',
            'availability' => 'https://schema.org/InStock'
          ]
        ]
      ];
    }

    echo json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => 'Paket Wisata SnD Tour Travel',
      'description' => 'Daftar paket wisata domestik dan Asia dari SnD Tour Travel Surabaya',
      'url' => 'https://sndtour.com/paket-wisata.php',
      'numberOfItems' => count($paketList),
      'itemListElement' => $schemaItems
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  ?>
  </script>

  <!-- BreadcrumbList Schema -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "https://sndtour.com/"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "Paket Wisata",
        "item": "https://sndtour.com/paket-wisata.php"
      }
    ]
  }
  </script>
</head>
<body>

  <!-- ============================================================
       STICKY HEADER
       ============================================================ -->
  <header class="header" id="header">
    <div class="header__inner">
      <!-- Logo -->
      <a href="index.php" class="header__logo" aria-label="SnD Tour Travel - Halaman Utama">
        <div class="header__logo-icon">SnD</div>
        <div>
          <span class="header__logo-text">SnD Tour</span>
          <span class="header__logo-tagline">Liburan Pasti Berangkat</span>
        </div>
      </a>

      <!-- Navigation -->
      <nav class="nav" id="mainNav" aria-label="Navigasi Utama">
        <ul style="display:flex;align-items:center;gap:var(--space-1);list-style:none;margin:0;padding:0;">
          <!-- HOME -->
          <li class="nav__item">
            <a href="index.php" class="nav__link">HOME</a>
          </li>

          <!-- PROFIL (Dropdown) -->
          <li class="nav__item">
            <a href="profil.php" class="nav__link">
              PROFIL
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <div class="nav__dropdown">
              <a href="profil.php#tentang-kami" class="nav__dropdown-link">Tentang Kami</a>
              <a href="profil.php#visi-misi" class="nav__dropdown-link">Visi &amp; Misi</a>
            </div>
          </li>

          <!-- PAKET WISATA (Dropdown) — Active -->
          <li class="nav__item">
            <a href="paket-wisata.php" class="nav__link nav__link--active">
              PAKET WISATA
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <div class="nav__dropdown">
              <a href="paket-wisata.php?kategori=domestik" class="nav__dropdown-link">Domestik</a>
              <a href="paket-wisata.php?kategori=asia" class="nav__dropdown-link">Asia</a>
            </div>
          </li>

          <!-- BLOG -->
          <li class="nav__item">
            <a href="blog.php" class="nav__link">BLOG</a>
          </li>

          <!-- GALERI -->
          <li class="nav__item">
            <a href="galeri.php" class="nav__link">GALERI</a>
          </li>
        </ul>
      </nav>

      <!-- Header CTA -->
      <div class="header__cta">
        <a href="kontak.php" class="btn btn--primary btn--sm">HUBUNGI KAMI</a>
      </div>

      <!-- Mobile Hamburger Toggle -->
      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
        <span class="nav-toggle__bar"></span>
        <span class="nav-toggle__bar"></span>
        <span class="nav-toggle__bar"></span>
      </button>
    </div>
  </header>

  <!-- ============================================================
       PAGE HEADER
       ============================================================ -->
  <section class="page-header">
    <div class="page-header__bg">
      <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1400&q=80" alt="Jalan raya dengan pemandangan alam indah untuk wisata" loading="eager" width="1400" height="700">
    </div>
    <div class="container">
      <div class="page-header__content">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <a href="index.php">Home</a>
          <span class="breadcrumb__sep">/</span>
          <span>Paket Wisata</span>
        </nav>
        <h1 class="page-header__title">Paket Wisata</h1>
        <p class="page-header__subtitle">Temukan paket wisata terbaik untuk liburan tak terlupakan bersama SnD Tour Travel.</p>
      </div>
    </div>
  </section>

  <!-- ============================================================
       FILTER SECTION
       ============================================================ -->
  <section class="section" id="filter-section">
    <div class="container">
      <div class="filters reveal">
        <!-- Category Filter Tags -->
        <div style="width:100%;">
          <div class="filter-tags">
            <button class="filter-tag <?php echo $selectedKategori === 'semua' ? 'filter-tag--active' : ''; ?>" data-filter="semua">Semua</button>
            <?php foreach ($kategoriList as $kategori): ?>
              <?php
                $kategoriSlug = htmlspecialchars($kategori['slug']);
                $kategoriNama = htmlspecialchars($kategori['nama_kategori']);
                $activeClass = $selectedKategori === $kategori['slug'] ? ' filter-tag--active' : '';
              ?>
              <button class="filter-tag<?php echo $activeClass; ?>" data-filter="<?php echo $kategoriSlug; ?>"><?php echo $kategoriNama; ?></button>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       PACKAGE GRID
       ============================================================ -->
  <section class="section packages" id="paket-listing">
    <div class="container">
      <div class="packages__grid">

        <?php if (!empty($paketList)): ?>
          <?php foreach ($paketList as $index => $paket): ?>
            <?php
              $delayClass = 'reveal--delay-' . (($index % 3) + 1);
              $kategoriSlug = htmlspecialchars($paket['kategori_slug']);
              $namaKategori = htmlspecialchars($paket['nama_kategori']);
              $namaPaket = htmlspecialchars($paket['nama_paket']);
              $lokasi = htmlspecialchars($paket['lokasi']);
              $durasi = htmlspecialchars($paket['durasi']);
              $label = trim((string)$paket['label']) !== '' ? htmlspecialchars($paket['label']) : $namaKategori;
              $gambar = htmlspecialchars(paket_resolve_gambar($paket['gambar']));
              $detailUrl = 'detail-paket.php?id=' . (int)$paket['id'];
              $hiddenStyle = $selectedKategori !== 'semua' && $selectedKategori !== $paket['kategori_slug'] ? ' style="display:none;"' : '';
            ?>
            <article class="card reveal <?php echo $delayClass; ?>" data-category="<?php echo $kategoriSlug; ?>"<?php echo $hiddenStyle; ?>>
              <a href="<?php echo $detailUrl; ?>">
                <div class="card__image">
                  <img src="<?php echo $gambar; ?>" alt="<?php echo $namaPaket; ?>" loading="lazy" width="600" height="375">
                  <span class="card__badge"><?php echo $label; ?></span>
                </div>
              </a>
              <div class="card__body">
                <span class="card__category"><?php echo $namaKategori; ?></span>
                <h3 class="card__title"><a href="<?php echo $detailUrl; ?>"><?php echo $namaPaket; ?></a></h3>
                <div class="card__meta">
                  <span class="card__meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?php echo $lokasi; ?>
                  </span>
                  <span class="card__duration">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <?php echo $durasi; ?>
                  </span>
                </div>
                <div class="card__price">
                  <span class="card__price-label">Start From</span>
                  <span class="card__price-value"><?php echo paket_format_harga($paket['harga']); ?></span>
                </div>
                <div class="card__footer">
                  <a href="<?php echo $detailUrl; ?>" class="btn btn--secondary btn--sm">LIHAT DETAIL</a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="grid-column:1/-1;text-align:center;color:#64748b;">Belum ada paket wisata. Silakan tambah paket dari dashboard.</p>
        <?php endif; ?>

      </div>

    </div>
  </section>

  <!-- ============================================================
       CTA BANNER
       ============================================================ -->
  <section class="cta-banner reveal" id="cta-banner">
    <div class="cta-banner__content">
      <h2 class="cta-banner__title">Siap Berlibur?</h2>
      <p class="cta-banner__text">Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan wujudkan liburan impian Anda bersama SnD Tour Travel.</p>
      <a href="https://wa.me/6281234567890?text=Halo%20SnD%20Tour%2C%20saya%20tertarik%20untuk%20konsultasi%20paket%20wisata" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        HUBUNGI KAMI SEKARANG
      </a>
    </div>
  </section>

  <!-- ============================================================
       FOOTER
       ============================================================ -->
  <footer class="footer" id="footer">
    <div class="container">
      <div class="footer__grid">

        <!-- Column 1: Brand -->
        <div class="footer__brand">
          <h3 class="footer__brand-name">SnD Tour Travel</h3>
          <p class="footer__brand-tagline">Liburan Pasti Berangkat</p>
          <p class="footer__brand-text">Travel agent terpercaya di Surabaya sejak 2017. Menyediakan paket wisata domestik &amp; Asia, outbond, dan catering dengan layanan profesional dan harga terjangkau.</p>
          <div class="footer__social">
            <a href="https://instagram.com/sndtour" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram SnD Tour">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="https://facebook.com/sndtour" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook SnD Tour">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="https://youtube.com/@sndtour" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="YouTube SnD Tour">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
            </a>
            <a href="https://tiktok.com/@sndtour" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="TikTok SnD Tour">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
            </a>
          </div>
        </div>

        <!-- Column 2: Layanan -->
        <div>
          <h4 class="footer__heading">Layanan</h4>
          <nav class="footer__links" aria-label="Layanan SnD Tour">
            <a href="paket-wisata.php" class="footer__link">Paket Wisata</a>
            <a href="outbond.php" class="footer__link">Outbond</a>
            <a href="catering.php" class="footer__link">Catering</a>
            <a href="blog.php" class="footer__link">Blog</a>
            <a href="galeri.php" class="footer__link">Galeri</a>
          </nav>
        </div>

        <!-- Column 3: Kategori Tour -->
        <div>
          <h4 class="footer__heading">Kategori Tour</h4>
          <nav class="footer__links" aria-label="Kategori Tour">
            <a href="paket-wisata.php?kategori=domestik" class="footer__link">Tour Domestik</a>
            <a href="paket-wisata.php?kategori=asia" class="footer__link">Tour Asia</a>
            <a href="outbond.php" class="footer__link">Outbond</a>
            <a href="catering.php" class="footer__link">Catering</a>
            <a href="paket-wisata.php?kategori=religi" class="footer__link">Wisata Religi</a>
            <a href="paket-wisata.php?kategori=edukasi" class="footer__link">Wisata Edukasi</a>
            <a href="paket-wisata.php?kategori=bulan-madu" class="footer__link">Bulan Madu</a>
            <a href="paket-wisata.php?kategori=keluarga" class="footer__link">Wisata Keluarga</a>
          </nav>
        </div>

        <!-- Column 4: Kontak -->
        <div>
          <h4 class="footer__heading">Kontak</h4>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>Jl. Raya Darmo No. 123,<br>Surabaya, Jawa Timur 60241</span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span>+62 812-3456-7890</span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <span>info@sndtour.com</span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>Senin - Sabtu<br>09.00 - 17.00 WIB</span>
          </div>
        </div>

      </div>

      <!-- Footer Bottom Bar -->
      <div class="footer__bottom">
        <p class="footer__copyright">&copy; 2026 SnD Tour Travel. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- ============================================================
       WHATSAPP FAB
       ============================================================ -->
  <div class="wa-fab" id="waFab">
    <span class="wa-fab__tooltip">Chat dengan kami</span>
    <a href="https://wa.me/6281234567890?text=Halo%20SnD%20Tour%2C%20saya%20ingin%20bertanya%20tentang%20paket%20wisata" class="wa-fab__btn" target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp dengan SnD Tour Travel">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>
  </div>

  <!-- ============================================================
       NOISE OVERLAY
       ============================================================ -->
  <div class="noise-overlay" aria-hidden="true"></div>

  <!-- ============================================================
       MOBILE NAV OVERLAY
       ============================================================ -->
  <div class="nav-overlay" id="navOverlay" aria-hidden="true"></div>

  <!-- JavaScript -->
  <script src="js/main.js"></script>
</body>
</html>
