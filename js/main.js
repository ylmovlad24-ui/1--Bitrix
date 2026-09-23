/**
 * dianomi — Main JavaScript
 * Mobile-first utilities: hamburger menu, smooth scroll,
 * form validation, scroll animations, sticky CTA, popup,
 * loss calculator, FAQ accordion, phone mask, counter animation.
 */

(function () {
  'use strict';

  /* ───────── DOM references ───────── */
  var burger = document.getElementById('burger');
  var mobileMenu = document.getElementById('mobileMenu');
  var mobileOverlay = document.getElementById('mobileOverlay');
  var header = document.getElementById('header');

  /* ───────── Mobile menu toggle ───────── */
  function openMenu() {
    if (!mobileMenu) return;
    mobileMenu.classList.add('mobile-menu--open');
    if (mobileOverlay) mobileOverlay.classList.add('mobile-overlay--visible');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    if (!mobileMenu) return;
    mobileMenu.classList.remove('mobile-menu--open');
    if (mobileOverlay) mobileOverlay.classList.remove('mobile-overlay--visible');
    document.body.style.overflow = '';
  }

  if (burger) {
    burger.addEventListener('click', function () {
      mobileMenu.classList.contains('mobile-menu--open') ? closeMenu() : openMenu();
    });
  }

  if (mobileOverlay) {
    mobileOverlay.addEventListener('click', closeMenu);
  }

  // Close menu on link click
  var menuLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
  menuLinks.forEach(function (link) {
    link.addEventListener('click', closeMenu);
  });

  // Mobile dropdown toggle
  var dropdownBtns = document.querySelectorAll('.mobile-menu__dropdown-btn');
  dropdownBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var dropdownList = this.nextElementSibling;
      var icon = this.querySelector('.mobile-menu__dropdown-icon');
      if (!dropdownList) return;
      var isOpen = dropdownList.classList.contains('mobile-menu__dropdown-list--open');
      if (isOpen) {
        dropdownList.classList.remove('mobile-menu__dropdown-list--open');
        this.setAttribute('aria-expanded', 'false');
        if (icon) icon.textContent = '▾';
      } else {
        dropdownList.classList.add('mobile-menu__dropdown-list--open');
        this.setAttribute('aria-expanded', 'true');
        if (icon) icon.textContent = '▴';
      }
    });
  });

  // Close menu on Escape
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeMenu();
  });

  /* ───────── Header shrink on scroll ───────── */
  function onScrollHeader() {
    if (!header) return;
    if (window.scrollY > 20) {
      header.classList.add('header--scrolled');
    } else {
      header.classList.remove('header--scrolled');
    }
  }
  window.addEventListener('scroll', onScrollHeader, { passive: true });
  onScrollHeader();

  /* ───────── Sticky CTA (mobile) ───────── */
  var stickyCta = document.getElementById('stickyCta');
  if (stickyCta) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 400) {
        stickyCta.classList.add('sticky-cta--visible');
      } else {
        stickyCta.classList.remove('sticky-cta--visible');
      }
    }, { passive: true });
  }

  /* ───────── Smooth scroll for anchor links ───────── */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;
      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        var offset = header ? header.offsetHeight + 16 : 24;
        var top = target.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top: top, behavior: 'smooth' });
      }
    });
  });

  /* ───────── Contact form validation ───────── */
  var contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var isValid = true;
      var fields = contactForm.querySelectorAll('[required]');

      // Reset styles
      fields.forEach(function (field) {
        field.classList.remove('form-control--error');
      });

      fields.forEach(function (field) {
        if (!field.value.trim()) {
          field.classList.add('form-control--error');
          isValid = false;
        }
        // Email validation
        if (field.type === 'email' && field.value.trim()) {
          var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRe.test(field.value.trim())) {
            field.classList.add('form-control--error');
            isValid = false;
          }
        }
      });

      if (isValid) {
        var submitBtn = contactForm.querySelector('button[type="submit"]');
        var originalText = submitBtn ? submitBtn.textContent : '';
        if (submitBtn) {
          submitBtn.textContent = 'Отправлено ✓';
          submitBtn.disabled = true;
          setTimeout(function () {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            contactForm.reset();
          }, 3000);
        }
        alert('Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.');
      }
    });
  }

  /* ───────── Popup (delayed, once per session) ───────── */
  var popupOverlay = document.getElementById('popupOverlay');
  var popupClose = document.getElementById('popupClose');
  var popupDismiss = document.getElementById('popupDismiss');
  var popupForm = document.getElementById('popupForm');
  var POPUP_DELAY = 45000; // 45 seconds
  var POPUP_STORAGE_KEY = 'dianomi_popup_shown';

  function showPopup() {
    if (!popupOverlay) return;
    popupOverlay.classList.add('popup-overlay--visible');
    document.body.style.overflow = 'hidden';
  }

  function hidePopup() {
    if (!popupOverlay) return;
    popupOverlay.classList.remove('popup-overlay--visible');
    document.body.style.overflow = '';
    // Remember that popup was shown in this session
    try {
      sessionStorage.setItem(POPUP_STORAGE_KEY, '1');
    } catch (e) {}
  }

  if (popupClose) {
    popupClose.addEventListener('click', hidePopup);
  }

  if (popupDismiss) {
    popupDismiss.addEventListener('click', hidePopup);
  }

  if (popupOverlay) {
    popupOverlay.addEventListener('click', function (e) {
      if (e.target === popupOverlay) hidePopup();
    });
  }

  // Show popup after delay (once per session)
  if (popupOverlay) {
    try {
      if (!sessionStorage.getItem(POPUP_STORAGE_KEY)) {
        setTimeout(showPopup, POPUP_DELAY);
      }
    } catch (e) {}
  }

  // Popup form submission
  if (popupForm) {
    popupForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var inputs = popupForm.querySelectorAll('input[required]');
      var isValid = true;
      inputs.forEach(function (input) {
        if (!input.value.trim()) {
          input.classList.add('form-control--error');
          isValid = false;
        } else {
          input.classList.remove('form-control--error');
        }
      });

      if (isValid) {
        hidePopup();
        alert('Спасибо! Мы свяжемся с вами в течение 2 часов.');
        popupForm.reset();
      }
    });
  }

  /* ───────── Loss Calculator ───────── */
  var lossManagers = document.getElementById('lossManagers');
  var lossCheck = document.getElementById('lossCheck');
  var lossManagersVal = document.getElementById('lossManagersVal');
  var lossCheckVal = document.getElementById('lossCheckVal');
  var lossResult = document.getElementById('lossResult');

  if (lossManagers && lossCheck && lossResult) {
    function formatNumber(n) {
      return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    }

    function calculateLoss() {
      var managers = parseInt(lossManagers.value, 10) || 1;
      var check = parseInt(lossCheck.value, 10) || 50000;

      if (lossManagersVal) lossManagersVal.textContent = managers;
      if (lossCheckVal) lossCheckVal.textContent = formatNumber(check) + ' ₽';

      // Formula: managers * 0.1 (10% lost leads) * check * 22 (working days)
      var monthlyLoss = Math.round(managers * 0.1 * check * 22);
      lossResult.textContent = '~' + formatNumber(monthlyLoss) + ' ₽/мес';

      // Update the paragraph text
      var p = lossResult.parentElement.querySelector('p');
      if (p) {
        p.innerHTML = 'Вы теряете около <strong>' + formatNumber(monthlyLoss) + ' ₽ каждый месяц</strong> из-за ручных процессов и потерянных лидов';
      }
    }

    lossManagers.addEventListener('input', calculateLoss);
    lossCheck.addEventListener('input', calculateLoss);
    calculateLoss(); // Initial calculation
  }

  /* ───────── FAQ Accordion ───────── */
  var faqQuestions = document.querySelectorAll('.faq-question');
  faqQuestions.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = this.closest('.faq-item');
      if (!item) return;
      var answer = item.querySelector('.faq-answer');
      var icon = this.querySelector('.faq-question__icon');
      var isOpen = item.classList.contains('faq-item--open');

      // Close all other items
      document.querySelectorAll('.faq-item.faq-item--open').forEach(function (openItem) {
        if (openItem !== item) {
          openItem.classList.remove('faq-item--open');
          openItem.querySelector('.faq-answer').style.maxHeight = null;
          openItem.querySelector('.faq-question__icon').textContent = '+';
        }
      });

      // Toggle current item
      if (isOpen) {
        item.classList.remove('faq-item--open');
        answer.style.maxHeight = null;
        if (icon) icon.textContent = '+';
      } else {
        item.classList.add('faq-item--open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        if (icon) icon.textContent = '−';
      }
    });
  });

  /* ───────── Phone Mask ───────── */
  var phoneInputs = document.querySelectorAll('input[type="tel"]');
  phoneInputs.forEach(function (input) {
    input.addEventListener('input', function (e) {
      var value = e.target.value.replace(/\D/g, '');
      var formatted = '';

      if (value.length === 0) {
        formatted = '';
      } else {
        // Ensure starts with 7
        if (value[0] === '8') {
          value = '7' + value.substring(1);
        }
        if (value[0] !== '7') {
          value = '7' + value;
        }

        formatted = '+7';
        if (value.length > 1) {
          formatted += ' (' + value.substring(1, 4);
        }
        if (value.length >= 4) {
          formatted += ') ';
        }
        if (value.length > 4) {
          formatted += value.substring(4, 7);
        }
        if (value.length > 7) {
          formatted += '-' + value.substring(7, 9);
        }
        if (value.length > 9) {
          formatted += '-' + value.substring(9, 11);
        }
      }

      e.target.value = formatted;
    });

    // Clear on focus if placeholder
    input.addEventListener('focus', function () {
      if (!this.value) {
        this.value = '';
      }
    });
  });

  /* ───────── Scroll animations (Intersection Observer) ───────── */
  var animatedElements = document.querySelectorAll('.animate-on-scroll');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate-on-scroll--visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );
    animatedElements.forEach(function (el) {
      observer.observe(el);
    });
  } else {
    // Fallback: show everything
    animatedElements.forEach(function (el) {
      el.classList.add('animate-on-scroll--visible');
    });
  }

  /* ───────── Counter Animation ───────── */
  var counters = document.querySelectorAll('.counter, .hero-stat__number');
  if ('IntersectionObserver' in window && counters.length > 0) {
    var counterObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting && !entry.target.classList.contains('is-counting')) {
            entry.target.classList.add('is-counting');
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.25 }
    );
    counters.forEach(function (counter) {
      counterObserver.observe(counter);
    });
  } else {
    // Fallback: set final values immediately
    counters.forEach(function (counter) {
      var target = parseInt(counter.getAttribute('data-target') || counter.getAttribute('data-count'), 10) || 0;
      var suffix = counter.getAttribute('data-suffix') || '';
      counter.textContent = target + suffix;
    });
  }

  function animateCounter(el) {
    var target = parseInt(el.getAttribute('data-target') || el.getAttribute('data-count'), 10) || 0;
    var suffix = el.getAttribute('data-suffix') || '';
    var duration = 2000; // ms
    var startTime = null;

    function easeOutQuart(t) {
      return 1 - Math.pow(1 - t, 4);
    }

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      var easedProgress = easeOutQuart(progress);
      var currentValue = Math.floor(easedProgress * target);
      el.textContent = currentValue + suffix;
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target + suffix;
      }
    }

    requestAnimationFrame(step);
  }

  /* ───────── Current year in footer ───────── */
  var yearEl = document.getElementById('currentYear');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }

  /* ───────── Swiper Cases Slider ───────── */
  var casesSwiper = document.querySelector('.cases-swiper');
  if (casesSwiper && typeof Swiper !== 'undefined') {
    new Swiper(casesSwiper, {
      slidesPerView: 1,
      spaceBetween: 24,
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        600: {
          slidesPerView: 2
        },
        960: {
          slidesPerView: 3
        }
      }
    });
  }

  /* ───────── Case Filters ───────── */
  var filterBtns = document.querySelectorAll('.filter-btn');
  var caseCards = document.querySelectorAll('.case-card[data-category]');
  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var filter = this.getAttribute('data-filter');
      // Update active button
      filterBtns.forEach(function (b) { b.classList.remove('filter-btn--active'); });
      this.classList.add('filter-btn--active');
      // Filter cards
      caseCards.forEach(function (card) {
        var category = card.getAttribute('data-category');
        if (filter === 'all' || category === filter) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  /* ───────── Load shared header/footer ───────── */
  // Load header partial
  fetch('partials/header.html')
    .then(function(r) { return r.text(); })
    .then(function(html) {
      document.querySelector('head').insertAdjacentHTML('beforebegin', html);
    })
    .catch(function() { /* Fallback: header already in HTML */ });

  // Load footer partial
  fetch('partials/footer.html')
    .then(function(r) { return r.text(); })
    .then(function(html) {
      document.body.insertAdjacentHTML('beforeend', html);
    })
    .catch(function() { /* Fallback: footer already in HTML */ });

  /* ───────── Composite Site SDK placeholder ───────── */
  // When migrating to 1C-Bitrix CMS, replace this stub with the actual
  // Bitrix composite init. Example:
  //   if (typeof BX !== 'undefined' && BX.bitrix_composite_init) {
  //     BX.bitrix_composite_init();
  //   }
  window.__dianomi_composite_stub = true;

})();
