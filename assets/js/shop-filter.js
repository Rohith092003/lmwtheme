/**
 * LMW Fashion — Shop Faceted Filter Engine (Flipkart / Myntra Style)
 *
 * Handles live AJAX filtering, interactive size chips, price range slider/presets,
 * category selection, color swatches, active filter tags, and mobile drawer.
 *
 * @package LMW_Theme
 */

(function () {
    'use strict';

    function initShopFilters() {
        const sidebar = document.getElementById('lmw-shop-filter-sidebar');
        const form = document.getElementById('lmw-shop-filter-form');
        const gridContainer = document.getElementById('lmw-shop-products-grid');
        const toolbar = document.querySelector('.lmw-shop-toolbar');
        const chipsContainer = document.getElementById('lmw-active-filter-chips');
        const clearAllBtn = document.getElementById('lmw-clear-all-filters');
        const backdrop = document.getElementById('lmw-filter-drawer-backdrop');
        const mobileTrigger = document.getElementById('lmw-mobile-filter-trigger');
        const mobileCloseBtn = document.getElementById('lmw-filter-close-btn');
        const mobileApplyBtn = document.getElementById('lmw-filter-apply-btn');
        const mobileBadge = document.getElementById('lmw-mobile-filter-badge');

        if (!sidebar || !form) return;

        let debounceTimer = null;
        let isFiltering = false;

        // ── 1. Size Chips (Multi-Select) ──
        const sizeChips = sidebar.querySelectorAll('.lmw-size-chip');
        const sizeInput = document.getElementById('lmw-filter-size-input');

        sizeChips.forEach(chip => {
            chip.addEventListener('click', function () {
                this.classList.toggle('is-active');
                const isPressed = this.classList.contains('is-active');
                this.setAttribute('aria-pressed', isPressed ? 'true' : 'false');
                updateSizeInputValue();
                applyFilters();
            });
        });

        function updateSizeInputValue() {
            const activeSizes = Array.from(sidebar.querySelectorAll('.lmw-size-chip.is-active'))
                .map(chip => chip.dataset.size);
            if (sizeInput) sizeInput.value = activeSizes.join(',');
        }

        // ── 2. Category Radio / Selection ──
        const catRadios = form.querySelectorAll('input[name="cat_radio"]');
        const catInput = document.getElementById('lmw-filter-cat-input');

        catRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                catRadios.forEach(r => r.closest('.lmw-filter-checkbox-label')?.classList.remove('is-selected'));
                this.closest('.lmw-filter-checkbox-label')?.classList.add('is-selected');
                if (catInput) catInput.value = this.value;
                applyFilters();
            });
        });

        // ── 3. Color Swatches (Multi-Select) ──
        const colorSwatches = sidebar.querySelectorAll('.lmw-color-swatch-item');
        const colorInput = document.getElementById('lmw-filter-color-input');

        colorSwatches.forEach(swatch => {
            swatch.addEventListener('click', function () {
                this.classList.toggle('is-active');
                updateColorInputValue();
                applyFilters();
            });
        });

        function updateColorInputValue() {
            const activeColors = Array.from(sidebar.querySelectorAll('.lmw-color-swatch-item.is-active'))
                .map(s => s.dataset.color);
            if (colorInput) colorInput.value = activeColors.join(',');
        }

        // ── 4. Price Slider & Quick Presets ──
        const minPriceInput = document.getElementById('lmw-min-price-input');
        const maxPriceInput = document.getElementById('lmw-max-price-input');
        const rangeSlider = document.getElementById('lmw-price-range-slider');
        const presetBtns = sidebar.querySelectorAll('.lmw-price-preset-btn');

        if (rangeSlider && maxPriceInput) {
            rangeSlider.addEventListener('input', function () {
                maxPriceInput.value = this.value;
                debounceApplyFilters();
            });
        }

        if (maxPriceInput && rangeSlider) {
            maxPriceInput.addEventListener('input', function () {
                const val = parseInt(this.value, 10);
                if (!isNaN(val)) rangeSlider.value = val;
                debounceApplyFilters();
            });
        }

        if (minPriceInput) {
            minPriceInput.addEventListener('input', debounceApplyFilters);
        }

        presetBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const min = this.dataset.min || '0';
                const max = this.dataset.max || '4000';
                if (minPriceInput) minPriceInput.value = min;
                if (maxPriceInput) maxPriceInput.value = max;
                if (rangeSlider) rangeSlider.value = max;
                applyFilters();
            });
        });

        function debounceApplyFilters() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(applyFilters, 400);
        }

        // ── 5. Accordion Expand/Collapse ──
        const filterGroupHeaders = sidebar.querySelectorAll('.lmw-filter-group__header');
        filterGroupHeaders.forEach(header => {
            header.addEventListener('click', function () {
                const group = this.closest('.lmw-filter-group');
                if (group) group.classList.toggle('is-collapsed');
            });
        });

        // ── 6. Active Chip Tag Removals ──
        if (chipsContainer) {
            chipsContainer.addEventListener('click', function (e) {
                const button = e.target.closest('button');
                if (!button) return;
                const chip = button.closest('.lmw-filter-chip');
                if (!chip) return;

                const type = chip.dataset.type;
                const val = chip.dataset.value;

                if (type === 'size') {
                    const targetChip = sidebar.querySelector(`.lmw-size-chip[data-size="${val}"]`);
                    if (targetChip) targetChip.classList.remove('is-active');
                    updateSizeInputValue();
                } else if (type === 'cat') {
                    const allCatRadio = sidebar.querySelector('input[name="cat_radio"][value=""]');
                    if (allCatRadio) {
                        allCatRadio.checked = true;
                        catRadios.forEach(r => r.closest('.lmw-filter-checkbox-label')?.classList.remove('is-selected'));
                        allCatRadio.closest('.lmw-filter-checkbox-label')?.classList.add('is-selected');
                    }
                    if (catInput) catInput.value = '';
                } else if (type === 'color') {
                    const targetSwatch = sidebar.querySelector(`.lmw-color-swatch-item[data-color="${val}"]`);
                    if (targetSwatch) targetSwatch.classList.remove('is-active');
                    updateColorInputValue();
                } else if (type === 'price') {
                    if (minPriceInput) minPriceInput.value = '0';
                    if (maxPriceInput) maxPriceInput.value = '4000';
                    if (rangeSlider) rangeSlider.value = '4000';
                }

                applyFilters();
            });
        }

        // ── 7. Reset / Clear All Filters ──
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', resetAllFilters);
        }

        document.addEventListener('click', function (e) {
            if (e.target.closest('.lmw-reset-filters-btn')) {
                resetAllFilters();
            }
        });

        function resetAllFilters() {
            // Uncheck categories
            const allCatRadio = sidebar.querySelector('input[name="cat_radio"][value=""]');
            if (allCatRadio) {
                allCatRadio.checked = true;
                catRadios.forEach(r => r.closest('.lmw-filter-checkbox-label')?.classList.remove('is-selected'));
                allCatRadio.closest('.lmw-filter-checkbox-label')?.classList.add('is-selected');
            }
            if (catInput) catInput.value = '';

            // Deselect sizes
            sizeChips.forEach(chip => {
                chip.classList.remove('is-active');
                chip.setAttribute('aria-pressed', 'false');
            });
            if (sizeInput) sizeInput.value = '';

            // Deselect colors
            colorSwatches.forEach(swatch => swatch.classList.remove('is-active'));
            if (colorInput) colorInput.value = '';

            // Reset price
            if (minPriceInput) minPriceInput.value = '0';
            if (maxPriceInput) maxPriceInput.value = '4000';
            if (rangeSlider) rangeSlider.value = '4000';

            applyFilters();
        }

        // ── 8. Mobile Drawer Open/Close ──
        function openMobileDrawer() {
            sidebar.classList.add('is-open');
            if (backdrop) backdrop.classList.add('is-active');
            document.body.classList.add('lmw-drawer-open');
        }

        function closeMobileDrawer() {
            sidebar.classList.remove('is-open');
            if (backdrop) backdrop.classList.remove('is-active');
            document.body.classList.remove('lmw-drawer-open');
        }

        if (mobileTrigger) mobileTrigger.addEventListener('click', openMobileDrawer);
        if (mobileCloseBtn) mobileCloseBtn.addEventListener('click', closeMobileDrawer);
        if (backdrop) backdrop.addEventListener('click', closeMobileDrawer);
        if (mobileApplyBtn) {
            mobileApplyBtn.addEventListener('click', function () {
                closeMobileDrawer();
            });
        }

        // ── 9. Live AJAX Filter Engine ──
        function applyFilters() {
            if (isFiltering) return;
            isFiltering = true;

            const currentSizes = sizeInput ? sizeInput.value : '';
            const currentColors = colorInput ? colorInput.value : '';
            const currentCat = catInput ? catInput.value : '';
            const currentMinPrice = minPriceInput ? parseFloat(minPriceInput.value) || 0 : 0;
            const currentMaxPrice = maxPriceInput ? parseFloat(maxPriceInput.value) || 4000 : 4000;
            const orderbySelect = document.querySelector('select.orderby');
            const currentOrderby = orderbySelect ? orderbySelect.value : 'menu_order';

            // Update Active Filter Chips in DOM
            renderActiveChips(currentCat, currentSizes, currentColors, currentMinPrice, currentMaxPrice);

            // Calculate active filter count for badge
            let activeCount = 0;
            if (currentCat) activeCount++;
            if (currentSizes) activeCount += currentSizes.split(',').length;
            if (currentColors) activeCount += currentColors.split(',').length;
            if (currentMinPrice > 0 || currentMaxPrice < 4000) activeCount++;

            if (mobileBadge) {
                if (activeCount > 0) {
                    mobileBadge.textContent = activeCount;
                    mobileBadge.style.display = 'inline-flex';
                } else {
                    mobileBadge.style.display = 'none';
                }
            }

            if (clearAllBtn) {
                clearAllBtn.classList.toggle('is-visible', activeCount > 0);
            }

            // Sync URL parameters
            syncURL(currentCat, currentSizes, currentColors, currentMinPrice, currentMaxPrice, currentOrderby);

            // Shimmer / Opacity fade on product grid
            if (gridContainer) {
                gridContainer.classList.add('lmw-grid-loading');
            }

            // Prepare POST parameters
            const postData = new FormData();
            postData.append('action', 'lmw_filter_products');
            postData.append('nonce', window.lmw_filter_vars ? window.lmw_filter_vars.nonce : '');
            postData.append('product_cat', currentCat);
            postData.append('filter_size', currentSizes);
            postData.append('filter_color', currentColors);
            postData.append('min_price', currentMinPrice);
            postData.append('max_price', currentMaxPrice);
            postData.append('orderby', currentOrderby);

            const ajaxUrl = window.lmw_filter_vars ? window.lmw_filter_vars.ajax_url : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: postData,
            })
                .then(res => res.json())
                .then(data => {
                    isFiltering = false;
                    if (gridContainer) {
                        gridContainer.classList.remove('lmw-grid-loading');
                        if (data.success && data.data.html) {
                            gridContainer.innerHTML = data.data.html;
                        }
                    }

                    // Update result count
                    if (toolbar && data.data && data.data.count_html) {
                        const existingCount = toolbar.querySelector('.woocommerce-result-count');
                        if (existingCount) {
                            existingCount.outerHTML = data.data.count_html;
                        }
                    }

                    // Re-bind wishlist heart buttons for newly loaded products
                    if (window.lmwWishlist && typeof window.lmwWishlist.init === 'function') {
                        window.lmwWishlist.init();
                    }
                })
                .catch(err => {
                    isFiltering = false;
                    if (gridContainer) gridContainer.classList.remove('lmw-grid-loading');
                    console.error('Filter request failed:', err);
                });
        }

        // Render Active Chips
        function renderActiveChips(cat, sizes, colors, minPrice, maxPrice) {
            if (!chipsContainer) return;

            let html = '';
            let hasAny = false;

            if (cat) {
                hasAny = true;
                const catLabel = cat.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                html += `<span class="lmw-filter-chip" data-type="cat" data-value="${cat}">${catLabel} <button type="button" aria-label="Remove filter">&times;</button></span>`;
            }

            if (sizes) {
                sizes.split(',').forEach(s => {
                    if (s) {
                        hasAny = true;
                        html += `<span class="lmw-filter-chip" data-type="size" data-value="${s}">Size: ${s.toUpperCase()} <button type="button" aria-label="Remove filter">&times;</button></span>`;
                    }
                });
            }

            if (colors) {
                colors.split(',').forEach(c => {
                    if (c) {
                        hasAny = true;
                        const cLabel = c.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                        html += `<span class="lmw-filter-chip" data-type="color" data-value="${c}">Color: ${cLabel} <button type="button" aria-label="Remove filter">&times;</button></span>`;
                    }
                });
            }

            if (minPrice > 0 || (maxPrice < 4000 && maxPrice > 0)) {
                hasAny = true;
                html += `<span class="lmw-filter-chip" data-type="price" data-value="price">$${minPrice} - $${maxPrice} <button type="button" aria-label="Remove filter">&times;</button></span>`;
            }

            chipsContainer.innerHTML = html;
            chipsContainer.classList.toggle('has-chips', hasAny);
        }

        // Sync Browser URL
        function syncURL(cat, sizes, colors, minPrice, maxPrice, orderby) {
            const url = new URL(window.location.href);

            if (cat) url.searchParams.set('product_cat', cat);
            else url.searchParams.delete('product_cat');

            if (sizes) url.searchParams.set('filter_size', sizes);
            else url.searchParams.delete('filter_size');

            if (colors) url.searchParams.set('filter_color', colors);
            else url.searchParams.delete('filter_color');

            if (minPrice > 0) url.searchParams.set('min_price', minPrice);
            else url.searchParams.delete('min_price');

            if (maxPrice < 4000) url.searchParams.set('max_price', maxPrice);
            else url.searchParams.delete('max_price');

            if (orderby && orderby !== 'menu_order') url.searchParams.set('orderby', orderby);
            else url.searchParams.delete('orderby');

            window.history.pushState({}, '', url.toString());
        }

        // Connect Catalog Ordering Select
        const orderbySelect = document.querySelector('select.orderby');
        if (orderbySelect) {
            orderbySelect.addEventListener('change', function () {
                applyFilters();
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initShopFilters);
    } else {
        initShopFilters();
    }
})();
