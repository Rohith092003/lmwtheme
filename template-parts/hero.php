<?php
/**
 * Template Part: Hero Banner
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-hero" id="hero">
    <div class="lmw-hero__overlay"></div>
    <div class="lmw-container lmw-hero__content">
        <span class="lmw-hero__label"><?php esc_html_e( 'New Collection', 'lmw-theme' ); ?></span>
        <h1 class="lmw-hero__title">
            <?php esc_html_e( 'Elevate Your', 'lmw-theme' ); ?>
            <br>
            <span class="lmw-hero__title--accent"><?php esc_html_e( 'Everyday Style', 'lmw-theme' ); ?></span>
        </h1>
        <p class="lmw-hero__subtitle">
            <?php esc_html_e( 'Premium shirts crafted for comfort and confidence. Discover fits that define you.', 'lmw-theme' ); ?>
        </p>
        <div class="lmw-hero__actions">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--accent">
                <?php esc_html_e( 'Shop Now', 'lmw-theme' ); ?>
            </a>
            <a href="#categories" class="lmw-btn lmw-btn--outline lmw-btn--outline-white">
                <?php esc_html_e( 'Explore Collections', 'lmw-theme' ); ?>
            </a>
        </div>
    </div>
</section>
