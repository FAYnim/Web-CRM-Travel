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

    cards[current].style.display = 'block';
    // Trigger reflow
    cards[current].offsetHeight;
    cards[current].style.opacity = '1';

    if (dots[current]) dots[current].classList.add('testimonials__dot--active');
  }

  function startAutoplay() {
    interval = setInterval(() => goTo(current + 1), 5000);
  }

  function stopAutoplay() {
    clearInterval(interval);
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      stopAutoplay();
      goTo(i);
      startAutoplay();
    });
  });

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      stopAutoplay();
      goTo(current - 1);
      startAutoplay();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
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
   SEARCH / FILTER FUNCTIONALITY
   ============================================================ */
function initSearchFilter() {
  const searchForm = document.querySelector('.search-box');
  if (!searchForm) return;

  const searchBtn = searchForm.querySelector('.search-box__btn .btn');
  if (searchBtn) {
    searchBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const category = searchForm.querySelector('.search-box__select');
      const keyword = searchForm.querySelector('.search-box__input');

      // For now, redirect to paket-wisata page with query params
      const params = new URLSearchParams();
      if (category && category.value) params.set('kategori', category.value);
      if (keyword && keyword.value) params.set('q', keyword.value);

      window.location.href = 'paket-wisata.html' + (params.toString() ? '?' + params.toString() : '');
    });
  }

  // Filter tags on listing page
  const filterTags = document.querySelectorAll('.filter-tag');
  filterTags.forEach(tag => {
    tag.addEventListener('click', () => {
      filterTags.forEach(t => t.classList.remove('filter-tag--active'));
      tag.classList.add('filter-tag--active');
      filterPackages(tag.dataset.filter);
    });
  });
}

function filterPackages(category) {
  const cards = document.querySelectorAll('.packages__grid .card');
  cards.forEach(card => {
    if (!category || category === 'semua') {
      card.style.display = '';
      return;
    }
    const cardCategory = card.dataset.category;
    card.style.display = (cardCategory === category) ? '' : 'none';
  });
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
