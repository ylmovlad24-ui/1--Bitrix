/**
 * dianomi — Main JavaScript (nov architecture)
 * Mobile-first utilities: hamburger menu, mega menu, smooth scroll,
 * form validation, scroll animations, dynamic form fields, breadcrumbs.
 */

(function () {
  'use strict';

  /* ───────── Mobile menu toggle ───────── */
  function openMenu() {
    var mobileMenu = document.getElementById('mobileMenu');
    var mobileOverlay = document.getElementById('mobileOverlay');
    if (!mobileMenu) return;
    mobileMenu.classList.add('mobile-menu--open');
    if (mobileOverlay) mobileOverlay.classList.add('mobile-overlay--visible');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    var mobileMenu = document.getElementById('mobileMenu');
    var mobileOverlay = document.getElementById('mobileOverlay');
    if (!mobileMenu) return;
    mobileMenu.classList.remove('mobile-menu--open');
    if (mobileOverlay) mobileOverlay.classList.remove('mobile-overlay--visible');
    document.body.style.overflow = '';
  }

  function initMobileMenu() {
    var burger = document.getElementById('burger');
    var mobileMenu = document.getElementById('mobileMenu');
    var mobileOverlay = document.getElementById('mobileOverlay');

    if (burger) {
      burger.addEventListener('click', function () {
        mobileMenu.classList.contains('mobile-menu--open') ? closeMenu() : openMenu();
      });
      burger.setAttribute('aria-expanded', 'false');
    }

    if (mobileOverlay) {
      mobileOverlay.addEventListener('click', closeMenu);
    }

    if (mobileMenu) {
      var menuLinks = mobileMenu.querySelectorAll('a');
      menuLinks.forEach(function (link) {
        link.addEventListener('click', closeMenu);
      });
    }
  }

  /* ───────── Mobile dropdowns ───────── */
  function initDropdown() {
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
  }

  /* ───────── Mega Menu (desktop hover) ───────── */
  function initMegaMenu() {
    var dropdowns = document.querySelectorAll('.nav-dropdown');
    dropdowns.forEach(function (dropdown) {
      var link = dropdown.querySelector('.header__nav-link');
      var menu = dropdown.querySelector('.mega-menu');
      if (!menu) return;

      // Desktop: show on hover
      dropdown.addEventListener('mouseenter', function () {
        menu.style.opacity = '1';
        menu.style.visibility = 'visible';
        menu.style.transform = 'translateX(-50%) translateY(0)';
      });

      dropdown.addEventListener('mouseleave', function () {
        menu.style.opacity = '';
        menu.style.visibility = '';
        menu.style.transform = '';
      });

      // Mobile: show on click
      if (link) {
        link.addEventListener('click', function (e) {
          if (window.innerWidth < 960) {
            e.preventDefault();
            var isOpen = menu.style.opacity === '1';
            menu.style.opacity = isOpen ? '' : '1';
            menu.style.visibility = isOpen ? '' : 'visible';
            menu.style.transform = isOpen ? '' : 'translateX(-50%) translateY(0)';
          }
        });
      }
    });
  }

  /* ───────── Header shrink on scroll ───────── */
  function onScrollHeader() {
    var header = document.getElementById('header');
    if (!header) return;
    if (window.scrollY > 20) {
      header.classList.add('header--scrolled');
    } else {
      header.classList.remove('header--scrolled');
    }
  }
  window.addEventListener('scroll', onScrollHeader, { passive: true });
  onScrollHeader();

  /* ───────── Smooth scroll for anchor links ───────── */
  document.addEventListener('click', function (e) {
    var target = e.target.closest('a[href^="#"]');
    if (!target) return;
    var href = target.getAttribute('href');
    if (href === '#') return;
    var el = document.querySelector(href);
    if (el) {
      e.preventDefault();
      var headerEl = document.getElementById('header');
      var offset = headerEl ? headerEl.offsetHeight + 24 : 40;
      var top = el.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({ top: top, behavior: 'smooth' });
    }
  });

  /* ───────── Project form (dynamic fields) ───────── */
  var projectForm = document.getElementById('projectForm');
  if (projectForm) {
    var projectTypeSelect = document.getElementById('projectType');
    var dynamicFields = document.getElementById('dynamicFields');

    if (projectTypeSelect && dynamicFields) {
      projectTypeSelect.addEventListener('change', function () {
        var type = this.value;
        dynamicFields.innerHTML = '';

        var fields = {
          'bitrix24': [
            { label: 'Битрикс24 уже используется?', type: 'select', options: ['Нет, будем внедрять', 'Да, облако', 'Да, коробка'] },
            { label: 'Количество пользователей', type: 'number' },
            { label: 'Необходимые интеграции', type: 'text', placeholder: '1С, телефония, сайт...' }
          ],
          'web-system': [
            { label: 'Тип проекта', type: 'select', options: ['Корпоративный сайт', 'Интернет-магазин', 'B2B-портал', 'Личный кабинет', 'Каталог'] },
            { label: 'Есть ли действующий сайт?', type: 'select', options: ['Нет', 'Да'] },
            { label: 'Необходима интеграция с 1С?', type: 'select', options: ['Да', 'Нет', 'Пока не знаю'] },
            { label: 'Размер каталога (товаров)', type: 'number' }
          ],
          'integration': [
            { label: 'Какие системы нужно связать?', type: 'text', placeholder: 'Битрикс24, 1С, сайт...' },
            { label: 'Какие данные передавать?', type: 'text', placeholder: 'Клиенты, товары, заказы...' },
            { label: 'Направление обмена', type: 'select', options: ['Односторонний', 'Двусторонний'] },
            { label: 'Есть ли техническая документация?', type: 'select', options: ['Да', 'Нет'] }
          ]
        };

        var typeFields = fields[type] || [];
        typeFields.forEach(function (field) {
          var div = document.createElement('div');
          div.className = 'form-group';

          var label = document.createElement('label');
          label.textContent = field.label;
          div.appendChild(label);

          if (field.type === 'select') {
            var select = document.createElement('select');
            select.className = 'form-control';
            select.name = field.label;
            field.options.forEach(function (opt) {
              var option = document.createElement('option');
              option.value = opt;
              option.textContent = opt;
              select.appendChild(option);
            });
            div.appendChild(select);
          } else {
            var input = document.createElement('input');
            input.type = field.type;
            input.className = 'form-control';
            input.name = field.label;
            input.placeholder = field.placeholder || '';
            div.appendChild(input);
          }

          dynamicFields.appendChild(div);
        });
      });
    }

    projectForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var isValid = true;
      var requiredFields = projectForm.querySelectorAll('[required]');

      requiredFields.forEach(function (field) {
        field.classList.remove('form-control--error');
      });

      requiredFields.forEach(function (field) {
        if (!field.value.trim()) {
          field.classList.add('form-control--error');
          isValid = false;
        }
        if (field.type === 'email' && field.value.trim()) {
          var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRe.test(field.value.trim())) {
            field.classList.add('form-control--error');
            isValid = false;
          }
        }
      });

      // Check consent
      var consent = projectForm.querySelector('input[type="checkbox"][name="consent"]');
      if (consent && !consent.checked) {
        consent.classList.add('form-control--error');
        isValid = false;
      }

      if (isValid) {
        // Simulate submit - replace with actual endpoint
        var submitBtn = projectForm.querySelector('button[type="submit"]');
        if (submitBtn) {
          submitBtn.textContent = 'Отправка...';
          submitBtn.disabled = true;
        }

        // Store UTM params
        var utmParams = {};
        var searchParams = new URLSearchParams(window.location.search);
        ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'].forEach(function (param) {
          if (searchParams.get(param)) {
            utmParams[param] = searchParams.get(param);
          }
        });

        // Redirect to success page
        setTimeout(function () {
          window.location.href = 'success.html?' + new URLSearchParams(utmParams).toString();
        }, 1000);
      }
    });
  }

  /* ───────── FAQ Accordion ───────── */
  document.addEventListener('click', function (e) {
    var faqBtn = e.target.closest('.faq-question');
    if (faqBtn) {
      var item = faqBtn.closest('.faq-item');
      if (!item) return;
      var answer = item.querySelector('.faq-answer');
      var icon = faqBtn.querySelector('.faq-question__icon');
      var isOpen = item.classList.contains('faq-item--open');

      // Close all
      document.querySelectorAll('.faq-item.faq-item--open').forEach(function (openItem) {
        if (openItem !== item) {
          openItem.classList.remove('faq-item--open');
          openItem.querySelector('.faq-answer').style.maxHeight = null;
          var openIcon = openItem.querySelector('.faq-question__icon');
          if (openIcon) openIcon.textContent = '+';
        }
      });

      if (isOpen) {
        item.classList.remove('faq-item--open');
        answer.style.maxHeight = null;
        if (icon) icon.textContent = '+';
      } else {
        item.classList.add('faq-item--open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        if (icon) icon.textContent = '−';
      }
    }
  });

  /* ───────── Phone Mask ───────── */
  document.addEventListener('input', function (e) {
    if (e.target.type !== 'tel') return;
    var value = e.target.value.replace(/\D/g, '');
    var formatted = '';

    if (value.length === 0) {
      formatted = '';
    } else {
      if (value[0] === '8') {
        value = '7' + value.substring(1);
      }
      if (value[0] !== '7') {
        value = '7' + value;
      }

      formatted = '+7';
      if (value.length > 1) formatted += ' (' + value.substring(1, 4);
      if (value.length >= 4) formatted += ') ';
      if (value.length > 4) formatted += value.substring(4, 7);
      if (value.length > 7) formatted += '-' + value.substring(7, 9);
      if (value.length > 9) formatted += '-' + value.substring(9, 11);
    }

    e.target.value = formatted;
  });

  /* ───────── Scroll animations (Intersection Observer) ───────── */
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

    document.querySelectorAll('.animate-on-scroll').forEach(function (el) {
      observer.observe(el);
    });
  } else {
    document.querySelectorAll('.animate-on-scroll').forEach(function (el) {
      el.classList.add('animate-on-scroll--visible');
    });
  }

  /* ───────── Current year in footer ───────── */
  var yearEl = document.getElementById('currentYear');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }

  /* ───────── Cookie Notice ───────── */
  var cookieNotice = document.querySelector('.cookie-notice');
  if (cookieNotice) {
    try {
      if (!localStorage.getItem('dianomi_cookies_accepted')) {
        cookieNotice.classList.add('cookie-notice--visible');
      }
    } catch (e) {}

    var acceptBtn = cookieNotice.querySelector('.cookie-notice__accept');
    if (acceptBtn) {
      acceptBtn.addEventListener('click', function () {
        try { localStorage.setItem('dianomi_cookies_accepted', '1'); } catch (e) {}
        cookieNotice.classList.remove('cookie-notice--visible');
      });
    }
  }

  /* ───────── CTA Form Handler ───────── */
  window.handleFormSubmit = function(e) {
    e.preventDefault();
    var form = e.target;
    var name = form.querySelector('[name="name"]').value;
    var phone = form.querySelector('[name="phone"]').value;
    var message = form.querySelector('[name="message"]').value;
    console.log('Form submitted:', {name, phone, message});
    alert('Спасибо! Мы свяжемся с вами в ближайшее время.');
    form.reset();
    return false;
  };

  /* ───────── Initialize all modules ───────── */
  initMobileMenu();
  initDropdown();
  initMegaMenu();

})();
