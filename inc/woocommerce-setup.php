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
    // Remove WooCommerce float-based layouts and smallscreen CSS;
    // our theme provides full modern flexbox & grid responsive styling.
    unset( $enqueue_styles['woocommerce-smallscreen'] );
    unset( $enqueue_styles['woocommerce-layout'] );
    return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'lmw_theme_dequeue_wc_styles' );

/**
 * Filter default WooCommerce placeholder image to use our high-res AI studio shirt image.
 */
function lmw_theme_wc_placeholder_img_src( $src ) {
    return LMW_THEME_URI . '/assets/images/shirt-1.jpg';
}
add_filter( 'woocommerce_placeholder_img_src', 'lmw_theme_wc_placeholder_img_src' );

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

/**
 * Enable customer registration on the My Account page.
 */
add_filter( 'pre_option_woocommerce_enable_myaccount_registration', function() {
    return 'yes';
} );

/**
 * Allow customers to create their own password during registration.
 */
add_filter( 'pre_option_woocommerce_registration_generate_password', function() {
    return 'no';
} );

/**
 * Ensure WooCommerce loads theme template overrides directly from theme's woocommerce/ directory.
 */
function lmw_theme_wc_locate_template( $template, $template_name, $template_path ) {
    $candidates = array(
        get_stylesheet_directory() . '/woocommerce/' . $template_name,
        get_template_directory() . '/woocommerce/' . $template_name,
        defined( 'LMW_THEME_DIR' ) ? LMW_THEME_DIR . '/woocommerce/' . $template_name : '',
    );
    foreach ( $candidates as $candidate ) {
        if ( ! empty( $candidate ) && file_exists( $candidate ) ) {
            return $candidate;
        }
    }
    return $template;
}
add_filter( 'woocommerce_locate_template', 'lmw_theme_wc_locate_template', 999, 3 );
