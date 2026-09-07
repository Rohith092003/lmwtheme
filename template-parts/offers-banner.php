<?php
/**
 * Template Part: Offers Banner
 *
 * A promotional mid-page banner / CTA section.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-offers-banner" id="offers">
    <div class="lmw-container">
        <div class="lmw-offers-banner__content">
            <span class="lmw-offers-banner__tag"><?php esc_html_e( 'Limited Time', 'lmw-theme' ); ?></span>
            <h2 class="lmw-offers-banner__title"><?php esc_html_e( 'Flat 20% Off on Formal Shirts', 'lmw-theme' ); ?></h2>
            <p class="lmw-offers-banner__text">
                <?php esc_html_e( 'Upgrade your wardrobe with our premium formal collection. Use code FORMAL20 at checkout.', 'lmw-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--accent">
                <?php esc_html_e( 'Shop the Sale', 'lmw-theme' ); ?>
            </a>
        </div>
    </div>
</section>
