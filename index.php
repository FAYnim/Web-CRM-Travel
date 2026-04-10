<?php
require_once __DIR__ . '/config.php';

$paketTerbaru = [];
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

          <!-- OUTBOND -->
          <li class="nav__item">
            <a href="outbond.php" class="nav__link">OUTBOND</a>
          </li>

          <!-- CATERING -->
          <li class="nav__item">
            <a href="catering.php" class="nav__link">CATERING</a>
          </li>

          <!-- BLOG -->
          <li class="nav__item">
            <a href="blog.php" class="nav__link">BLOG</a>
          </li>

          <!-- GALERI -->
          <li class="nav__item">
            <a href="galeri.php" class="nav__link">GALERI</a>
          </li>

          <!-- KONTAK -->
          <li class="nav__item">
            <a href="kontak.php" class="nav__link">KONTAK</a>
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
          <option value="outbond">Outbond</option>
          <option value="catering">Catering</option>
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
       VALUE PROPOSITION
       ============================================================ -->
  <section class="section values reveal" id="values">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Mengapa Memilih Kami</span>
        <h2 class="section-header__title">Keunggulan SnD Tour Travel</h2>
        <p class="section-header__subtitle">Kami hadir untuk memberikan pengalaman perjalanan terbaik dengan layanan profesional dan harga terjangkau.</p>
        <div class="section-header__line"></div>
      </div>
      <div class="values__grid">
        <!-- Value 1: Efisien & Terencana -->
        <div class="value-card reveal reveal--delay-1">
          <div class="value-card__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
              <line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/>
              <line x1="3" y1="10" x2="21" y2="10"/>
              <path d="M9 16l2 2 4-4"/>
            </svg>
          </div>
          <h3 class="value-card__title">Efisien &amp; Terencana</h3>
          <p class="value-card__text">Perjalanan sudah dijadwalkan rapi sehingga waktu lebih optimal dan tidak membingungkan. Nikmati liburan tanpa ribet!</p>
        </div>
        <!-- Value 2: Fleksibel Sesuai Budget -->
        <div class="value-card reveal reveal--delay-2">
          <div class="value-card__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="4" width="20" height="16" rx="2"/>
              <path d="M2 10h20"/>
              <path d="M6 16h4"/>
              <path d="M14 16h4"/>
            </svg>
          </div>
          <h3 class="value-card__title">Fleksibel Sesuai Budget</h3>
          <p class="value-card__text">Paket bisa disesuaikan dengan anggaran tanpa mengorbankan kenyamanan dan kebahagiaan. Budget pas, liburan puas!</p>
        </div>
        <!-- Value 3: Custom & Transparan -->
        <div class="value-card reveal reveal--delay-3">
          <div class="value-card__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <h3 class="value-card__title">Custom &amp; Transparan</h3>
          <p class="value-card__text">Destinasi, penginapan, dan transportasi disepakati bersama sesuai kebutuhan klien. Tanpa biaya tersembunyi!</p>
        </div>
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
       TOUR SPESIAL LIBURAN
       ============================================================ -->
  <section class="section special-tours reveal" id="tour-spesial">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Momen Spesial</span>
        <h2 class="section-header__title">Tour Spesial Liburan</h2>
        <p class="section-header__subtitle">Paket khusus untuk momen berharga Anda bersama keluarga dan orang tersayang.</p>
        <div class="section-header__line"></div>
      </div>
      <div class="special-tours__scroll">

        <!-- Tahun Baru -->
        <article class="card">
          <a href="paket-wisata.php?kategori=tahun-baru">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=80" alt="Pantai untuk perayaan Tahun Baru" loading="lazy" width="500" height="313">
              <span class="card__badge--teal" style="position:absolute;top:var(--space-3);left:var(--space-3);padding:4px 14px;font-size:var(--text-xs);font-weight:600;border-radius:var(--radius-full);background:var(--teal-primary);color:var(--near-black);text-transform:uppercase;letter-spacing:0.5px;z-index:2;">Tahun Baru</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Spesial Liburan</span>
            <h3 class="card__title"><a href="paket-wisata.php?kategori=tahun-baru">Paket Tahun Baru</a></h3>
            <p class="card__text">Rayakan pergantian tahun di destinasi impian dengan keluarga dan sahabat.</p>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 3.500.000</span>
            </div>
            <a href="paket-wisata.php?kategori=tahun-baru" class="btn btn--secondary btn--sm btn--full">LIHAT PAKET</a>
          </div>
        </article>

        <!-- Natal -->
        <article class="card">
          <a href="paket-wisata.php?kategori=natal">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=500&q=80" alt="Liburan Natal di pegunungan" loading="lazy" width="500" height="313">
              <span class="card__badge--teal" style="position:absolute;top:var(--space-3);left:var(--space-3);padding:4px 14px;font-size:var(--text-xs);font-weight:600;border-radius:var(--radius-full);background:var(--coral);color:var(--white);text-transform:uppercase;letter-spacing:0.5px;z-index:2;">Natal</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Spesial Liburan</span>
            <h3 class="card__title"><a href="paket-wisata.php?kategori=natal">Paket Natal</a></h3>
            <p class="card__text">Rayakan natal dengan suasana berbeda di destinasi wisata pilihan.</p>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 4.200.000</span>
            </div>
            <a href="paket-wisata.php?kategori=natal" class="btn btn--secondary btn--sm btn--full">LIHAT PAKET</a>
          </div>
        </article>

        <!-- Idul Fitri -->
        <article class="card">
          <a href="paket-wisata.php?kategori=idul-fitri">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=500&q=80" alt="Liburan Idul Fitri bersama keluarga" loading="lazy" width="500" height="313">
              <span class="card__badge--teal" style="position:absolute;top:var(--space-3);left:var(--space-3);padding:4px 14px;font-size:var(--text-xs);font-weight:600;border-radius:var(--radius-full);background:var(--emerald);color:var(--white);text-transform:uppercase;letter-spacing:0.5px;z-index:2;">Idul Fitri</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Spesial Liburan</span>
            <h3 class="card__title"><a href="paket-wisata.php?kategori=idul-fitri">Paket Idul Fitri</a></h3>
            <p class="card__text">Libur Lebaran semakin bermakna dengan wisata bersama keluarga besar.</p>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 3.800.000</span>
            </div>
            <a href="paket-wisata.php?kategori=idul-fitri" class="btn btn--secondary btn--sm btn--full">LIHAT PAKET</a>
          </div>
        </article>

        <!-- Libur Sekolah -->
        <article class="card">
          <a href="paket-wisata.php?kategori=libur-sekolah">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?w=500&q=80" alt="Liburan sekolah di pantai" loading="lazy" width="500" height="313">
              <span class="card__badge--teal" style="position:absolute;top:var(--space-3);left:var(--space-3);padding:4px 14px;font-size:var(--text-xs);font-weight:600;border-radius:var(--radius-full);background:var(--amber);color:var(--near-black);text-transform:uppercase;letter-spacing:0.5px;z-index:2;">Libur Sekolah</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Spesial Liburan</span>
            <h3 class="card__title"><a href="paket-wisata.php?kategori=libur-sekolah">Paket Libur Sekolah</a></h3>
            <p class="card__text">Isi liburan sekolah anak dengan petualangan seru dan edukatif.</p>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 2.900.000</span>
            </div>
            <a href="paket-wisata.php?kategori=libur-sekolah" class="btn btn--secondary btn--sm btn--full">LIHAT PAKET</a>
          </div>
        </article>

        <!-- Imlek -->
        <article class="card">
          <a href="paket-wisata.php?kategori=imlek">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=500&q=80" alt="Liburan Imlek ke destinasi favorit" loading="lazy" width="500" height="313">
              <span class="card__badge--teal" style="position:absolute;top:var(--space-3);left:var(--space-3);padding:4px 14px;font-size:var(--text-xs);font-weight:600;border-radius:var(--radius-full);background:var(--coral);color:var(--white);text-transform:uppercase;letter-spacing:0.5px;z-index:2;">Imlek</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Spesial Liburan</span>
            <h3 class="card__title"><a href="paket-wisata.php?kategori=imlek">Paket Imlek</a></h3>
            <p class="card__text">Sambut tahun baru Imlek dengan liburan istimewa bersama keluarga.</p>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 5.100.000</span>
            </div>
            <a href="paket-wisata.php?kategori=imlek" class="btn btn--secondary btn--sm btn--full">LIHAT PAKET</a>
          </div>
        </article>

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

        <!-- Wisata Religi -->
        <a href="paket-wisata.php?kategori=religi" class="category-card reveal reveal--delay-1">
          <img src="https://images.unsplash.com/photo-1564415637254-92c66292cd64?w=600&q=80" alt="Wisata Religi - Masjid dan tempat ibadah" class="category-card__img" loading="lazy">
          <div class="category-card__overlay"></div>
          <div class="category-card__content">
            <svg class="category-card__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 12h3v8h6v-6h2v6h6v-8h3L12 2z"/></svg>
            <h3 class="category-card__title">Wisata Religi</h3>
            <span class="category-card__count">12 Paket Tersedia</span>
          </div>
        </a>

        <!-- Wisata Edukasi -->
        <a href="paket-wisata.php?kategori=edukasi" class="category-card reveal reveal--delay-2">
          <img src="https://images.unsplash.com/photo-1580477667995-2b94f01c9516?w=600&q=80" alt="Wisata Edukasi - Belajar dan berwisata" class="category-card__img" loading="lazy">
          <div class="category-card__overlay"></div>
          <div class="category-card__content">
            <svg class="category-card__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            <h3 class="category-card__title">Wisata Edukasi</h3>
            <span class="category-card__count">8 Paket Tersedia</span>
          </div>
        </a>

        <!-- Bulan Madu -->
        <a href="paket-wisata.php?kategori=bulan-madu" class="category-card reveal reveal--delay-3">
          <img src="https://images.unsplash.com/photo-1546514355-7fdc90ccbd03?w=600&q=80" alt="Bulan Madu - Romantis di pantai" class="category-card__img" loading="lazy">
          <div class="category-card__overlay"></div>
          <div class="category-card__content">
            <svg class="category-card__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            <h3 class="category-card__title">Bulan Madu</h3>
            <span class="category-card__count">10 Paket Tersedia</span>
          </div>
        </a>

        <!-- Wisata Keluarga -->
        <a href="paket-wisata.php?kategori=keluarga" class="category-card reveal reveal--delay-4">
          <img src="https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?w=600&q=80" alt="Wisata Keluarga - Berlibur bersama" class="category-card__img" loading="lazy">
          <div class="category-card__overlay"></div>
          <div class="category-card__content">
            <svg class="category-card__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <h3 class="category-card__title">Wisata Keluarga</h3>
            <span class="category-card__count">15 Paket Tersedia</span>
          </div>
        </a>

        <!-- Wisata Perusahaan -->
        <a href="paket-wisata.php?kategori=perusahaan" class="category-card reveal reveal--delay-5">
          <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?w=600&q=80" alt="Wisata Perusahaan - Team building dan outing" class="category-card__img" loading="lazy">
          <div class="category-card__overlay"></div>
          <div class="category-card__content">
            <svg class="category-card__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            <h3 class="category-card__title">Wisata Perusahaan</h3>
            <span class="category-card__count">7 Paket Tersedia</span>
          </div>
        </a>

        <!-- Wisata Adventure -->
        <a href="paket-wisata.php?kategori=adventure" class="category-card reveal reveal--delay-6">
          <img src="https://images.unsplash.com/photo-1533130061792-64b345e4a833?w=600&q=80" alt="Wisata Adventure - Petualangan alam" class="category-card__img" loading="lazy">
          <div class="category-card__overlay"></div>
          <div class="category-card__content">
            <svg class="category-card__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            <h3 class="category-card__title">Wisata Adventure</h3>
            <span class="category-card__count">9 Paket Tersedia</span>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- ============================================================
       BLOG / ARTIKEL
       ============================================================ -->
  <section class="section blog reveal" id="blog">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Blog &amp; Artikel</span>
        <h2 class="section-header__title">Tips &amp; Inspirasi Perjalanan</h2>
        <p class="section-header__subtitle">Temukan informasi menarik, tips traveling, dan inspirasi destinasi untuk liburan Anda berikutnya.</p>
        <div class="section-header__line"></div>
      </div>
      <div class="blog__grid">

        <!-- Blog Card 1 -->
        <article class="card blog-card reveal reveal--delay-1">
          <a href="blog-detail.php">
            <div class="blog-card__image card__image">
              <img src="https://images.unsplash.com/photo-1574227492706-f65b24c3688a?w=600&q=80" alt="Tips packing efisien untuk liburan" loading="lazy" width="600" height="375">
              <span class="card__badge card__badge--teal">Tips</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Tips Traveling</span>
            <h3 class="card__title"><a href="blog-detail.php">10 Tips Packing Efisien untuk Liburan Panjang</a></h3>
            <p class="card__text">Packing tidak perlu ribet! Ikuti tips berikut agar koper Anda tetap ringan namun semua kebutuhan terpenuhi selama liburan.</p>
            <div class="card__footer">
              <span class="blog-card__date">15 Februari 2026</span>
              <a href="blog-detail.php" class="blog-card__link">
                Baca Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
            </div>
          </div>
        </article>

        <!-- Blog Card 2 -->
        <article class="card blog-card reveal reveal--delay-2">
          <a href="blog-detail.php">
            <div class="blog-card__image card__image">
              <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=600&q=80" alt="Destinasi wisata tersembunyi di Indonesia" loading="lazy" width="600" height="375">
              <span class="card__badge card__badge--teal">Destinasi</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Fun Facts Destinasi</span>
            <h3 class="card__title"><a href="blog-detail.php">5 Destinasi Tersembunyi di Indonesia Timur</a></h3>
            <p class="card__text">Indonesia Timur menyimpan keindahan alam yang luar biasa. Berikut 5 destinasi tersembunyi yang wajib Anda kunjungi.</p>
            <div class="card__footer">
              <span class="blog-card__date">10 Februari 2026</span>
              <a href="blog-detail.php" class="blog-card__link">
                Baca Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
            </div>
          </div>
        </article>

        <!-- Blog Card 3 -->
        <article class="card blog-card reveal reveal--delay-3">
          <a href="blog-detail.php">
            <div class="blog-card__image card__image">
              <img src="https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=600&q=80" alt="Panduan wisata hemat ke Singapura" loading="lazy" width="600" height="375">
              <span class="card__badge card__badge--teal">Panduan</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Panduan Wisata</span>
            <h3 class="card__title"><a href="blog-detail.php">Panduan Lengkap Wisata Hemat ke Singapura</a></h3>
            <p class="card__text">Berlibur ke Singapura tidak harus mahal! Simak panduan lengkap kami untuk menikmati Singapura dengan budget terjangkau.</p>
            <div class="card__footer">
              <span class="blog-card__date">5 Februari 2026</span>
              <a href="blog-detail.php" class="blog-card__link">
                Baca Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
            </div>
          </div>
        </article>

      </div>

      <div class="packages__more" style="margin-top:var(--space-12);">
        <a href="blog.php" class="btn btn--secondary">LIHAT SEMUA ARTIKEL</a>
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

        <!-- Testimonial 1 -->
        <div class="testimonial-card">
          <p class="testimonial-card__quote">Pengalaman liburan ke Bali bersama SnD Tour benar-benar luar biasa! Semua sudah terorganisir dengan baik, dari hotel, transportasi, hingga tempat wisata. Tidak perlu pusing mikir apapun, tinggal nikmati saja!</p>
          <div class="testimonial-card__author">
            <div class="testimonial-card__avatar">AS</div>
            <div>
              <div class="testimonial-card__name">Andi Setiawan</div>
              <div class="testimonial-card__package">Pesona Bali 5D4N</div>
            </div>
            <div class="testimonial-card__stars">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="testimonial-card">
          <p class="testimonial-card__quote">Trip ke Singapura bareng SnD Tour seru banget! Guide-nya ramah, hotel strategis, dan itinerary-nya pas. Yang paling berkesan adalah team SnD sangat responsif dan helpful. Pasti balik lagi!</p>
          <div class="testimonial-card__author">
            <div class="testimonial-card__avatar">DP</div>
            <div>
              <div class="testimonial-card__name">Diana Putri</div>
              <div class="testimonial-card__package">Singapore City Tour 4D3N</div>
            </div>
            <div class="testimonial-card__stars">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="testimonial-card">
          <p class="testimonial-card__quote">Kami pakai jasa outbond SnD Tour untuk acara team building kantor dan hasilnya luar biasa memuaskan. Aktivitasnya seru, lokasi bagus, dan timnya sangat profesional. Recommended banget!</p>
          <div class="testimonial-card__author">
            <div class="testimonial-card__avatar">BW</div>
            <div>
              <div class="testimonial-card__name">Budi Wicaksono</div>
              <div class="testimonial-card__package">Outbond Team Building</div>
            </div>
            <div class="testimonial-card__stars">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
          </div>
        </div>

      </div>

      <!-- Testimonial Controls -->
      <div class="testimonials__controls">
        <button class="testimonials__arrow testimonials__arrow--prev" aria-label="Testimoni sebelumnya">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="testimonials__dots">
          <button class="testimonials__dot testimonials__dot--active" aria-label="Testimoni 1"></button>
          <button class="testimonials__dot" aria-label="Testimoni 2"></button>
          <button class="testimonials__dot" aria-label="Testimoni 3"></button>
        </div>
        <button class="testimonials__arrow testimonials__arrow--next" aria-label="Testimoni berikutnya">
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
        <div class="footer__stats">
          <span class="footer__stat">
            <span class="footer__stat-dot"></span>
            Online: <span data-count="12">0</span>
          </span>
          <span class="footer__stat">
            Hari Ini: <span data-count="284">0</span>
          </span>
          <span class="footer__stat">
            Total: <span data-count="158432">0</span>
          </span>
        </div>
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
