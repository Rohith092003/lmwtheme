/**
 * LMW Fashion — Main JavaScript
 *
 * @package LMW_Theme
 */

(function () {
    'use strict';

    /**
     * Mobile menu toggle
     */
    function initMobileMenu() {
        var toggle = document.querySelector('.lmw-header__menu-toggle');
        var menu = document.querySelector('.lmw-nav-menu');

        if (!toggle || !menu) {
            return;
        }

        toggle.addEventListener('click', function () {
            var isOpen = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /**
     * Sticky header scroll effect
     */
    function initStickyHeader() {
        var header = document.querySelector('.lmw-header');
        if (!header) {
            return;
        }

        var scrollThreshold = 50;

        window.addEventListener('scroll', function () {
            if (window.scrollY > scrollThreshold) {
                header.classList.add('lmw-header--scrolled');
            } else {
                header.classList.remove('lmw-header--scrolled');
            }
        }, { passive: true });
    }

    /**
     * Initialize on DOM ready
     */
    document.addEventListener('DOMContentLoaded', function () {
        initMobileMenu();
        initStickyHeader();
    });
})();
