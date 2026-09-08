<?php
/**
 * Template helper functions
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Display the site logo or site title.
 */
function lmw_theme_site_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    } else {
        $name = get_bloginfo( 'name' );
        if ( empty( $name ) || false !== strpos( $name, 'hostingersite.com' ) ) {
            $name = 'LMW FASHION';
        }
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="lmw-site-title" rel="home">';
        echo esc_html( $name );
        echo '</a>';
    }
}

/**
 * Display social media links from customizer.
 */
function lmw_theme_social_links() {
    $socials = array(
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'twitter'   => 'X',
        'youtube'   => 'YouTube',
    );

    $has_links = false;
    foreach ( $socials as $key => $label ) {
        $url = get_theme_mod( "lmw_social_{$key}", '' );
        if ( ! empty( $url ) ) {
            $has_links = true;
            break;
        }
    }

    if ( ! $has_links ) {
        return;
    }

    echo '<div class="lmw-social-links">';
    foreach ( $socials as $key => $label ) {
        $url = get_theme_mod( "lmw_social_{$key}", '' );
        if ( ! empty( $url ) ) {
            printf(
                '<a href="%s" class="lmw-social-link lmw-social--%s" target="_blank" rel="noopener noreferrer" aria-label="%s">%s</a>',
                esc_url( $url ),
                esc_attr( $key ),
                esc_attr( $label ),
                esc_html( $label )
            );
        }
    }
    echo '</div>';
}

/**
 * Get the WooCommerce cart count.
 *
 * @return int
 */
function lmw_theme_cart_count() {
    if ( function_exists( 'WC' ) && WC()->cart ) {
        return WC()->cart->get_cart_contents_count();
    }
    return 0;
}

/**
 * Conditional body classes.
 *
 * @param array $classes Existing body classes.
 * @return array Modified body classes.
 */
function lmw_theme_body_classes( $classes ) {
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( function_exists( 'is_woocommerce' ) ) {
        if ( is_woocommerce() ) {
            $classes[] = 'lmw-woocommerce-page';
        }
        if ( is_shop() ) {
            $classes[] = 'lmw-shop-page';
        }
    }

    return $classes;
}
add_filter( 'body_class', 'lmw_theme_body_classes' );

/**
 * Default primary navigation fallback when no WordPress menu is assigned.
 */
function lmw_theme_default_primary_menu() {
    $shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
    echo '<ul id="primary-menu" class="lmw-nav-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( $shop_url ) . '">' . esc_html__( 'Shop All', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/product-category/formal-shirts/' ) ) . '">' . esc_html__( 'Formal Shirts', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/product-category/casual-shirts/' ) ) . '">' . esc_html__( 'Casual Shirts', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/order-tracking/' ) ) . '">' . esc_html__( 'Track Order', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'lmw-theme' ) . '</a></li>';
    echo '</ul>';
}

/**
 * Default footer navigation fallback when no WordPress menu is assigned.
 */
function lmw_theme_default_footer_menu() {
    echo '<ul class="lmw-footer__menu">';
    echo '<li><a href="' . esc_url( home_url( '/policies/#privacy' ) ) . '">' . esc_html__( 'Privacy Policy', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/policies/#terms' ) ) . '">' . esc_html__( 'Terms of Service', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/policies/#returns' ) ) . '">' . esc_html__( 'Shipping & Returns', 'lmw-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'lmw-theme' ) . '</a></li>';
    echo '</ul>';
}

/**
 * Virtual router to serve page-contact.php on /contact/ and redirect policy subpaths.
 */
function lmw_theme_virtual_page_router( $template ) {
    if ( is_404() ) {
        $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
        
        if ( 'contact' === $path || 'contact-us' === $path ) {
            status_header( 200 );
            $contact_file = LMW_THEME_DIR . '/page-contact.php';
            if ( file_exists( $contact_file ) ) {
                return $contact_file;
            }
        }
        
        if ( in_array( $path, array( 'privacy-policy', 'terms-conditions', 'refund_returns', 'refund-returns', 'shipping-returns' ), true ) ) {
            wp_safe_redirect( home_url( '/policies/' ), 301 );
            exit;
        }
    }
    return $template;
}
add_filter( 'template_include', 'lmw_theme_virtual_page_router', 99 );
