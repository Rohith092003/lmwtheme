<?php
/**
 * Shop Faceted Filter Sidebar Template
 *
 * Flipkart / Myntra inspired faceted filtering:
 * Categories, Sizes, Price Range, and Color swatches.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Current active parameters from GET
$active_cat      = isset( $_GET['product_cat'] ) ? sanitize_text_field( wp_unslash( $_GET['product_cat'] ) ) : ( is_product_category() ? get_queried_object()->slug : '' );
$active_sizes    = isset( $_GET['filter_size'] ) ? array_filter( explode( ',', sanitize_text_field( wp_unslash( $_GET['filter_size'] ) ) ) ) : array();
$active_colors   = isset( $_GET['filter_color'] ) ? array_filter( explode( ',', sanitize_text_field( wp_unslash( $_GET['filter_color'] ) ) ) ) : array();
$min_price_val   = isset( $_GET['min_price'] ) ? absint( $_GET['min_price'] ) : 0;
$max_price_val   = isset( $_GET['max_price'] ) ? absint( $_GET['max_price'] ) : 4000;
$has_active_filters = ( ! empty( $active_cat ) || ! empty( $active_sizes ) || ! empty( $active_colors ) || ( $min_price_val > 0 ) || ( $max_price_val < 4000 && $max_price_val > 0 ) );

// Fetch Product Categories
$categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
    'exclude'    => get_option( 'default_product_cat' ),
) );

// Fetch Available Sizes
$size_terms = taxonomy_exists( 'pa_size' ) ? get_terms( array( 'taxonomy' => 'pa_size', 'hide_empty' => false ) ) : array();
$size_options = array(
    's'   => 'S',
    'm'   => 'M',
    'l'   => 'L',
    'xl'  => 'XL',
    'xxl' => 'XXL',
);
if ( ! empty( $size_terms ) && ! is_wp_error( $size_terms ) ) {
    $size_options = array();
    foreach ( $size_terms as $st ) {
        $size_options[ $st->slug ] = strtoupper( $st->name );
    }
}

// Fetch Available Colors
$color_terms = taxonomy_exists( 'pa_color' ) ? get_terms( array( 'taxonomy' => 'pa_color', 'hide_empty' => false ) ) : array();
$color_swatches = array(
    'french-blue' => array( 'label' => 'French Blue', 'color' => '#2B5FA8' ),
    'ivory'       => array( 'label' => 'Ivory',       'color' => '#F4F1EA' ),
    'black'       => array( 'label' => 'Black',       'color' => '#111827' ),
    'white'       => array( 'label' => 'White',       'color' => '#FFFFFF' ),
    'olive'       => array( 'label' => 'Olive',       'color' => '#556B2F' ),
    'multi'       => array( 'label' => 'Multi',       'color' => 'linear-gradient(135deg, #FF6B6B 0%, #4ECDC4 50%, #45B7D1 100%)' ),
);
?>

<div id="lmw-filter-drawer-backdrop" class="lmw-filter-backdrop"></div>

<aside id="lmw-shop-filter-sidebar" class="lmw-shop-filter-sidebar">

    <!-- Mobile Drawer Header -->
    <div class="lmw-filter-mobile-header">
        <div class="lmw-filter-mobile-header__title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
            <span><?php esc_html_e( 'Filter Products', 'lmw-theme' ); ?></span>
        </div>
        <button type="button" id="lmw-filter-close-btn" class="lmw-filter-close-btn" aria-label="<?php esc_attr_e( 'Close filters', 'lmw-theme' ); ?>">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>

    <!-- Desktop Filter Header & Clear All -->
    <div class="lmw-filter-header">
        <div class="lmw-filter-header__left">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
            <h3 class="lmw-filter-header__title"><?php esc_html_e( 'Filters', 'lmw-theme' ); ?></h3>
        </div>
        <button type="button" id="lmw-clear-all-filters" class="lmw-filter-clear-btn <?php echo $has_active_filters ? 'is-visible' : ''; ?>">
            <?php esc_html_e( 'CLEAR ALL', 'lmw-theme' ); ?>
        </button>
    </div>

    <!-- Active Filter Tag Pills -->
    <div id="lmw-active-filter-chips" class="lmw-active-filter-chips <?php echo $has_active_filters ? 'has-chips' : ''; ?>">
        <?php if ( ! empty( $active_cat ) ) : ?>
            <span class="lmw-filter-chip" data-type="cat" data-value="<?php echo esc_attr( $active_cat ); ?>">
                <?php echo esc_html( ucwords( str_replace( '-', ' ', $active_cat ) ) ); ?>
                <button type="button" aria-label="Remove filter">&times;</button>
            </span>
        <?php endif; ?>

        <?php foreach ( $active_sizes as $sz ) : ?>
            <span class="lmw-filter-chip" data-type="size" data-value="<?php echo esc_attr( $sz ); ?>">
                Size: <?php echo esc_html( strtoupper( $sz ) ); ?>
                <button type="button" aria-label="Remove filter">&times;</button>
            </span>
        <?php endforeach; ?>

        <?php foreach ( $active_colors as $cl ) : ?>
            <span class="lmw-filter-chip" data-type="color" data-value="<?php echo esc_attr( $cl ); ?>">
                Color: <?php echo esc_html( ucwords( str_replace( '-', ' ', $cl ) ) ); ?>
                <button type="button" aria-label="Remove filter">&times;</button>
            </span>
        <?php endforeach; ?>

        <?php if ( $min_price_val > 0 || ( $max_price_val < 4000 && $max_price_val > 0 ) ) : ?>
            <span class="lmw-filter-chip" data-type="price" data-value="price">
                $<?php echo esc_html( $min_price_val ); ?> - $<?php echo esc_html( $max_price_val ); ?>
                <button type="button" aria-label="Remove filter">&times;</button>
            </span>
        <?php endif; ?>
    </div>

    <form id="lmw-shop-filter-form" class="lmw-shop-filter-form" method="get" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
        <input type="hidden" name="filter_size" id="lmw-filter-size-input" value="<?php echo esc_attr( implode( ',', $active_sizes ) ); ?>">
        <input type="hidden" name="filter_color" id="lmw-filter-color-input" value="<?php echo esc_attr( implode( ',', $active_colors ) ); ?>">
        <input type="hidden" name="product_cat" id="lmw-filter-cat-input" value="<?php echo esc_attr( $active_cat ); ?>">

        <!-- 1. CATEGORIES ACCORDION -->
        <div class="lmw-filter-group" data-group="category">
            <div class="lmw-filter-group__header">
                <span class="lmw-filter-group__title"><?php esc_html_e( 'Category', 'lmw-theme' ); ?></span>
                <svg class="lmw-filter-group__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="lmw-filter-group__content">
                <ul class="lmw-filter-list lmw-filter-categories-list">
                    <li class="lmw-filter-category-item">
                        <label class="lmw-filter-checkbox-label <?php echo empty( $active_cat ) ? 'is-selected' : ''; ?>">
                            <input type="radio" name="cat_radio" value="" <?php checked( empty( $active_cat ) ); ?>>
                            <span class="lmw-custom-radio"></span>
                            <span class="lmw-filter-name"><?php esc_html_e( 'All Categories', 'lmw-theme' ); ?></span>
                        </label>
                    </li>
                    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                        <?php foreach ( $categories as $cat ) : ?>
                            <li class="lmw-filter-category-item">
                                <label class="lmw-filter-checkbox-label <?php echo ( $active_cat === $cat->slug ) ? 'is-selected' : ''; ?>">
                                    <input type="radio" name="cat_radio" value="<?php echo esc_attr( $cat->slug ); ?>" <?php checked( $active_cat === $cat->slug ); ?>>
                                    <span class="lmw-custom-radio"></span>
                                    <span class="lmw-filter-name"><?php echo esc_html( $cat->name ); ?></span>
                                    <span class="lmw-filter-count"><?php echo esc_html( $cat->count ); ?></span>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- 2. FLIPKART/MYNTRA STYLE SIZE CHIPS -->
        <div class="lmw-filter-group" data-group="size">
            <div class="lmw-filter-group__header">
                <span class="lmw-filter-group__title"><?php esc_html_e( 'Size', 'lmw-theme' ); ?></span>
                <span class="lmw-filter-group__sub"><?php esc_html_e( 'Multi-select', 'lmw-theme' ); ?></span>
                <svg class="lmw-filter-group__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="lmw-filter-group__content">
                <div class="lmw-filter-size-grid">
                    <?php foreach ( $size_options as $slug => $label ) : ?>
                        <?php $is_size_active = in_array( $slug, $active_sizes, true ); ?>
                        <button type="button" 
                                class="lmw-size-chip <?php echo $is_size_active ? 'is-active' : ''; ?>" 
                                data-size="<?php echo esc_attr( $slug ); ?>"
                                aria-pressed="<?php echo $is_size_active ? 'true' : 'false'; ?>">
                            <?php echo esc_html( $label ); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- 3. PRICE RANGE SLIDER & PRESETS -->
        <div class="lmw-filter-group" data-group="price">
            <div class="lmw-filter-group__header">
                <span class="lmw-filter-group__title"><?php esc_html_e( 'Price Range', 'lmw-theme' ); ?></span>
                <svg class="lmw-filter-group__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="lmw-filter-group__content">
                <!-- Dual inputs -->
                <div class="lmw-price-range-inputs">
                    <div class="lmw-price-input-box">
                        <span class="lmw-currency">$</span>
                        <input type="number" id="lmw-min-price-input" name="min_price" value="<?php echo esc_attr( $min_price_val > 0 ? $min_price_val : 0 ); ?>" min="0" max="4000" step="50" placeholder="Min">
                    </div>
                    <span class="lmw-price-separator">to</span>
                    <div class="lmw-price-input-box">
                        <span class="lmw-currency">$</span>
                        <input type="number" id="lmw-max-price-input" name="max_price" value="<?php echo esc_attr( $max_price_val > 0 ? $max_price_val : 4000 ); ?>" min="0" max="4000" step="50" placeholder="Max">
                    </div>
                </div>

                <!-- Range Track Slider -->
                <div class="lmw-range-slider-wrapper">
                    <input type="range" id="lmw-price-range-slider" min="0" max="4000" step="50" value="<?php echo esc_attr( $max_price_val > 0 ? $max_price_val : 4000 ); ?>" class="lmw-range-slider">
                    <div class="lmw-range-slider-labels">
                        <span>$0</span>
                        <span>$2,000</span>
                        <span>$4,000</span>
                    </div>
                </div>

                <!-- Quick Price Preset Pills -->
                <div class="lmw-price-presets">
                    <button type="button" class="lmw-price-preset-btn" data-min="0" data-max="1000"><?php esc_html_e( 'Under $1,000', 'lmw-theme' ); ?></button>
                    <button type="button" class="lmw-price-preset-btn" data-min="1000" data-max="2000"><?php esc_html_e( '$1,000 - $2,000', 'lmw-theme' ); ?></button>
                    <button type="button" class="lmw-price-preset-btn" data-min="2000" data-max="3000"><?php esc_html_e( '$2,000 - $3,000', 'lmw-theme' ); ?></button>
                    <button type="button" class="lmw-price-preset-btn" data-min="3000" data-max="4000"><?php esc_html_e( '$3,000+', 'lmw-theme' ); ?></button>
                </div>
            </div>
        </div>

        <!-- 4. COLOR SWATCHES -->
        <div class="lmw-filter-group" data-group="color">
            <div class="lmw-filter-group__header">
                <span class="lmw-filter-group__title"><?php esc_html_e( 'Color', 'lmw-theme' ); ?></span>
                <svg class="lmw-filter-group__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="lmw-filter-group__content">
                <div class="lmw-filter-color-list">
                    <?php foreach ( $color_swatches as $cslug => $cinfo ) : ?>
                        <?php $is_color_active = in_array( $cslug, $active_colors, true ); ?>
                        <button type="button" 
                                class="lmw-color-swatch-item <?php echo $is_color_active ? 'is-active' : ''; ?>" 
                                data-color="<?php echo esc_attr( $cslug ); ?>"
                                title="<?php echo esc_attr( $cinfo['label'] ); ?>"
                                aria-label="<?php echo esc_attr( $cinfo['label'] ); ?>">
                            <span class="lmw-color-circle" style="background: <?php echo esc_attr( $cinfo['color'] ); ?>;">
                                <svg class="lmw-check-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="<?php echo ( 'white' === $cslug || 'ivory' === $cslug ) ? '#111827' : '#ffffff'; ?>" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            <span class="lmw-color-label"><?php echo esc_html( $cinfo['label'] ); ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Apply Button -->
        <div class="lmw-filter-mobile-footer">
            <button type="button" id="lmw-filter-apply-btn" class="lmw-btn lmw-btn--primary lmw-filter-apply-btn">
                <?php esc_html_e( 'APPLY FILTERS', 'lmw-theme' ); ?>
            </button>
        </div>

    </form>
</aside>
