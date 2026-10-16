/**
 * Dianomi — Main JavaScript for Bitrix Template
 * Mobile menu, mega menu, scroll animations, smooth scroll
 */

BX.ready(function () {
  'use strict';

  /* ───────── Mobile menu toggle ───────── */
  function openMenu() {
    var mobileMenu = document.getElementById('mobileMenu');
    var mobileOverlay = document.getElementById('mobileOverlay');
    var burger = document.getElementById('burger');
    
    if (!mobileMenu) return;
    
    mobileMenu.classList.add('mobile-menu--open');
    if (mobileOverlay) mobileOverlay.classList.add('mobile-overlay--visible');
    if (burger) burger.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    var mobileMenu = document.getElementById('mobileMenu');
    var mobileOverlay = document.getElementById('mobileOverlay');
    var burger = document.getElementById('burger');
    
    if (!mobileMenu) return;
    
    mobileMenu.classList.remove('mobile-menu--open');
    if (mobileOverlay) mobileOverlay.classList.remove('mobile-overlay--visible');
    if (burger) burger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  /* Burger button */
  var burger = document.getElementById('burger');
  if (burger) {
    burger.addEventListener('click', function () {
      var mobileMenu = document.getElementById('mobileMenu');
      if (mobileMenu && mobileMenu.classList.contains('mobile-menu--open')) {
        closeMenu();
      } else {
        openMenu();
      }
    });
  }

  /* Overlay close */
  var mobileOverlay = document.getElementById('mobileOverlay');
  if (mobileOverlay) {
    mobileOverlay.addEventListener('click', closeMenu);
  }

  /* Mobile menu links close */
  var mobileMenu = document.getElementById('mobileMenu');
  if (mobileMenu) {
    var menuLinks = mobileMenu.querySelectorAll('a');
    menuLinks.forEach(function (link) {
      link.addEventListener('click', closeMenu);
    });
  }

  /* Mobile dropdown toggle */
  if (mobileMenu) {
    var dropdownBtns = mobileMenu.querySelectorAll('.mobile-menu__dropdown-btn');
    dropdownBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var dropdownList = this.nextElementSibling;
        if (dropdownList) {
          var isVisible = dropdownList.style.display === 'block';
          dropdownList.style.display = isVisible ? 'none' : 'block';
          this.setAttribute('aria-expanded', isVisible ? 'false' : 'true');
        }
      });
    });
  }

  /* ───────── Scroll animations ───────── */
  function initScrollAnimations() {
    var elements = document.querySelectorAll('.animate-on-scroll');
    
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('animated');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      });
      
      elements.forEach(function (el) {
        observer.observe(el);
      });
    } else {
      // Fallback: show all elements
      elements.forEach(function (el) {
        el.classList.add('animated');
      });
    }
  }

  initScrollAnimations();

  /* ───────── Dynamic year in footer ───────── */
  var yearEl = document.getElementById('currentYear');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }

  /* ───────── Smooth scroll for anchor links ───────── */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  /* ───────── FAQ Accordion ───────── */
  var faqQuestions = document.querySelectorAll('.faq-question');
  faqQuestions.forEach(function (question) {
    question.addEventListener('click', function () {
      var answer = this.nextElementSibling;
      var isExpanded = this.getAttribute('aria-expanded') === 'true';
      
      // Close all other FAQs
      faqQuestions.forEach(function (q) {
        if (q !== question) {
          q.setAttribute('aria-expanded', 'false');
          var otherAnswer = q.nextElementSibling;
          if (otherAnswer) {
            otherAnswer.classList.remove('open');
          }
        }
      });
      
      // Toggle current FAQ
      this.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
      if (answer) {
        answer.classList.toggle('open');
      }
    });
  });

  /* ───────── Counter Animation ───────── */
  function animateCounters() {
    var counters = document.querySelectorAll('[data-count]');
    
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            var el = entry.target;
            var target = parseInt(el.getAttribute('data-count'), 10);
            var duration = 2000;
            var start = 0;
            var startTime = null;
            
            function step(timestamp) {
              if (!startTime) startTime = timestamp;
              var progress = Math.min((timestamp - startTime) / duration, 1);
              var eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
              el.textContent = Math.floor(eased * target);
              
              if (progress < 1) {
                requestAnimationFrame(step);
              } else {
                el.textContent = target;
              }
            }
            
            requestAnimationFrame(step);
            observer.unobserve(el);
          }
        });
      }, { threshold: 0.5 });
      
      counters.forEach(function (counter) {
        observer.observe(counter);
      });
    } else {
      // Fallback: show target value directly
      counters.forEach(function (counter) {
        var target = counter.getAttribute('data-count');
        counter.textContent = target;
      });
    }
  }

  animateCounters();
});
