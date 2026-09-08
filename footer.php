<?php
/**
 * The footer template
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<footer id="site-footer" class="lmw-footer">
    <div class="lmw-container">

        <div class="lmw-footer__grid">
            <div class="lmw-footer__col lmw-footer__brand">
                <?php lmw_theme_site_logo(); ?>
                <p class="lmw-footer__tagline">
                    <?php bloginfo( 'description' ); ?>
                </p>
                <?php lmw_theme_social_links(); ?>
            </div>

            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="lmw-footer__col">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <div class="lmw-footer__col">
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="lmw-footer__col">
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="lmw-footer__bottom">
            <?php
            $footer_site_name = get_bloginfo( 'name' );
            if ( empty( $footer_site_name ) || false !== strpos( $footer_site_name, 'hostingersite.com' ) ) {
                $footer_site_name = 'LMW Fashion';
            }
            ?>
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $footer_site_name ); ?>. <?php esc_html_e( 'All rights reserved.', 'lmw-theme' ); ?></p>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer',
                'menu_class'     => 'lmw-footer__menu',
                'container'      => false,
                'fallback_cb'    => 'lmw_theme_default_footer_menu',
                'depth'          => 1,
            ) );
            ?>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
