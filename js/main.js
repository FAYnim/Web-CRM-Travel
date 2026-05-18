/* ============================================================
   SnD TOUR TRAVEL — Main JavaScript
   Handles: Navigation, Sliders, Animations, Interactions
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {
  initHeader();
  initMobileNav();
  initHeroSlider();
  initTestimonialSlider();
  initScrollReveal();
  initGalleryLightbox();
  initDetailTabs();
  initSearchFilter();
  initCounterAnimation();
});

/* ============================================================
   STICKY HEADER
   ============================================================ */
function initHeader() {
  const header = document.querySelector('.header');
  if (!header) return;

  let lastScroll = 0;

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > 60) {
      header.classList.add('header--scrolled');
    } else {
      header.classList.remove('header--scrolled');
    }

    lastScroll = currentScroll;
  }, { passive: true });
}

/* ============================================================
   MOBILE NAVIGATION
   ============================================================ */
function initMobileNav() {
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.nav');
  const overlay = document.querySelector('.nav-overlay');

  if (!toggle || !nav) return;

  toggle.addEventListener('click', () => {
    toggle.classList.toggle('nav-toggle--active');
    nav.classList.toggle('nav--open');
    if (overlay) overlay.classList.toggle('nav-overlay--visible');
    document.body.style.overflow = nav.classList.contains('nav--open') ? 'hidden' : '';
  });

  if (overlay) {
    overlay.addEventListener('click', () => {
      toggle.classList.remove('nav-toggle--active');
      nav.classList.remove('nav--open');
      overlay.classList.remove('nav-overlay--visible');
      document.body.style.overflow = '';
    });
  }

  // Mobile dropdown toggle
  const dropdownItems = document.querySelectorAll('.nav__item');
  dropdownItems.forEach(item => {
    const link = item.querySelector('.nav__link');
    const dropdown = item.querySelector('.nav__dropdown');
    if (!dropdown || !link) return;

    link.addEventListener('click', (e) => {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        item.classList.toggle('nav__item--open');
      }
    });
  });
}

/* ============================================================
   HERO SLIDER
   ============================================================ */
function initHeroSlider() {
  const slides = document.querySelectorAll('.hero__slide');
  const dots = document.querySelectorAll('.hero__nav-dot');

  if (slides.length === 0) return;

  let current = 0;
  let interval;

  function goToSlide(index) {
    slides.forEach(s => s.classList.remove('hero__slide--active'));
    dots.forEach(d => d.classList.remove('hero__nav-dot--active'));

    current = index;
    if (current >= slides.length) current = 0;
    if (current < 0) current = slides.length - 1;

    slides[current].classList.add('hero__slide--active');
    if (dots[current]) dots[current].classList.add('hero__nav-dot--active');
  }

  function nextSlide() {
    goToSlide(current + 1);
  }

  function startAutoplay() {
    interval = setInterval(nextSlide, 5000);
  }

  function stopAutoplay() {
    clearInterval(interval);
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      stopAutoplay();
      goToSlide(i);
      startAutoplay();
    });
  });

  // Arrow navigation (if present)
  const prevBtn = document.querySelector('.hero__arrow--prev');
  const nextBtn = document.querySelector('.hero__arrow--next');

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      stopAutoplay();
      goToSlide(current - 1);
      startAutoplay();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      stopAutoplay();
      goToSlide(current + 1);
      startAutoplay();
    });
  }

  goToSlide(0);
  startAutoplay();
}

/* ============================================================
   TESTIMONIAL SLIDER
   ============================================================ */
function initTestimonialSlider() {
  const cards = document.querySelectorAll('.testimonial-card');
  const dots = document.querySelectorAll('.testimonials__dot');
  const prevBtn = document.querySelector('.testimonials__arrow--prev');
  const nextBtn = document.querySelector('.testimonials__arrow--next');

  if (cards.length === 0) return;

  let current = 0;
  let interval;

  function goTo(index) {
    cards.forEach(c => {
      c.style.display = 'none';
      c.style.opacity = '0';
    });
    dots.forEach(d => d.classList.remove('testimonials__dot--active'));

    current = index;
    if (current >= cards.length) current = 0;
    if (current < 0) current = cards.length - 1;

    if (cards[current]) {
      cards[current].style.display = 'block';
      // Trigger reflow
      cards[current].offsetHeight;
      cards[current].style.opacity = '1';
    }

    if (dots[current]) dots[current].classList.add('testimonials__dot--active');
  }

  function startAutoplay() {
    // Disable autoplay if only one or zero card
    if (cards.length <= 1) return;
    interval = setInterval(() => goTo(current + 1), 5000);
  }

  function stopAutoplay() {
    clearInterval(interval);
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      if (cards.length <= 1) return;
      stopAutoplay();
      goTo(i);
      startAutoplay();
    });
  });

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      if (cards.length <= 1) return;
      stopAutoplay();
      goTo(current - 1);
      startAutoplay();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      if (cards.length <= 1) return;
      stopAutoplay();
      goTo(current + 1);
      startAutoplay();
    });
  }

  // Add CSS transition for cards
  cards.forEach(c => {
    c.style.transition = 'opacity 0.6s ease';
  });

  goTo(0);
  startAutoplay();
}

/* ============================================================
   SCROLL REVEAL ANIMATIONS
   ============================================================ */
function initScrollReveal() {
  const reveals = document.querySelectorAll('.reveal');

  if (reveals.length === 0) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('reveal--visible');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  });

  reveals.forEach(el => observer.observe(el));
}

/* ============================================================
   GALLERY LIGHTBOX
   ============================================================ */
function initGalleryLightbox() {
  const items = document.querySelectorAll('.gallery-item');
  const lightbox = document.querySelector('.lightbox');
  const lightboxImg = document.querySelector('.lightbox__img');
  const lightboxClose = document.querySelector('.lightbox__close');

  if (!lightbox || items.length === 0) return;

  items.forEach(item => {
    item.addEventListener('click', () => {
      const img = item.querySelector('img');
      if (img) {
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt;
        lightbox.classList.add('lightbox--active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  function closeLightbox() {
    lightbox.classList.remove('lightbox--active');
    document.body.style.overflow = '';
  }

  if (lightboxClose) {
    lightboxClose.addEventListener('click', closeLightbox);
  }

  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) closeLightbox();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
  });
}

/* ============================================================
   DETAIL PAGE TABS
   ============================================================ */
function initDetailTabs() {
  const tabs = document.querySelectorAll('.detail__tab');
  const contents = document.querySelectorAll('.detail__tab-content');

  if (tabs.length === 0) return;

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const target = tab.dataset.tab;

      tabs.forEach(t => t.classList.remove('detail__tab--active'));
      contents.forEach(c => c.classList.remove('detail__tab-content--active'));

      tab.classList.add('detail__tab--active');
      const targetContent = document.getElementById(target);
      if (targetContent) targetContent.classList.add('detail__tab-content--active');
    });
  });
}

/* ============================================================
   DETAIL PAGE GALLERY
   ============================================================ */
document.addEventListener('click', (e) => {
  const thumb = e.target.closest('.detail__gallery-thumb');
  if (!thumb) return;

  const mainImg = document.querySelector('.detail__gallery-main img');
  const thumbImg = thumb.querySelector('img');
  if (!mainImg || !thumbImg) return;

  document.querySelectorAll('.detail__gallery-thumb').forEach(t =>
    t.classList.remove('detail__gallery-thumb--active')
  );
  thumb.classList.add('detail__gallery-thumb--active');
  mainImg.src = thumbImg.src;
  mainImg.alt = thumbImg.alt;
});

/* ============================================================
   SEARCH / FILTER / SORT FUNCTIONALITY
   ============================================================ */
function initSearchFilter() {
  // === Ambil elemen-elemen yang diperlukan ===
  var searchInput = document.getElementById('searchInput');
  var sortSelect  = document.getElementById('sortHarga');
  var filterTags  = document.querySelectorAll('.filter-tag');   // kategori
  var labelTags   = document.querySelectorAll('.label-tag');    // label

  // === State: simpan pilihan aktif ===
  var activeKategori = 'semua';
  var activeLabel    = 'semua';

  // --- 1) Event: Kategori Filter ---
  filterTags.forEach(function(tag) {
    tag.addEventListener('click', function() {
      filterTags.forEach(function(t) { t.classList.remove('filter-tag--active'); });
      tag.classList.add('filter-tag--active');
      activeKategori = tag.dataset.filter;
      applyAllFilters();
    });
  });

  // --- 2) Event: Label Filter ---
  labelTags.forEach(function(tag) {
    tag.addEventListener('click', function() {
      labelTags.forEach(function(t) { t.classList.remove('label-tag--active'); });
      tag.classList.add('label-tag--active');
      activeLabel = tag.dataset.label;
      applyAllFilters();
    });
  });

  // --- 3) Event: Search (ketik langsung) ---
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      applyAllFilters();
    });
  }

  // --- 4) Event: Sort Harga ---
  if (sortSelect) {
    sortSelect.addEventListener('change', function() {
      applyAllFilters();
    });
  }

  // === Fungsi utama: terapkan semua filter sekaligus ===
  function applyAllFilters() {
    var grid  = document.querySelector('.packages__grid');
    var cards = document.querySelectorAll('.packages__grid .card');
    if (!grid || cards.length === 0) return;

    // Ambil kata kunci pencarian (huruf kecil)
    var keyword = searchInput ? searchInput.value.toLowerCase().trim() : '';
    // Ambil pilihan sort
    var sortMode = sortSelect ? sortSelect.value : 'default';

    // --- Langkah 1: Filter (show/hide) ---
    cards.forEach(function(card) {
      var cocokKategori = (activeKategori === 'semua') || (card.dataset.category === activeKategori);
      var cocokLabel    = (activeLabel === 'semua') || (card.dataset.label && card.dataset.label.includes(activeLabel));
      var cocokSearch   = (keyword === '') || (card.dataset.nama && card.dataset.nama.includes(keyword));

      // Tampilkan hanya jika SEMUA kondisi terpenuhi
      if (cocokKategori && cocokLabel && cocokSearch) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });

    // --- Langkah 2: Sort (urutkan kartu) ---
    if (sortMode !== 'default') {
      // Konversi ke array agar bisa di-sort
      var cardsArray = Array.prototype.slice.call(cards);

      cardsArray.sort(function(a, b) {
        var hargaA = parseInt(a.dataset.harga) || 0;
        var hargaB = parseInt(b.dataset.harga) || 0;

        if (sortMode === 'termurah') {
          return hargaA - hargaB;  // kecil ke besar
        } else {
          return hargaB - hargaA;  // besar ke kecil
        }
      });

      // Pindahkan kartu dalam urutan baru ke grid
      cardsArray.forEach(function(card) {
        grid.appendChild(card);
      });
    }

    // --- Langkah 3: Tampilkan pesan jika tidak ada hasil ---
    var oldMsg = grid.querySelector('.no-results-msg');
    if (oldMsg) oldMsg.remove();

    var adaHasil = false;
    cards.forEach(function(card) {
      if (card.style.display !== 'none') adaHasil = true;
    });

    if (!adaHasil) {
      var msg = document.createElement('p');
      msg.className = 'no-results-msg';
      msg.textContent = 'Tidak ada paket wisata yang cocok dengan pencarian Anda.';
      grid.appendChild(msg);
    }
  }

  // === Handle search box di homepage (jika ada) ===
  var searchForm = document.querySelector('.search-box');
  if (searchForm) {
    var searchBtn = searchForm.querySelector('.search-box__btn .btn');
    if (searchBtn) {
      searchBtn.addEventListener('click', function(e) {
        e.preventDefault();
        var category = searchForm.querySelector('.search-box__select');
        var keyword  = searchForm.querySelector('.search-box__input');
        var params   = new URLSearchParams();
        if (category && category.value) params.set('kategori', category.value);
        if (keyword && keyword.value) params.set('q', keyword.value);
        window.location.href = 'paket-wisata.php' + (params.toString() ? '?' + params.toString() : '');
      });
    }
  }
}

/* ============================================================
   COUNTER ANIMATION (Footer stats)
   ============================================================ */
function initCounterAnimation() {
  const counters = document.querySelectorAll('[data-count]');
  if (counters.length === 0) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = parseInt(entry.target.dataset.count, 10);
        animateCounter(entry.target, target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(c => observer.observe(c));
}

function animateCounter(el, target) {
  let current = 0;
  const step = target / 60;
  const timer = setInterval(() => {
    current += step;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    el.textContent = Math.floor(current).toLocaleString('id-ID');
  }, 16);
}

/* ============================================================
   SMOOTH SCROLL FOR ANCHOR LINKS
   ============================================================ */
document.addEventListener('click', (e) => {
  const link = e.target.closest('a[href^="#"]');
  if (!link) return;

  const targetId = link.getAttribute('href');
  if (targetId === '#') return;

  const target = document.querySelector(targetId);
  if (target) {
    e.preventDefault();
    const headerHeight = document.querySelector('.header')?.offsetHeight || 80;
    const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
    window.scrollTo({ top, behavior: 'smooth' });
  }
});
