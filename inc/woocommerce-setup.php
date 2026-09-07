<?php
/**
 * WooCommerce Setup — Theme integration with WooCommerce
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Declare WooCommerce support.
 */
function lmw_theme_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 4,
            'min_rows'        => 1,
            'default_columns' => 4,
            'min_columns'     => 1,
            'max_columns'     => 6,
        ),
    ) );

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'lmw_theme_woocommerce_support' );

/**
 * Enqueue WooCommerce-specific styles.
 */
function lmw_theme_woocommerce_styles() {
    wp_enqueue_style(
        'lmw-woocommerce-css',
        LMW_THEME_URI . '/assets/css/shop.css',
        array( 'lmw-theme-style' ),
        LMW_THEME_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'lmw_theme_woocommerce_styles' );

/**
 * Disable default WooCommerce styles that we override.
 */
function lmw_theme_dequeue_wc_styles( $enqueue_styles ) {
    // Keep WooCommerce's general and layout styles,
    // remove smallscreen (we handle responsive ourselves)
    unset( $enqueue_styles['woocommerce-smallscreen'] );
    return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'lmw_theme_dequeue_wc_styles' );

/**
 * Change number of products per row.
 */
function lmw_theme_wc_products_per_row() {
    return 4;
}
add_filter( 'loop_shop_columns', 'lmw_theme_wc_products_per_row' );

/**
 * Change number of products displayed per page.
 */
function lmw_theme_wc_products_per_page() {
    return 16;
}
add_filter( 'loop_shop_per_page', 'lmw_theme_wc_products_per_page' );

/**
 * WooCommerce content wrappers matching our theme markup.
 */
function lmw_theme_wc_wrapper_before() {
    echo '<main id="main-content" class="lmw-main"><div class="lmw-container">';
}

function lmw_theme_wc_wrapper_after() {
    echo '</div></main>';
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'lmw_theme_wc_wrapper_before' );
add_action( 'woocommerce_after_main_content', 'lmw_theme_wc_wrapper_after' );

/**
 * WooCommerce breadcrumb defaults.
 */
function lmw_theme_wc_breadcrumb_defaults( $defaults ) {
    $defaults['delimiter']   = ' <span class="lmw-breadcrumb-sep">/</span> ';
    $defaults['wrap_before'] = '<nav class="lmw-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'lmw-theme' ) . '"><div class="lmw-container">';
    $defaults['wrap_after']  = '</div></nav>';
    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'lmw_theme_wc_breadcrumb_defaults' );
