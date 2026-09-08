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
