/**
 * LMW Fashion — Main JavaScript
 *
 * Handles:
 * - Mobile navigation menu
 * - Sticky header
 * - Quick search modal
 * - Client-side Wishlist (LocalStorage)
 * - Size Guide Modal
 * - Quantity buttons (+ / -)
 *
 * @package LMW_Theme
 */

(function () {
    'use strict';

    var WISHLIST_STORAGE_KEY = 'lmw_user_wishlist';

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
     * Search Modal Overlay
     */
    function initSearchModal() {
        var openBtns = document.querySelectorAll('.js-open-search-modal');
        var closeBtns = document.querySelectorAll('.js-close-search-modal');
        var modal = document.getElementById('lmw-search-modal');
        var input = document.getElementById('lmw-header-search-input');

        if (!modal) {
            return;
        }

        function openModal() {
            modal.style.display = 'block';
            document.body.classList.add('lmw-modal-open');
            if (input) {
                setTimeout(function () {
                    input.focus();
                }, 100);
            }
        }

        function closeModal() {
            modal.style.display = 'none';
            document.body.classList.remove('lmw-modal-open');
        }

        openBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                openModal();
            });
        });

        closeBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                closeModal();
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.style.display === 'block') {
                closeModal();
            }
        });
    }

    /**
     * Size Guide Modal
     */
    function initSizeGuideModal() {
        var openBtns = document.querySelectorAll('.js-open-size-guide');
        var closeBtns = document.querySelectorAll('.js-close-size-guide');
        var modal = document.getElementById('lmw-size-guide-modal');

        if (!modal) {
            return;
        }

        function openModal() {
            modal.style.display = 'flex';
            document.body.classList.add('lmw-modal-open');
        }

        function closeModal() {
            modal.style.display = 'none';
            document.body.classList.remove('lmw-modal-open');
        }

        openBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                openModal();
            });
        });

        closeBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                closeModal();
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                closeModal();
            }
        });
    }

    /**
     * Wishlist Manager (LocalStorage)
     */
    var Wishlist = {
        getItems: function () {
            try {
                var stored = localStorage.getItem(WISHLIST_STORAGE_KEY);
                return stored ? JSON.parse(stored) : [];
            } catch (err) {
                return [];
            }
        },

        setItems: function (items) {
            try {
                localStorage.setItem(WISHLIST_STORAGE_KEY, JSON.stringify(items));
            } catch (err) {}
            this.updateBadge();
            this.updateButtons();
        },

        hasItem: function (id) {
            var items = this.getItems();
            return items.some(function (item) {
                return String(item.id) === String(id);
            });
        },

        toggleItem: function (itemData) {
            var items = this.getItems();
            var id = String(itemData.id);
            var existsIndex = items.findIndex(function (i) {
                return String(i.id) === id;
            });

            if (existsIndex > -1) {
                items.splice(existsIndex, 1);
            } else {
                items.push(itemData);
            }

            this.setItems(items);
            return existsIndex === -1; // true if added
        },

        removeItem: function (id) {
            var items = this.getItems();
            var filtered = items.filter(function (i) {
                return String(i.id) !== String(id);
            });
            this.setItems(filtered);
        },

        updateBadge: function () {
            var count = this.getItems().length;
            var badges = document.querySelectorAll('.js-wishlist-count');
            badges.forEach(function (b) {
                b.textContent = count;
                b.style.display = count > 0 ? 'inline-flex' : 'none';
            });
        },

        updateButtons: function () {
            var self = this;
            var buttons = document.querySelectorAll('.js-wishlist-toggle');
            buttons.forEach(function (btn) {
                var id = btn.getAttribute('data-id');
                if (id && self.hasItem(id)) {
                    btn.classList.add('is-active');
                    btn.setAttribute('aria-label', 'Remove from wishlist');
                } else {
                    btn.classList.remove('is-active');
                    btn.setAttribute('aria-label', 'Add to wishlist');
                }
            });
        },

        formatPrice: function (raw) {
            if (!raw) return '';
            var str = String(raw)
                .replace(/Original price was:[\s\S]*?Current price is:\s*/gi, ' ')
                .replace(/Original price was:[\s\S]*/gi, '')
                .trim();
            var matches = str.match(/([₹$€£][\d,.]+(\.\d{2})?)/g);
            if (matches && matches.length >= 2) {
                return '<span class="lmw-strike">' + matches[0] + '</span> <span class="lmw-current-price">' + matches[matches.length - 1] + '</span>';
            }
            if (matches && matches.length === 1) {
                return '<span class="lmw-current-price">' + matches[0] + '</span>';
            }
            return str;
        },

        renderPage: function () {
            var container = document.getElementById('lmw-wishlist-container');
            if (!container) {
                return;
            }

            var emptyState = document.getElementById('lmw-wishlist-empty');
            var grid = document.getElementById('lmw-wishlist-grid');
            var items = this.getItems();

            if (!emptyState || !grid) {
                return;
            }

            if (items.length === 0) {
                emptyState.style.display = 'block';
                grid.style.display = 'none';
                grid.innerHTML = '';
                return;
            }

            emptyState.style.display = 'none';
            grid.style.display = 'grid';

            var html = '';
            var self = this;
            items.forEach(function (item) {
                var displayPrice = self.formatPrice(item.price);
                html += '<div class="lmw-wishlist-item" data-id="' + item.id + '">';
                html += '  <div class="lmw-wishlist-item__img">';
                html += '    <a href="' + item.url + '"><img src="' + item.image + '" alt="' + item.title + '"></a>';
                html += '    <button type="button" class="lmw-wishlist-item__remove js-wishlist-remove" data-id="' + item.id + '" aria-label="Remove item">&times;</button>';
                html += '  </div>';
                html += '  <div class="lmw-wishlist-item__body">';
                html += '    <h3 class="lmw-wishlist-item__title"><a href="' + item.url + '">' + item.title + '</a></h3>';
                html += '    <div class="lmw-wishlist-item__price">' + displayPrice + '</div>';
                html += '    <a href="' + item.url + '" class="lmw-btn lmw-btn--primary lmw-btn--sm lmw-wishlist-item__btn">View Product</a>';
                html += '  </div>';
                html += '</div>';
            });

            grid.innerHTML = html;

            // Bind remove buttons
            var removeBtns = grid.querySelectorAll('.js-wishlist-remove');
            var self = this;
            removeBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var id = btn.getAttribute('data-id');
                    if (id) {
                        self.removeItem(id);
                        self.renderPage();
                    }
                });
            });
        },

        init: function () {
            var self = this;

            // Update badge & buttons on load
            this.updateBadge();
            this.updateButtons();

            // Toggle button event listeners
            document.addEventListener('click', function (e) {
                var btn = e.target.closest('.js-wishlist-toggle');
                if (!btn) {
                    return;
                }
                e.preventDefault();

                var itemData = {
                    id: btn.getAttribute('data-id'),
                    title: btn.getAttribute('data-title'),
                    price: self.formatPrice(btn.getAttribute('data-price')),
                    image: btn.getAttribute('data-image'),
                    url: btn.getAttribute('data-url')
                };

                if (itemData.id) {
                    var added = self.toggleItem(itemData);
                    // Add subtle pop animation
                    btn.classList.add('lmw-pop-anim');
                    setTimeout(function () {
                        btn.classList.remove('lmw-pop-anim');
                    }, 400);

                    // Re-render wishlist page if user is currently on it
                    self.renderPage();
                }
            });

            // If on wishlist page, render items
            this.renderPage();
        }
    };

    /**
     * Quantity adjusters (+ and - buttons)
     */
    function initQuantityButtons() {
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.lmw-qty-btn');
            if (!btn) {
                return;
            }
            var container = btn.closest('.quantity');
            if (!container) {
                return;
            }
            var input = container.querySelector('input.qty');
            if (!input) {
                return;
            }

            var currentVal = parseFloat(input.value) || 1;
            var min = parseFloat(input.getAttribute('min')) || 1;
            var max = parseFloat(input.getAttribute('max')) || 999;
            var step = parseFloat(input.getAttribute('step')) || 1;

            if (btn.classList.contains('lmw-qty-btn--plus')) {
                if (currentVal + step <= max) {
                    input.value = currentVal + step;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            } else if (btn.classList.contains('lmw-qty-btn--minus')) {
                if (currentVal - step >= min) {
                    input.value = currentVal - step;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
        });
    }

    /**
     * Initialize on DOM ready
     */
    document.addEventListener('DOMContentLoaded', function () {
        initMobileMenu();
        initStickyHeader();
        initSearchModal();
        initSizeGuideModal();
        initQuantityButtons();
        Wishlist.init();
    });
})();
