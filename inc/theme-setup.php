<?php
/**
 * Theme Setup — registers theme features with WordPress
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function lmw_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'lmw-theme', LMW_THEME_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );

    // Image sizes for product display
    add_image_size( 'lmw-hero', 1920, 800, true );
    add_image_size( 'lmw-product-card', 600, 750, true );
    add_image_size( 'lmw-product-thumb', 300, 375, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary'   => esc_html__( 'Primary Menu', 'lmw-theme' ),
        'footer'    => esc_html__( 'Footer Menu', 'lmw-theme' ),
        'category'  => esc_html__( 'Category Menu', 'lmw-theme' ),
    ) );

    // HTML5 markup support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ) );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Selective refresh for widgets in customizer
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Wide alignment support for block editor
    add_theme_support( 'align-wide' );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Editor styles
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'lmw_theme_setup' );

/**
 * Set the content width based on the theme's design.
 */
function lmw_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'lmw_theme_content_width', 1280 );
}
add_action( 'after_setup_theme', 'lmw_theme_content_width', 0 );

/**
 * Register widget areas.
 */
function lmw_theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'lmw-theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here for the shop sidebar.', 'lmw-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'lmw-theme' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'First footer widget column.', 'lmw-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'lmw-theme' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Second footer widget column.', 'lmw-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'lmw-theme' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Third footer widget column.', 'lmw-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'lmw_theme_widgets_init' );
