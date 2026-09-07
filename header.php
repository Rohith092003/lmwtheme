<?php
/**
 * The header template
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#main-content">
    <?php esc_html_e( 'Skip to content', 'lmw-theme' ); ?>
</a>

<header id="site-header" class="lmw-header">
    <div class="lmw-container lmw-header__inner">

        <div class="lmw-header__logo">
            <?php lmw_theme_site_logo(); ?>
        </div>

        <nav id="site-navigation" class="lmw-header__nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'lmw-theme' ); ?>">
            <button class="lmw-header__menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'lmw-theme' ); ?>">
                <span class="lmw-hamburger"></span>
            </button>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'lmw-nav-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>

        <div class="lmw-header__actions">
            <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="lmw-header__action" aria-label="<?php esc_attr_e( 'My Account', 'lmw-theme' ); ?>">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </a>
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="lmw-header__action lmw-header__cart" aria-label="<?php esc_attr_e( 'Cart', 'lmw-theme' ); ?>">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    <span class="lmw-header__cart-count"><?php echo esc_html( lmw_theme_cart_count() ); ?></span>
                </a>
            <?php endif; ?>
        </div>

    </div>
</header>
