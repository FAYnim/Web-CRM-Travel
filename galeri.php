<?php
require_once __DIR__ . '/config.php';

$footerKategoriList = crm_get_kategori_footer($koneksi);
$footerKontak = crm_get_footer_context($koneksi);

function galeri_resolve_gambar($gambar)
{
  $gambar = trim((string)$gambar);

  if ($gambar === '' || $gambar === '-') {
    return 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80';
  }

  if (preg_match('/^https?:\/\//i', $gambar)) {
    return $gambar;
  }

  if (strpos($gambar, 'dashboard/') === 0) {
    return $gambar;
  }

  if (strpos($gambar, 'uploads/') === 0) {
    return 'dashboard/' . $gambar;
  }

  return 'dashboard/uploads/' . ltrim($gambar, '/');
}

$galeriList = [];
if ($koneksi) {
  $queryGaleri = mysqli_query($koneksi, "SELECT id, judul, deskripsi, gambar FROM galeri ORDER BY created_at DESC, id DESC");
  if ($queryGaleri) {
    while ($row = mysqli_fetch_assoc($queryGaleri)) {
      $galeriList[] = $row;
    }
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
  <title>Galeri Foto — SnD Tour Travel | Dokumentasi Perjalanan</title>
  <meta name="title" content="Galeri Foto — SnD Tour Travel | Dokumentasi Perjalanan">
  <meta name="description" content="Lihat dokumentasi perjalanan dan kegiatan SnD Tour Travel. Koleksi foto tour domestik, tour Asia, outbond, dan event catering bersama pelanggan kami.">
  <meta name="keywords" content="galeri SnD Tour, foto wisata, dokumentasi perjalanan, tour domestik, tour asia, outbond, catering, travel surabaya">
  <meta name="author" content="SnD Tour Travel">
  <meta name="robots" content="index, follow">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://sndtour.com/galeri.php">
  <meta property="og:title" content="Galeri Foto — SnD Tour Travel">
  <meta property="og:description" content="Dokumentasi perjalanan dan kegiatan SnD Tour Travel. Koleksi foto tour domestik, tour Asia, outbond, dan event catering.">
  <meta property="og:image" content="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=1200&q=80">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="SnD Tour Travel">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://sndtour.com/galeri.php">
  <meta property="twitter:title" content="Galeri Foto — SnD Tour Travel">
  <meta property="twitter:description" content="Dokumentasi perjalanan dan kegiatan SnD Tour Travel. Koleksi foto tour domestik, tour Asia, outbond, dan event catering.">
  <meta property="twitter:image" content="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=1200&q=80">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%23008080'/%3E%3Ctext x='50' y='68' text-anchor='middle' fill='white' font-family='Georgia' font-size='48' font-weight='bold'%3ESnD%3C/text%3E%3C/svg%3E">

  <!-- Canonical -->
  <link rel="canonical" href="https://sndtour.com/galeri.php">

  <!-- Google Fonts Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
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
            <a href="galeri.php" class="nav__link nav__link--active">GALERI</a>
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
      <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=1400&q=80" alt="Pantai eksotis dengan ombak tenang saat senja" loading="eager">
    </div>
    <div class="container">
      <div class="page-header__content">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <a href="index.php">Home</a>
          <span class="breadcrumb__sep">/</span>
          <span>Galeri</span>
        </nav>
        <h1 class="page-header__title">Galeri Foto</h1>
        <p class="page-header__subtitle">Dokumentasi perjalanan dan kegiatan SnD Tour</p>
      </div>
    </div>
  </section>

  <!-- ============================================================
       GALLERY SECTION
       ============================================================ -->
  <section class="section section--sm">
    <div class="container">

      <!-- ============================================================
           GALLERY GRID
           ============================================================ -->
      <div class="gallery-grid" id="galleryGrid">
        <?php if (!empty($galeriList)): ?>
          <?php foreach ($galeriList as $index => $item): ?>
            <?php
              $delay = ($index % 6) + 1;
              $judul = trim((string)($item['judul'] ?? 'Foto Galeri'));
              $deskripsi = trim((string)($item['deskripsi'] ?? ''));
              $caption = $judul !== '' ? $judul : 'Foto Galeri';
              $alt = $deskripsi !== '' ? $deskripsi : $caption;
            ?>
            <div class="gallery-item reveal reveal--delay-<?php echo $delay; ?>" data-category="semua">
              <img src="<?php echo htmlspecialchars(galeri_resolve_gambar($item['gambar'] ?? '')); ?>" alt="<?php echo htmlspecialchars($alt); ?>" loading="lazy" width="600" height="450">
              <div class="gallery-item__overlay">
                <span class="gallery-item__caption"><?php echo htmlspecialchars($caption); ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="grid-column:1/-1;text-align:center;color:var(--color-text-muted);">Belum ada foto galeri.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ============================================================
       LIGHTBOX
       ============================================================ -->
  <div class="lightbox" id="lightbox">
    <button class="lightbox__close" aria-label="Tutup lightbox">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <img class="lightbox__img" src="" alt="">
  </div>

  <!-- ============================================================
       CTA BANNER
       ============================================================ -->
  <section class="cta-banner reveal" id="cta-banner">
    <div class="cta-banner__content">
      <h2 class="cta-banner__title">Siap Berlibur?</h2>
      <p class="cta-banner__text">Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan wujudkan liburan impian Anda bersama <?php echo htmlspecialchars($footerKontak['nama_perusahaan']); ?>.</p>
      <a href="<?php echo htmlspecialchars($footerKontak['whatsapp_cta_url']); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">
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
          <h3 class="footer__brand-name"><?php echo htmlspecialchars($footerKontak['nama_perusahaan']); ?></h3>
          <p class="footer__brand-tagline">Liburan Pasti Berangkat</p>
          <p class="footer__brand-text"><?php echo htmlspecialchars($footerKontak['tentang_kami']); ?></p>
          <?php if (!empty($footerKontak['social_links'])): ?>
            <div class="footer__social">
              <?php foreach ($footerKontak['social_links'] as $platform => $url): ?>
                <a href="<?php echo htmlspecialchars($url); ?>" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo htmlspecialchars(ucfirst($platform) . ' ' . $footerKontak['nama_perusahaan']); ?>">
                  <?php echo crm_get_social_icon_svg($platform); ?>
                </a>
              <?php endforeach; ?>
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
            <?php if (!empty($footerKategoriList)): ?>
              <?php foreach ($footerKategoriList as $kategori): ?>
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
            <span><?php echo nl2br(htmlspecialchars($footerKontak['alamat'])); ?></span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span><?php echo htmlspecialchars($footerKontak['telepon']); ?></span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <span><?php echo htmlspecialchars($footerKontak['email']); ?></span>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>Senin - Sabtu<br>09.00 - 17.00 WIB</span>
          </div>
        </div>

      </div>

      <!-- Footer Bottom Bar -->
      <div class="footer__bottom">
        <p class="footer__copyright">&copy; 2026 <?php echo htmlspecialchars($footerKontak['nama_perusahaan']); ?>. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- ============================================================
       WHATSAPP FAB
       ============================================================ -->
  <div class="wa-fab" id="waFab">
    <span class="wa-fab__tooltip">Chat dengan kami</span>
    <a href="<?php echo htmlspecialchars($footerKontak['whatsapp_fab_url']); ?>" class="wa-fab__btn" target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp dengan <?php echo htmlspecialchars($footerKontak['nama_perusahaan']); ?>">
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
