<?php
/**
 * LMW Fashion Theme — functions.php
 *
 * Standalone WooCommerce-compatible WordPress theme.
 * No parent theme dependency.
 *
 * @package LMW_Theme
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme Constants
 */
define( 'LMW_THEME_VERSION', '1.0.6' );
define( 'LMW_THEME_DIR', get_template_directory() );
define( 'LMW_THEME_URI', get_template_directory_uri() );

/**
 * Load theme includes
 */
require_once LMW_THEME_DIR . '/inc/theme-setup.php';
require_once LMW_THEME_DIR . '/inc/enqueue.php';
require_once LMW_THEME_DIR . '/inc/customizer.php';
require_once LMW_THEME_DIR . '/inc/template-functions.php';

/**
 * Load WooCommerce integration if WooCommerce is active
 */
if ( class_exists( 'WooCommerce' ) ) {
    require_once LMW_THEME_DIR . '/inc/woocommerce-setup.php';
}
