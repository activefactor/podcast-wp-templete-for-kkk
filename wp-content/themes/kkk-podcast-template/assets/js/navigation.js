(function () {
  'use strict';

  var toggle = document.querySelector('.kkk-nav-toggle');
  var mobileNav = document.getElementById('kkk-mobile-nav');

  if (!toggle || !mobileNav) return;

  toggle.addEventListener('click', function () {
    var expanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!expanded));
    if (expanded) {
      mobileNav.setAttribute('hidden', '');
    } else {
      mobileNav.removeAttribute('hidden');
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      toggle.setAttribute('aria-expanded', 'false');
      mobileNav.setAttribute('hidden', '');
      toggle.focus();
    }
  });
})();
