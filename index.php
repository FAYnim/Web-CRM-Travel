<?php
require_once __DIR__ . '/config.php';

$paketTerbaru = [];
$kategoriWisata = [];
$queryPaketTerbaru = mysqli_query(
  $koneksi,
  "SELECT id, nama_paket, durasi, lokasi, harga, gambar, label FROM manajemen_paket ORDER BY created_at DESC, id DESC LIMIT 6"
);

if ($queryPaketTerbaru) {
  while ($row = mysqli_fetch_assoc($queryPaketTerbaru)) {
    $paketTerbaru[] = $row;
  }
}

function lp_format_harga($harga)
{
  return 'Rp ' . number_format((int)$harga, 0, ',', '.');
}

function lp_resolve_gambar($gambar)
{
  $gambar = trim((string)$gambar);

  if ($gambar === '') {
    return 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&q=80';
  }

  if (preg_match('/^https?:\/\//i', $gambar)) {
    return $gambar;
  }

  if (strpos($gambar, 'uploads/') === 0) {
    return 'dashboard/'.$gambar;
  }

  return 'dashboard/uploads/' . ltrim($gambar, '/');
}

function lp_slugify($text)
{
  $slug = strtolower(trim((string)$text));
  $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
  return trim($slug, '-');
}

function lp_kategori_image($slug)
{
  $images = [
    'religi' => 'https://images.unsplash.com/photo-1564415637254-92c66292cd64?w=600&q=80',
    'edukasi' => 'https://images.unsplash.com/photo-1580477667995-2b94f01c9516?w=600&q=80',
    'bulan-madu' => 'https://images.unsplash.com/photo-1546514355-7fdc90ccbd03?w=600&q=80',
    'keluarga' => 'https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?w=600&q=80',
    'perusahaan' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?w=600&q=80',
    'adventure' => 'https://images.unsplash.com/photo-1533130061792-64b345e4a833?w=600&q=80',
    'domestik' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&q=80',
    'asia' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80',
  ];

  return $images[$slug] ?? 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&q=80';
}

function lp_testimoni_initial($nama)
{
  $words = explode(' ', trim((string)$nama));
  $initials = '';
  foreach ($words as $w) {
    $initials .= strtoupper(substr($w, 0, 1));
    if (strlen($initials) >= 2) break;
  }
  return $initials ?: '?';
}

function lp_render_rating($rating)
{
  $rating = max(1, min(5, (int)$rating));
  $html = '';
  for ($i = 1; $i <= 5; $i++) {
    $opacity = $i <= $rating ? '1' : '0.3';
    $html .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="opacity:' . $opacity . '"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
  }
  return $html;
}

$queryKategoriWisata = mysqli_query(
  $koneksi,
  "SELECT k.id, k.nama_kategori, COUNT(p.id) AS jumlah_paket
   FROM kategori k
   LEFT JOIN manajemen_paket p ON p.kategori_id = k.id
   GROUP BY k.id, k.nama_kategori
   ORDER BY k.nama_kategori ASC"
);

if ($queryKategoriWisata) {
  while ($kategori = mysqli_fetch_assoc($queryKategoriWisata)) {
    $kategori['slug'] = lp_slugify($kategori['nama_kategori']);
    $kategoriWisata[] = $kategori;
  }
}

$testimoniLanding = [];
$queryTestimoni = mysqli_query(
  $koneksi,
  "SELECT id, nama_pelanggan, pesan, rating, tanggal FROM testimoni WHERE status='Aktif' ORDER BY tanggal DESC, id DESC LIMIT 3"
);

if ($queryTestimoni) {
  while ($row = mysqli_fetch_assoc($queryTestimoni)) {
    $testimoniLanding[] = $row;
  }
}

// Fallback deterministik jika kosong
if (empty($testimoniLanding)) {
  $testimoniLanding[] = [
    'id' => 0,
    'nama_pelanggan' => 'Pelanggan Setia',
    'pesan' => 'Layanan SnD Tour Travel sangat profesional dan terpercaya. Pengalaman liburan kami menjadi sangat berkesan dan menyenangkan.',
    'rating' => 5,
    'tanggal' => date('Y-m-d')
  ];
}

$profilKontak = crm_get_profil($koneksi);
$profilNamaPerusahaan = trim((string)$profilKontak['nama_perusahaan']);
$profilEmail = trim((string)$profilKontak['email']);
$profilTelepon = trim((string)$profilKontak['telepon']);
$profilAlamat = trim((string)$profilKontak['alamat']);
$profilTentang = trim((string)$profilKontak['tentang_kami']);
$profilWhatsapp = crm_format_whatsapp_number($profilKontak['whatsapp'] ?: $profilTelepon);
$whatsappCtaUrl = $profilWhatsapp !== ''
  ? 'https://wa.me/' . $profilWhatsapp . '?text=' . rawurlencode('Halo ' . $profilNamaPerusahaan . ', saya tertarik untuk konsultasi paket wisata')
  : 'kontak.php';
$whatsappFabUrl = $profilWhatsapp !== ''
  ? 'https://wa.me/' . $profilWhatsapp . '?text=' . rawurlencode('Halo ' . $profilNamaPerusahaan . ', saya ingin bertanya tentang paket wisata')
  : 'kontak.php';
$footerSocialLinks = [
  'instagram' => trim((string)$profilKontak['instagram']),
  'facebook' => trim((string)$profilKontak['facebook']),
  'youtube' => trim((string)$profilKontak['youtube']),
  'twitter' => trim((string)$profilKontak['twitter']),
  'linkedin' => trim((string)$profilKontak['linkedin']),
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Primary Meta Tags -->
  <title>SnD Tour Travel — Liburan Pasti Berangkat | Travel Agent Surabaya</title>
  <meta name="title" content="SnD Tour Travel — Liburan Pasti Berangkat | Travel Agent Surabaya">
  <meta name="description" content="SnD Tour Travel adalah travel agent terpercaya di Surabaya sejak 2017. Menyediakan paket wisata domestik &amp; Asia, outbond, dan catering. Liburan Pasti Berangkat!">
  <meta name="keywords" content="travel agent surabaya, paket wisata, tour domestik, tour asia, outbond, catering, liburan, SnD Tour">
  <meta name="author" content="SnD Tour Travel">
  <meta name="robots" content="index, follow">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://sndtour.com/">
  <meta property="og:title" content="SnD Tour Travel — Liburan Pasti Berangkat">
  <meta property="og:description" content="Travel agent terpercaya di Surabaya. Paket wisata domestik &amp; Asia, outbond, dan catering dengan harga terjangkau.">
  <meta property="og:image" content="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="SnD Tour Travel">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://sndtour.com/">
  <meta property="twitter:title" content="SnD Tour Travel — Liburan Pasti Berangkat">
  <meta property="twitter:description" content="Travel agent terpercaya di Surabaya. Paket wisata domestik &amp; Asia, outbond, dan catering dengan harga terjangkau.">
  <meta property="twitter:image" content="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%23008080'/%3E%3Ctext x='50' y='68' text-anchor='middle' fill='white' font-family='Georgia' font-size='48' font-weight='bold'%3ESnD%3C/text%3E%3C/svg%3E">

  <!-- Canonical -->
  <link rel="canonical" href="https://sndtour.com/">

  <!-- Google Fonts Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Schema.org LocalBusiness -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "TravelAgency",
    "name": "SnD Tour Travel",
    "alternateName": "SnD Tour",
    "url": "https://sndtour.com",
    "logo": "https://sndtour.com/images/logo.png",
    "description": "Travel agent terpercaya di Surabaya sejak 2017. Menyediakan paket wisata domestik & Asia, outbond, dan catering.",
    "foundingDate": "2017",
    "slogan": "Liburan Pasti Berangkat",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Jl. Raya Darmo No. 123",
      "addressLocality": "Surabaya",
      "addressRegion": "Jawa Timur",
      "postalCode": "60241",
      "addressCountry": "ID"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "-7.2904",
      "longitude": "112.7382"
    },
    "telephone": "+6281234567890",
    "email": "info@sndtour.com",
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
      "opens": "09:00",
      "closes": "17:00"
    },
    "sameAs": [
      "https://instagram.com/sndtour",
      "https://facebook.com/sndtour"
    ],
    "priceRange": "$$",
    "areaServed": {
      "@type": "Country",
      "name": "Indonesia"
    }
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
            <a href="index.php" class="nav__link nav__link--active">HOME</a>
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

          <!-- PAKET WISATA (Dropdown) -->
          <li class="nav__item">
            <a href="paket-wisata.php" class="nav__link">
              PAKET WISATA
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <div class="nav__dropdown">
              <a href="paket-wisata.php?kategori=domestik" class="nav__dropdown-link">Domestik</a>
              <a href="paket-wisata.php?kategori=asia" class="nav__dropdown-link">Asia</a>
            </div>
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
       HERO SECTION
       ============================================================ -->
  <section class="hero" id="hero">
    <!-- Slider Background Images -->
    <div class="hero__slider">
      <div class="hero__slide hero__slide--active">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80" alt="Pantai tropis dengan pasir putih dan air laut biru jernih" class="hero__slide-img" loading="eager">
      </div>
      <div class="hero__slide">
        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1200&q=80" alt="Danau di pegunungan dengan pemandangan alam hijau" class="hero__slide-img" loading="lazy">
      </div>
      <div class="hero__slide">
        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=1200&q=80" alt="Pantai eksotis dengan ombak tenang saat senja" class="hero__slide-img" loading="lazy">
      </div>
      <div class="hero__slide">
        <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?w=1200&q=80" alt="Pemandangan pantai tropis dari atas tebing" class="hero__slide-img" loading="lazy">
      </div>
    </div>

    <!-- Gradient Overlay -->
    <div class="hero__overlay"></div>

    <!-- Hero Content -->
    <div class="hero__content container">
      <span class="hero__eyebrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        Travel Agent Surabaya Sejak 2017
      </span>
      <h1 class="hero__title">Liburan <em>Pasti</em> Berangkat</h1>
      <p class="hero__subtitle">Wujudkan liburan impian Anda bersama SnD Tour Travel. Paket wisata domestik &amp; Asia yang terencana, fleksibel, dan transparan untuk pengalaman tak terlupakan.</p>
      <div class="hero__actions">
        <a href="profil.php" class="btn btn--primary btn--lg">TENTANG KAMI</a>
        <a href="#search-section" class="btn btn--outline-light btn--lg">CARI TOUR</a>
      </div>
    </div>

    <!-- Dot Navigation -->
    <div class="hero__nav" aria-label="Navigasi slider">
      <button class="hero__nav-dot hero__nav-dot--active" aria-label="Slide 1"></button>
      <button class="hero__nav-dot" aria-label="Slide 2"></button>
      <button class="hero__nav-dot" aria-label="Slide 3"></button>
      <button class="hero__nav-dot" aria-label="Slide 4"></button>
    </div>

    <!-- Wave SVG Divider -->
    <div class="hero__wave">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
        <path fill="#FFFFFF" d="M0,64 C240,120 480,20 720,64 C960,108 1200,20 1440,64 L1440,120 L0,120 Z"></path>
      </svg>
    </div>
  </section>

  <!-- ============================================================
       SEARCH SECTION
       ============================================================ -->
  <section class="search-section" id="search-section">
    <div class="search-box">
      <div class="search-box__field">
        <label class="search-box__label" for="searchCategory">Kategori</label>
        <select class="search-box__select" id="searchCategory" name="kategori">
          <option value="">Semua Kategori</option>
          <option value="domestik">Domestik</option>
          <option value="asia">Asia</option>
        </select>
      </div>
      <div class="search-box__field">
        <label class="search-box__label" for="searchKeyword">Destinasi / Kata Kunci</label>
        <input type="text" class="search-box__input" id="searchKeyword" name="q" placeholder="Cari destinasi, paket, atau kata kunci...">
      </div>
      <div class="search-box__btn">
        <button class="btn btn--dark" type="button" aria-label="Cari paket wisata">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          CARI
        </button>
      </div>
    </div>
  </section>

  <!-- ============================================================
       PAKET TERBARU
       ============================================================ -->
  <section class="section packages reveal" id="paket-terbaru">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Destinasi Unggulan</span>
        <h2 class="section-header__title">Paket Terbaru</h2>
        <p class="section-header__subtitle">Temukan pengalaman wisata terbaik bersama kami dengan harga yang terjangkau dan layanan prima.</p>
        <div class="section-header__line"></div>
      </div>
      <div class="packages__grid">
        <?php if (!empty($paketTerbaru)): ?>
          <?php foreach ($paketTerbaru as $index => $paket): ?>
            <?php
              $delayClass = 'reveal--delay-' . (($index % 6) + 1);
              $namaPaket = htmlspecialchars($paket['nama_paket']);
              $durasi = htmlspecialchars($paket['durasi']);
              $lokasi = htmlspecialchars($paket['lokasi']);
              $label = trim((string)$paket['label']) !== '' ? htmlspecialchars($paket['label']) : 'Paket';
              $gambar = htmlspecialchars(lp_resolve_gambar($paket['gambar']));
            ?>
            <article class="card reveal <?php echo $delayClass; ?>" data-category="paket">
              <a href="detail-paket.php?id=<?php echo (int)$paket['id']; ?>">
                <div class="card__image">
                  <img src="<?php echo $gambar; ?>" alt="<?php echo $namaPaket; ?>" loading="lazy" width="600" height="375">
                  <span class="card__badge"><?php echo $label; ?></span>
                </div>
              </a>
              <div class="card__body">
                <span class="card__category">Paket Wisata</span>
                <h3 class="card__title"><a href="detail-paket.php?id=<?php echo (int)$paket['id']; ?>"><?php echo $namaPaket; ?></a></h3>
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
                  <span class="card__price-value"><?php echo lp_format_harga($paket['harga']); ?></span>
                </div>
                <div class="card__footer">
                  <a href="detail-paket.php?id=<?php echo (int)$paket['id']; ?>" class="btn btn--secondary btn--sm">LIHAT DETAIL</a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="grid-column:1/-1;text-align:center;color:#64748b;">Belum ada paket wisata. Silakan tambah paket dari dashboard.</p>
        <?php endif; ?>

      </div>

      <div class="packages__more">
        <a href="paket-wisata.php" class="btn btn--dark">VIEW MORE</a>
      </div>
    </div>
  </section>

  <!-- ============================================================
       KATEGORI WISATA
       ============================================================ -->
  <section class="section categories reveal" id="kategori-wisata">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Eksplorasi</span>
        <h2 class="section-header__title">Jelajahi Kategori Wisata</h2>
        <p class="section-header__subtitle">Pilih kategori wisata sesuai minat dan kebutuhan perjalanan Anda.</p>
        <div class="section-header__line"></div>
      </div>
      <div class="categories__grid">

        <?php if (!empty($kategoriWisata)): ?>
          <?php foreach ($kategoriWisata as $index => $kategori): ?>
            <?php
              $kategoriNama = htmlspecialchars($kategori['nama_kategori']);
              $kategoriSlug = htmlspecialchars($kategori['slug']);
              $kategoriImage = htmlspecialchars(lp_kategori_image($kategori['slug']));
              $jumlahPaket = (int)$kategori['jumlah_paket'];
              $delayClass = 'reveal--delay-' . (($index % 6) + 1);
            ?>
            <a href="paket-wisata.php?kategori=<?php echo $kategoriSlug; ?>" class="category-card reveal <?php echo $delayClass; ?>">
              <img src="<?php echo $kategoriImage; ?>" alt="<?php echo $kategoriNama; ?>" class="category-card__img" loading="lazy">
              <div class="category-card__overlay"></div>
              <div class="category-card__content">
                <svg class="category-card__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21 12 3l7 18"/><path d="M8 14h8"/></svg>
                <h3 class="category-card__title"><?php echo $kategoriNama; ?></h3>
                <span class="category-card__count"><?php echo $jumlahPaket; ?> Paket Tersedia</span>
              </div>
            </a>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="grid-column:1/-1;text-align:center;color:#64748b;">Belum ada kategori wisata. Silakan tambah kategori dari dashboard.</p>
        <?php endif; ?>

      </div>
    </div>
  </section>

  <!-- ============================================================
       TESTIMONI
       ============================================================ -->
  <section class="section testimonials reveal" id="testimoni">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow" style="color:var(--cyan-muted);">Testimoni</span>
        <h2 class="section-header__title section-header__title--white">Apa Kata Mereka?</h2>
        <p class="section-header__subtitle section-header__subtitle--light">Cerita pengalaman dari pelanggan setia kami yang telah merasakan liburan bersama SnD Tour Travel.</p>
        <div class="section-header__line"></div>
      </div>

      <div class="testimonials__slider">
        <?php foreach ($testimoniLanding as $item): ?>
          <?php
            $namaPelanggan = htmlspecialchars($item['nama_pelanggan'], ENT_QUOTES, 'UTF-8');
            $pesan = htmlspecialchars($item['pesan'], ENT_QUOTES, 'UTF-8');
            $initials = lp_testimoni_initial($item['nama_pelanggan']);
            $ratingHtml = lp_render_rating($item['rating']);
            $tanggal = date('d M Y', strtotime($item['tanggal']));
          ?>
          <div class="testimonial-card">
            <p class="testimonial-card__quote"><?php echo $pesan; ?></p>
            <div class="testimonial-card__author">
              <div class="testimonial-card__avatar"><?php echo $initials; ?></div>
              <div>
                <div class="testimonial-card__name"><?php echo $namaPelanggan; ?></div>
                <div class="testimonial-card__package">Testimoni Pelanggan • <?php echo $tanggal; ?></div>
              </div>
              <div class="testimonial-card__stars">
                <?php echo $ratingHtml; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Testimonial Controls -->
      <div class="testimonials__controls">
        <?php $isSingle = count($testimoniLanding) <= 1; ?>
        <button class="testimonials__arrow testimonials__arrow--prev" aria-label="Testimoni sebelumnya" <?php echo $isSingle ? 'disabled aria-hidden="true"' : ''; ?>>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="testimonials__dots">
          <?php foreach ($testimoniLanding as $index => $item): ?>
            <button class="testimonials__dot <?php echo $index === 0 ? 'testimonials__dot--active' : ''; ?>" aria-label="Testimoni <?php echo $index + 1; ?>"></button>
          <?php endforeach; ?>
        </div>
        <button class="testimonials__arrow testimonials__arrow--next" aria-label="Testimoni berikutnya" <?php echo $isSingle ? 'disabled aria-hidden="true"' : ''; ?>>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
      </div>
    </div>
  </section>

  <!-- ============================================================
       PARTNER & KLIEN
       ============================================================ -->
  <section class="section partners reveal" id="partner">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Mitra Terpercaya</span>
        <h2 class="section-header__title">Partner Maskapai</h2>
        <p class="section-header__subtitle">Kami bekerja sama dengan maskapai penerbangan terkemuka untuk memastikan perjalanan Anda nyaman dan aman.</p>
        <div class="section-header__line"></div>
      </div>

      <!-- Airline Partner Logos -->
      <div class="partners__logos">
        <div class="partner-logo" title="Garuda Indonesia">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-display);font-weight:700;font-size:12px;color:var(--teal-dark);text-align:center;line-height:1.2;">Garuda<br>Indonesia</span>
          </div>
        </div>
        <div class="partner-logo" title="Lion Air">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-display);font-weight:700;font-size:13px;color:var(--coral);text-align:center;line-height:1.2;">Lion Air</span>
          </div>
        </div>
        <div class="partner-logo" title="Citilink">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-display);font-weight:700;font-size:13px;color:var(--emerald);text-align:center;line-height:1.2;">Citilink</span>
          </div>
        </div>
        <div class="partner-logo" title="AirAsia">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-display);font-weight:700;font-size:13px;color:var(--coral);text-align:center;line-height:1.2;">AirAsia</span>
          </div>
        </div>
        <div class="partner-logo" title="Singapore Airlines">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-display);font-weight:700;font-size:11px;color:var(--teal-dark);text-align:center;line-height:1.2;">Singapore<br>Airlines</span>
          </div>
        </div>
        <div class="partner-logo" title="Malaysia Airlines">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-display);font-weight:700;font-size:11px;color:var(--teal-dark);text-align:center;line-height:1.2;">Malaysia<br>Airlines</span>
          </div>
        </div>
      </div>

      <!-- Client Logos -->
      <div class="section-header" style="margin-bottom:var(--space-8);">
        <h3 class="section-header__title" style="font-size:var(--text-2xl);">Klien Kami</h3>
        <p class="section-header__subtitle">Dipercaya oleh berbagai perusahaan dan instansi di Indonesia.</p>
      </div>
      <div class="partners__logos">
        <div class="partner-logo" title="PT Telkom Indonesia">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-body);font-weight:600;font-size:11px;color:var(--gray-500);text-align:center;line-height:1.2;">PT Telkom<br>Indonesia</span>
          </div>
        </div>
        <div class="partner-logo" title="Bank BCA">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-body);font-weight:600;font-size:13px;color:var(--gray-500);text-align:center;line-height:1.2;">Bank BCA</span>
          </div>
        </div>
        <div class="partner-logo" title="Pertamina">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-body);font-weight:600;font-size:12px;color:var(--gray-500);text-align:center;line-height:1.2;">Pertamina</span>
          </div>
        </div>
        <div class="partner-logo" title="Unilever">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-body);font-weight:600;font-size:12px;color:var(--gray-500);text-align:center;line-height:1.2;">Unilever</span>
          </div>
        </div>
        <div class="partner-logo" title="PLN">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-body);font-weight:600;font-size:14px;color:var(--gray-500);text-align:center;line-height:1.2;">PLN</span>
          </div>
        </div>
        <div class="partner-logo" title="Astra International">
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--light-gray);border-radius:var(--radius-md);padding:8px;">
            <span style="font-family:var(--font-body);font-weight:600;font-size:11px;color:var(--gray-500);text-align:center;line-height:1.2;">Astra<br>International</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       CARA PESAN
       ============================================================ -->
  <section class="section how-to reveal" id="cara-pesan">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Mudah &amp; Cepat</span>
        <h2 class="section-header__title">Cara Memesan</h2>
        <p class="section-header__subtitle">Hanya 4 langkah mudah untuk memulai liburan impian Anda bersama SnD Tour Travel.</p>
        <div class="section-header__line"></div>
      </div>
      <div class="how-to__steps">

        <!-- Step 1 -->
        <div class="step-card reveal reveal--delay-1">
          <div class="step-card__number">1</div>
          <h3 class="step-card__title">Pilih Paket</h3>
          <p class="step-card__text">Jelajahi dan pilih paket wisata yang diinginkan dari katalog kami.</p>
        </div>

        <!-- Step 2 -->
        <div class="step-card reveal reveal--delay-2">
          <div class="step-card__number">2</div>
          <h3 class="step-card__title">Hubungi Kami</h3>
          <p class="step-card__text">Chat WhatsApp atau email untuk konsultasi lebih lanjut dengan tim kami.</p>
        </div>

        <!-- Step 3 -->
        <div class="step-card reveal reveal--delay-3">
          <div class="step-card__number">3</div>
          <h3 class="step-card__title">Sesuaikan</h3>
          <p class="step-card__text">Diskusikan detail dan penyesuaian kebutuhan sesuai keinginan Anda.</p>
        </div>

        <!-- Step 4 -->
        <div class="step-card reveal reveal--delay-4">
          <div class="step-card__number">4</div>
          <h3 class="step-card__title">Berangkat!</h3>
          <p class="step-card__text">Konfirmasi pembayaran dan liburan pasti berangkat! Tinggal nikmati.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- ============================================================
       CTA BANNER
       ============================================================ -->
  <section class="cta-banner reveal" id="cta-banner">
    <div class="cta-banner__content">
      <h2 class="cta-banner__title">Siap Berlibur?</h2>
      <p class="cta-banner__text">Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan wujudkan liburan impian Anda bersama <?php echo htmlspecialchars($profilNamaPerusahaan); ?>.</p>
      <a href="<?php echo htmlspecialchars($whatsappCtaUrl); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">
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
          <h3 class="footer__brand-name"><?php echo htmlspecialchars($profilNamaPerusahaan); ?></h3>
          <p class="footer__brand-tagline">Liburan Pasti Berangkat</p>
          <p class="footer__brand-text"><?php echo htmlspecialchars($profilTentang); ?></p>
          <?php if (array_filter($footerSocialLinks)): ?>
            <div class="footer__social">
              <?php if ($footerSocialLinks['instagram'] !== ''): ?>
                <a href="<?php echo htmlspecialchars($footerSocialLinks['instagram']); ?>" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram <?php echo htmlspecialchars($profilNamaPerusahaan); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
              <?php endif; ?>
              <?php if ($footerSocialLinks['facebook'] !== ''): ?>
                <a href="<?php echo htmlspecialchars($footerSocialLinks['facebook']); ?>" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook <?php echo htmlspecialchars($profilNamaPerusahaan); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
              <?php endif; ?>
              <?php if ($footerSocialLinks['youtube'] !== ''): ?>
                <a href="<?php echo htmlspecialchars($footerSocialLinks['youtube']); ?>" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="YouTube <?php echo htmlspecialchars($profilNamaPerusahaan); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
                </a>
              <?php endif; ?>
              <?php if ($footerSocialLinks['twitter'] !== ''): ?>
                <a href="<?php echo htmlspecialchars($footerSocialLinks['twitter']); ?>" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Twitter <?php echo htmlspecialchars($profilNamaPerusahaan); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.657l-5.214-6.817-5.966 6.817H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>
                </a>
              <?php endif; ?>
              <?php if ($footerSocialLinks['linkedin'] !== ''): ?>
                <a href="<?php echo htmlspecialchars($footerSocialLinks['linkedin']); ?>" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn <?php echo htmlspecialchars($profilNamaPerusahaan); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.85-3.037-1.853 0-2.136 1.447-2.136 2.941v5.665H9.352V9h3.414v1.561h.049c.476-.9 1.637-1.85 3.368-1.85 3.602 0 4.267 2.371 4.267 5.455v6.286ZM5.337 7.433a2.062 2.062 0 1 1 0-4.124 2.062 2.062 0 0 1 0 4.124ZM7.114 20.452H3.558V9h3.556v11.452Z"/></svg>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Column 2: Layanan -->
        <div>
          <h4 class="footer__heading">Layanan</h4>
          <nav class="footer__links" aria-label="Layanan SnD Tour">
            <a href="paket-wisata.php" class="footer__link">Paket Wisata</a>
            <a href="galeri.php" class="footer__link">Galeri</a>
          </nav>
        </div>

        <!-- Column 3: Kategori Tour -->
        <div>
          <h4 class="footer__heading">Kategori Tour</h4>
          <nav class="footer__links" aria-label="Kategori Tour">
            <?php if (!empty($kategoriWisata)): ?>
              <?php foreach ($kategoriWisata as $kategori): ?>
                <?php
                  $kategoriNama = htmlspecialchars($kategori['nama_kategori']);
                  $kategoriSlug = htmlspecialchars($kategori['slug']);
                ?>
                <a href="paket-wisata.php?kategori=<?php echo $kategoriSlug; ?>" class="footer__link"><?php echo $kategoriNama; ?></a>
              <?php endforeach; ?>
            <?php else: ?>
              <span class="footer__link">Belum ada kategori</span>
            <?php endif; ?>
          </nav>
        </div>

        <!-- Column 4: Kontak -->
        <div>
          <h4 class="footer__heading">Kontak</h4>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span><?php echo nl2br(htmlspecialchars($profilAlamat)); ?></span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span><?php echo htmlspecialchars($profilTelepon); ?></span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <span><?php echo htmlspecialchars($profilEmail); ?></span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>Senin - Sabtu<br>09.00 - 17.00 WIB</span>
          </div>
        </div>

      </div>

      <!-- Footer Bottom Bar -->
      <div class="footer__bottom">
        <p class="footer__copyright">&copy; 2026 <?php echo htmlspecialchars($profilNamaPerusahaan); ?>. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- ============================================================
       WHATSAPP FAB
       ============================================================ -->
  <div class="wa-fab" id="waFab">
    <span class="wa-fab__tooltip">Chat dengan kami</span>
    <a href="<?php echo htmlspecialchars($whatsappFabUrl); ?>" class="wa-fab__btn" target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp dengan <?php echo htmlspecialchars($profilNamaPerusahaan); ?>">
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
