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
            <!-- Search Button -->
            <button type="button" class="lmw-header__action lmw-header__search-btn js-open-search-modal" aria-label="<?php esc_attr_e( 'Search products', 'lmw-theme' ); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>

            <!-- Wishlist Button -->
            <a href="<?php echo esc_url( home_url( '/wishlist/' ) ); ?>" class="lmw-header__action lmw-header__wishlist" aria-label="<?php esc_attr_e( 'Wishlist', 'lmw-theme' ); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
                <span class="lmw-header__badge lmw-header__wishlist-count js-wishlist-count" style="display:none;">0</span>
            </a>

            <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                <!-- My Account -->
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="lmw-header__action" aria-label="<?php esc_attr_e( 'My Account', 'lmw-theme' ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </a>
                
                <!-- Cart -->
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="lmw-header__action lmw-header__cart" aria-label="<?php esc_attr_e( 'Cart', 'lmw-theme' ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    <span class="lmw-header__badge lmw-header__cart-count"><?php echo esc_html( lmw_theme_cart_count() ); ?></span>
                </a>
            <?php endif; ?>
        </div>

    </div>

    <!-- Quick Search Modal Overlay -->
    <div id="lmw-search-modal" class="lmw-search-modal" style="display: none;" role="dialog" aria-modal="true">
        <div class="lmw-search-modal__backdrop js-close-search-modal"></div>
        <div class="lmw-search-modal__box">
            <div class="lmw-container">
                <form role="search" method="get" class="lmw-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="hidden" name="post_type" value="product" />
                    <div class="lmw-search-input-wrapper">
                        <svg class="lmw-search-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="search" id="lmw-header-search-input" class="lmw-search-field" placeholder="<?php esc_attr_e( 'Search shirts by color, fabric, fit, or style...', 'lmw-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
                        <button type="button" class="lmw-search-close-btn js-close-search-modal" aria-label="<?php esc_attr_e( 'Close search', 'lmw-theme' ); ?>">&times;</button>
                    </div>
                </form>
                <div class="lmw-search-suggestions">
                    <span class="lmw-search-suggestions__label"><?php esc_html_e( 'Popular Searches:', 'lmw-theme' ); ?></span>
                    <a href="<?php echo esc_url( home_url( '/?s=linen&post_type=product' ) ); ?>">Linen Shirts</a>
                    <a href="<?php echo esc_url( home_url( '/?s=cotton&post_type=product' ) ); ?>">Pure Cotton</a>
                    <a href="<?php echo esc_url( home_url( '/?s=denim&post_type=product' ) ); ?>">Denim</a>
                    <a href="<?php echo esc_url( home_url( '/?s=formal&post_type=product' ) ); ?>">Formal Slim Fit</a>
                </div>
            </div>
        </div>
    </div>

</header>
