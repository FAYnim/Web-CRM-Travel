<?php
require_once __DIR__ . '/config.php';

// Default / Fallback data (Bali Paradise)
$p = [
  'id' => 0,
  'nama_paket' => 'Bali Paradise 5D4N',
  'durasi' => '5D4N',
  'harga' => '4850000',
  'lokasi' => 'Bali, Indonesia',
  'gambar' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1200&q=80',
  'deskripsi' => 'Nikmati keindahan Pulau Dewata dalam paket Bali Paradise 5D4N yang dirancang khusus untuk keluarga. Perjalanan selama 5 hari 4 malam ini akan membawa Anda menjelajahi pesona alam, budaya, dan kuliner terbaik Bali yang tak terlupakan.',
  'label' => 'Wisata Keluarga'
];

// If ID is provided, try to fetch from database
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $package_id = (int)$_GET['id'];
  $stmt = $koneksi->prepare("SELECT * FROM manajemen_paket WHERE id = ?");
  $stmt->bind_param("i", $package_id);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result && $result->num_rows > 0) {
    $p = $result->fetch_assoc();
    if (empty($p['gambar'])) {
      $p['gambar'] = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1200&q=80';
    }
    $p['gambar'] = "dashboard/".$p['gambar'];
  } else {
    // Redirect if ID provided but not found
    header("Location: paket-wisata.php?error=notfound");
    exit;
  }
}

function format_harga($harga) {
  return 'Rp ' . number_format((int)$harga, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Primary Meta Tags -->
  <title><?php echo htmlspecialchars($p['nama_paket']); ?> — SnD Tour Travel | Paket Wisata Terpercaya</title>
  <meta name="title" content="<?php echo htmlspecialchars($p['nama_paket']); ?> — SnD Tour Travel | Paket Wisata Terpercaya">
  <meta name="description" content="<?php echo htmlspecialchars(substr(strip_tags($p['deskripsi']), 0, 160)); ?>...">
  <meta name="keywords" content="paket wisata bali, tour bali 5 hari, liburan bali, paket bali murah, SnD Tour, travel agent surabaya, bali paradise">
  <meta name="author" content="SnD Tour Travel">
  <meta name="robots" content="index, follow">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://sndtour.com/detail-paket.php">
  <meta property="og:title" content="<?php echo htmlspecialchars($p['nama_paket']); ?> — SnD Tour Travel">
  <meta property="og:description" content="<?php echo htmlspecialchars(substr(strip_tags($p['deskripsi']), 0, 160)); ?>...">
  <meta property="og:image" content="<?php echo htmlspecialchars($p['gambar']); ?>">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="SnD Tour Travel">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://sndtour.com/detail-paket.php">
  <meta property="twitter:title" content="<?php echo htmlspecialchars($p['nama_paket']); ?> — SnD Tour Travel">
  <meta property="twitter:description" content="<?php echo htmlspecialchars(substr(strip_tags($p['deskripsi']), 0, 160)); ?>...">
  <meta property="twitter:image" content="<?php echo htmlspecialchars($p['gambar']); ?>">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%23008080'/%3E%3Ctext x='50' y='68' text-anchor='middle' fill='white' font-family='Georgia' font-size='48' font-weight='bold'%3ESnD%3C/text%3E%3C/svg%3E">

  <!-- Canonical -->
  <link rel="canonical" href="https://sndtour.com/detail-paket.php">

  <!-- Google Fonts Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Schema.org Product -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "TouristTrip",
    "name": "<?php echo htmlspecialchars($p['nama_paket']); ?>",
    "description": "<?php echo htmlspecialchars(substr(strip_tags($p['deskripsi']), 0, 200)); ?>",
    "touristType": "Wisata Keluarga",
    "provider": {
      "@type": "TravelAgency",
      "name": "SnD Tour Travel",
      "url": "https://sndtour.com"
    },
    "offers": {
      "@type": "Offer",
      "price": "<?php echo (int)$p['harga']; ?>",
      "priceCurrency": "IDR",
      "availability": "https://schema.org/InStock"
    },
    "itinerary": {
      "@type": "ItemList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Tanah Lot"},
        {"@type": "ListItem", "position": 2, "name": "Uluwatu"},
        {"@type": "ListItem", "position": 3, "name": "Ubud"},
        {"@type": "ListItem", "position": 4, "name": "Kuta"},
        {"@type": "ListItem", "position": 5, "name": "Seminyak"},
        {"@type": "ListItem", "position": 6, "name": "Nusa Dua"}
      ]
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
            <a href="index.php" class="nav__link">HOME</a>
          </li>

          <!-- PROFIL (Dropdown) -->
          <li class="nav__item">
            <a href="profil.php" class="nav__link">
              PROFIL
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <div class="nav__dropdown">
              <a href="profil.php" class="nav__dropdown-link">Tentang Kami</a>
              <a href="profil.php#visi-misi" class="nav__dropdown-link">Visi &amp; Misi</a>
            </div>
          </li>

          <!-- PAKET WISATA (Dropdown) -->
          <li class="nav__item">
            <a href="paket-wisata.php" class="nav__link nav__link--active">
              PAKET WISATA
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <div class="nav__dropdown">
              <a href="paket-wisata.php" class="nav__dropdown-link">Domestik</a>
              <a href="paket-wisata.php" class="nav__dropdown-link">Asia</a>
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
       PAGE HEADER
       ============================================================ -->
  <section class="page-header">
    <div class="page-header__bg">
      <img src="<?php echo htmlspecialchars($p['gambar']); ?>" alt="<?php echo htmlspecialchars($p['nama_paket']); ?>" loading="eager" width="1400" height="700">
    </div>
    <div class="page-header__content container">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span class="breadcrumb__sep">/</span>
        <a href="paket-wisata.php">Paket Wisata</a>
        <span class="breadcrumb__sep">/</span>
        <a href="paket-wisata.php">Domestik</a>
        <span class="breadcrumb__sep">/</span>
        <span><?php echo htmlspecialchars($p['nama_paket']); ?></span>
      </nav>
      <h1 class="page-header__title"><?php echo htmlspecialchars($p['nama_paket']); ?></h1>
      <div style="display:flex;gap:var(--space-3);margin-top:var(--space-4);flex-wrap:wrap;">
        <span style="display:inline-flex;align-items:center;gap:var(--space-2);padding:6px 18px;background:rgba(64,224,208,0.2);border:1px solid rgba(64,224,208,0.4);border-radius:var(--radius-full);font-size:var(--text-xs);font-weight:600;color:var(--teal-primary);text-transform:uppercase;letter-spacing:1px;backdrop-filter:blur(8px);">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          <?php echo htmlspecialchars($p['label'] ?: 'Paket Wisata'); ?>
        </span>
        <span style="display:inline-flex;align-items:center;gap:var(--space-2);padding:6px 18px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);border-radius:var(--radius-full);font-size:var(--text-xs);font-weight:600;color:var(--white);text-transform:uppercase;letter-spacing:1px;backdrop-filter:blur(8px);">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <?php echo htmlspecialchars($p['durasi']); ?>
        </span>
      </div>
    </div>
  </section>

  <!-- ============================================================
       DETAIL CONTENT
       ============================================================ -->
  <section class="section detail">
    <div class="container">
      <div class="detail__layout">

        <!-- ====== MAIN CONTENT ====== -->
        <div class="detail__main">

          <!-- Gallery -->
          <div class="detail__gallery">
            <div class="detail__gallery-main">
              <img src="<?php echo htmlspecialchars($p['gambar']); ?>" alt="<?php echo htmlspecialchars($p['nama_paket']); ?>" loading="eager" width="900" height="506">
            </div>
          </div>

          <!-- Tabs -->
          <div class="detail__tabs" role="tablist">
            <button class="detail__tab detail__tab--active" data-tab="tab-overview" role="tab" aria-selected="true" aria-controls="tab-overview">Overview</button>
            <button class="detail__tab" data-tab="tab-destinasi" role="tab" aria-selected="false" aria-controls="tab-destinasi">Destinasi</button>
            <button class="detail__tab" data-tab="tab-fasilitas" role="tab" aria-selected="false" aria-controls="tab-fasilitas">Fasilitas</button>
            <button class="detail__tab" data-tab="tab-syarat" role="tab" aria-selected="false" aria-controls="tab-syarat">Syarat &amp; Ketentuan</button>
          </div>

          <!-- Tab Content: Overview -->
          <div class="detail__tab-content detail__tab-content--active" id="tab-overview" role="tabpanel">
            <h3>Tentang Paket Ini</h3>
            <div class="tab-description">
              <?php echo nl2br(htmlspecialchars_decode($p['deskripsi'])); ?>
            </div>
          </div>

          <!-- Tab Content: Destinasi -->
          <div class="detail__tab-content" id="tab-destinasi" role="tabpanel">
            <h3>Destinasi yang Dikunjungi</h3>
            <?php if (!empty($p['destinasi'])): ?>
              <p>Berikut adalah destinasi-destinasi pilihan yang akan Anda kunjungi selama perjalanan:</p>
              <div class="tab-description">
                <?php 
                  $destinasi_lines = explode("\n", htmlspecialchars_decode($p['destinasi']));
                  if (count($destinasi_lines) > 1 || strpos($p['destinasi'], '•') !== false): ?>
                    <ul class="dynamic-list">
                      <?php foreach ($destinasi_lines as $line): 
                        $line = trim($line);
                        if (empty($line)) continue;
                        $line = ltrim($line, '•*- ');
                      ?>
                        <li>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                          <div><?php echo $line; ?></div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <?php echo nl2br(htmlspecialchars_decode($p['destinasi'])); ?>
                  <?php endif; ?>
              </div>
            <?php else: ?>
              <p>Destinasi perjalanan akan disesuaikan dengan paket yang Anda pilih. Hubungi kami untuk informasi lebih lanjut mengenai itinerari lengkap.</p>
              <ul class="dynamic-list">
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                  <div>Berbagai destinasi wisata populer di lokasi paket.</div>
                </li>
              </ul>
            <?php endif; ?>
          </div>

          <!-- Tab Content: Fasilitas -->
          <div class="detail__tab-content" id="tab-fasilitas" role="tabpanel">
            <h3>Fasilitas Termasuk (Include)</h3>
            <?php if (!empty($p['fasilitas_include'])): ?>
              <ul class="detail__include" style="margin-bottom:var(--space-8);">
                <?php 
                  $include_lines = explode("\n", htmlspecialchars_decode($p['fasilitas_include']));
                  foreach ($include_lines as $line): 
                    $line = trim($line);
                    if (empty($line)) continue;
                    $line = ltrim($line, '•*- ');
                ?>
                  <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <?php echo $line; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="text-muted mb-4">Informasi fasilitas include belum tersedia. Silakan hubungi kami.</p>
            <?php endif; ?>

            <h3>Tidak Termasuk (Exclude)</h3>
            <?php if (!empty($p['fasilitas_exclude'])): ?>
              <ul class="detail__exclude">
                <?php 
                  $exclude_lines = explode("\n", htmlspecialchars_decode($p['fasilitas_exclude']));
                  foreach ($exclude_lines as $line): 
                    $line = trim($line);
                    if (empty($line)) continue;
                    $line = ltrim($line, '•*- ');
                ?>
                  <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    <?php echo $line; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="text-muted">Biaya pribadi dan pengeluaran di luar program tidak termasuk dalam paket.</p>
            <?php endif; ?>
          </div>

          <!-- Tab Content: Syarat & Ketentuan -->
          <div class="detail__tab-content" id="tab-syarat" role="tabpanel">
            <h3>Syarat &amp; Ketentuan</h3>
            <?php if (!empty($p['syarat_ketentuan'])): ?>
              <div class="tab-description">
                <?php 
                  $syarat_lines = explode("\n", htmlspecialchars_decode($p['syarat_ketentuan']));
                  if (count($syarat_lines) > 1 || strpos($p['syarat_ketentuan'], '•') !== false): ?>
                    <ul class="dynamic-list">
                      <?php foreach ($syarat_lines as $line): 
                        $line = trim($line);
                        if (empty($line)) continue;
                        $line = ltrim($line, '•*- ');
                      ?>
                        <li>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                          <div><?php echo $line; ?></div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <?php echo nl2br(htmlspecialchars_decode($p['syarat_ketentuan'])); ?>
                  <?php endif; ?>
              </div>
            <?php else: ?>
              <p>Pemesanan paket ini tunduk pada syarat dan ketentuan umum SnD Tour Travel. Hubungi kami untuk rincian lebih lanjut mengenai kebijakan pembayaran dan pembatalan spesifik untuk paket ini.</p>
              <ul class="dynamic-list">
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                  <div>Ketentuan umum berlaku sesuai kebijakan SnD Tour.</div>
                </li>
              </ul>
            <?php endif; ?>
          </div>

        </div>

        <!-- ====== STICKY SIDEBAR ====== -->
        <aside class="detail__sidebar">
          <div class="price-box">
            <span class="price-box__label">START FROM</span>
            <div class="price-box__amount"><?php echo format_harga($p['harga']); ?> <span style="font-family:var(--font-body);font-size:var(--text-sm);font-weight:400;color:var(--gray-400);">/ orang</span></div>
            <p class="price-box__note">Harga dapat berubah sewaktu-waktu tergantung musim, ketersediaan maskapai, dan hotel. Hubungi kami untuk mendapatkan harga terbaru.</p>

            <div class="price-box__meta">
              <div class="price-box__meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span>Durasi: <strong><?php echo htmlspecialchars($p['durasi']); ?></strong></span>
              </div>
              <div class="price-box__meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.8 19.2L16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/></svg>
                <span>Maskapai: <strong>Garuda Indonesia</strong></span>
              </div>
              <div class="price-box__meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <span>Hotel: <strong>Bintang 4</strong></span>
              </div>
            </div>

            <a href="https://wa.me/6281234567890?text=Halo%20SnD%20Tour%2C%20saya%20tertarik%20dengan%20paket%20<?php echo urlencode($p['nama_paket']); ?>%20(<?php echo format_harga($p['harga']); ?>%2Forang).%20Mohon%20info%20lebih%20lanjut%20mengenai%20ketersediaan%20jadwal%20dan%20detail%20pembayaran.%20Terima%20kasih!" class="btn btn--primary btn--lg btn--full" target="_blank" rel="noopener noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              HUBUNGI KAMI
            </a>
          </div>
        </aside>

      </div>
    </div>
  </section>

  <!-- ============================================================
       RELATED PACKAGES
       ============================================================ -->
  <section class="section special-tours reveal" id="related-packages" style="background:var(--gradient-section-alt);">
    <div class="container">
      <div class="section-header">
        <span class="section-header__eyebrow">Rekomendasi</span>
        <h2 class="section-header__title">Paket Wisata Lainnya</h2>
        <p class="section-header__subtitle">Temukan paket wisata menarik lainnya yang mungkin cocok untuk liburan Anda berikutnya.</p>
        <div class="section-header__line"></div>
      </div>
      <div class="special-tours__scroll">

        <!-- Related Card 1 -->
        <article class="card">
          <a href="detail-paket.php">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?w=500&q=80" alt="Panorama Labuan Bajo dengan laut biru dan pulau-pulau" loading="lazy" width="500" height="313">
              <span class="card__badge">Promo</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Domestik</span>
            <h3 class="card__title"><a href="detail-paket.php">Labuan Bajo Explorer 4D3N</a></h3>
            <div class="card__meta">
              <span class="card__meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                NTT, Indonesia
              </span>
              <span class="card__duration">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                4D3N
              </span>
            </div>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 5.750.000</span>
            </div>
            <div class="card__footer">
              <a href="detail-paket.php" class="btn btn--secondary btn--sm">LIHAT DETAIL</a>
              <div class="card__airline" title="Lion Air">
                <span style="font-size:10px;font-weight:700;color:var(--coral);">JT</span>
              </div>
            </div>
          </div>
        </article>

        <!-- Related Card 2 -->
        <article class="card">
          <a href="detail-paket.php">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=500&q=80" alt="Gunung Bromo saat matahari terbit dengan kabut emas" loading="lazy" width="500" height="313">
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Domestik</span>
            <h3 class="card__title"><a href="detail-paket.php">Bromo Midnight Tour 2D1N</a></h3>
            <div class="card__meta">
              <span class="card__meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Jawa Timur
              </span>
              <span class="card__duration">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                2D1N
              </span>
            </div>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 1.850.000</span>
            </div>
            <div class="card__footer">
              <a href="detail-paket.php" class="btn btn--secondary btn--sm">LIHAT DETAIL</a>
              <div class="card__airline" title="Citilink">
                <span style="font-size:10px;font-weight:700;color:var(--emerald);">QG</span>
              </div>
            </div>
          </div>
        </article>

        <!-- Related Card 3 -->
        <article class="card">
          <a href="detail-paket.php">
            <div class="card__image">
              <img src="https://images.unsplash.com/photo-1574227492706-f65b24c3688a?w=500&q=80" alt="Kota Singapura dengan gedung pencakar langit dan Marina Bay" loading="lazy" width="500" height="313">
              <span class="card__badge card__badge--teal">Best Seller</span>
            </div>
          </a>
          <div class="card__body">
            <span class="card__category">Asia</span>
            <h3 class="card__title"><a href="detail-paket.php">Singapore City Tour 4D3N</a></h3>
            <div class="card__meta">
              <span class="card__meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Singapura
              </span>
              <span class="card__duration">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                4D3N
              </span>
            </div>
            <div class="card__price">
              <span class="card__price-label">Start From</span>
              <span class="card__price-value">Rp 7.500.000</span>
            </div>
            <div class="card__footer">
              <a href="detail-paket.php" class="btn btn--secondary btn--sm">LIHAT DETAIL</a>
              <div class="card__airline" title="Singapore Airlines">
                <span style="font-size:10px;font-weight:700;color:var(--teal-dark);">SQ</span>
              </div>
            </div>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- ============================================================
       CTA BANNER
       ============================================================ -->
  <section class="cta-banner reveal">
    <div class="cta-banner__content">
      <h2 class="cta-banner__title">Siap Berlibur?</h2>
      <p class="cta-banner__text">Jangan tunda lagi! Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan wujudkan liburan impian Anda bersama SnD Tour Travel.</p>
      <div style="display:flex;gap:var(--space-4);justify-content:center;flex-wrap:wrap;">
        <a href="https://wa.me/6281234567890?text=Halo%20SnD%20Tour%2C%20saya%20tertarik%20untuk%20berlibur.%20Mohon%20info%20paket%20wisata%20yang%20tersedia.%20Terima%20kasih!" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          WHATSAPP KAMI
        </a>
        <a href="paket-wisata.php" class="btn btn--outline-light btn--lg">LIHAT SEMUA PAKET</a>
      </div>
    </div>
  </section>

  <!-- ============================================================
       FOOTER
       ============================================================ -->
  <footer class="footer" id="footer">
    <div class="container">
      <div class="footer__grid">

        <!-- Brand Column -->
        <div class="footer__brand">
          <div class="footer__brand-name">SnD Tour</div>
          <div class="footer__brand-tagline">Liburan Pasti Berangkat</div>
          <p class="footer__brand-text">Travel agent terpercaya di Surabaya sejak 2017. Menyediakan paket wisata domestik &amp; Asia, outbond, dan catering dengan layanan profesional dan harga terjangkau.</p>
          <div class="footer__social">
            <a href="https://instagram.com/sndtour" class="footer__social-link" aria-label="Instagram SnD Tour" target="_blank" rel="noopener noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="https://facebook.com/sndtour" class="footer__social-link" aria-label="Facebook SnD Tour" target="_blank" rel="noopener noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="https://tiktok.com/@sndtour" class="footer__social-link" aria-label="TikTok SnD Tour" target="_blank" rel="noopener noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
            </a>
            <a href="https://youtube.com/@sndtour" class="footer__social-link" aria-label="YouTube SnD Tour" target="_blank" rel="noopener noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.13C5.12 19.56 12 19.56 12 19.56s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="footer__heading">Layanan</h4>
          <div class="footer__links">
            <a href="paket-wisata.php" class="footer__link">Paket Wisata Domestik</a>
            <a href="paket-wisata.php" class="footer__link">Paket Wisata Asia</a>
            <a href="outbond.php" class="footer__link">Outbond</a>
            <a href="catering.php" class="footer__link">Catering</a>
            <a href="galeri.php" class="footer__link">Galeri</a>
          </div>
        </div>

        <!-- Company -->
        <div>
          <h4 class="footer__heading">Perusahaan</h4>
          <div class="footer__links">
            <a href="profil.php" class="footer__link">Tentang Kami</a>
            <a href="profil.php#visi-misi" class="footer__link">Visi &amp; Misi</a>
            <a href="blog.php" class="footer__link">Blog &amp; Artikel</a>
            <a href="kontak.php" class="footer__link">Hubungi Kami</a>
          </div>
        </div>

        <!-- Contact Info -->
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
        </div>

      </div>

      <!-- Footer Bottom -->
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

  <!-- Noise Texture Overlay -->
  <div class="noise-overlay" aria-hidden="true"></div>

  <!-- Mobile Nav Overlay -->
  <div class="nav-overlay" id="navOverlay" aria-hidden="true"></div>

  <!-- JavaScript -->
  <script src="js/main.js"></script>
</body>
</html>
