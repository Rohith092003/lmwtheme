<?php
/**
 * Enqueue scripts and styles
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue front-end styles and scripts.
 */
function lmw_theme_enqueue_assets() {
    // Google Fonts: Inter + Playfair Display
    wp_enqueue_style(
        'lmw-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap',
        array(),
        null // null prevents version string for external fonts
    );

    // Main theme stylesheet (style.css)
    wp_enqueue_style(
        'lmw-theme-style',
        get_stylesheet_uri(),
        array( 'lmw-google-fonts' ),
        LMW_THEME_VERSION
    );

    // Additional CSS
    wp_enqueue_style(
        'lmw-main-css',
        LMW_THEME_URI . '/assets/css/main.css',
        array( 'lmw-theme-style' ),
        LMW_THEME_VERSION
    );

    // Homepage CSS (only on front page)
    if ( is_front_page() ) {
        wp_enqueue_style(
            'lmw-homepage-css',
            LMW_THEME_URI . '/assets/css/homepage.css',
            array( 'lmw-theme-style' ),
            LMW_THEME_VERSION
        );
    }

    // Static pages CSS (about, contact, policies)
    if ( is_page() && ! is_front_page() ) {
        wp_enqueue_style(
            'lmw-pages-css',
            LMW_THEME_URI . '/assets/css/pages.css',
            array( 'lmw-theme-style' ),
            LMW_THEME_VERSION
        );
    }

    // Main JS
    wp_enqueue_script(
        'lmw-main-js',
        LMW_THEME_URI . '/assets/js/main.js',
        array(),
        LMW_THEME_VERSION,
        true
    );

    // Shop Faceted Filter JS (Flipkart/Myntra style filtering)
    if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_taxonomy() || is_product_category() ) ) {
        wp_enqueue_script(
            'lmw-shop-filter-js',
            LMW_THEME_URI . '/assets/js/shop-filter.js',
            array(),
            LMW_THEME_VERSION,
            true
        );
        wp_localize_script(
            'lmw-shop-filter-js',
            'lmw_filter_vars',
            array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'lmw_shop_filter_nonce' ),
            )
        );
    }

    // Comment reply script (WordPress standard)
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lmw_theme_enqueue_assets' );
