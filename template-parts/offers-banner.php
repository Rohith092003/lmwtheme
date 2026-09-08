<?php
/**
 * Template Part: Offers Banner
 *
 * Ultra-sleek promotional mid-page banner with coupon highlight.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-offers-banner" id="offers">
    <div class="lmw-container">
        <div class="lmw-offers-banner__card">
            <div class="lmw-offers-banner__bg-glow"></div>
            <div class="lmw-offers-banner__content">
                <span class="lmw-offers-banner__tag"><?php esc_html_e( 'Exclusive Seasonal Offer', 'lmw-theme' ); ?></span>
                <h2 class="lmw-offers-banner__title"><?php esc_html_e( 'Flat 20% Off on Formal & Linen Shirts', 'lmw-theme' ); ?></h2>
                <p class="lmw-offers-banner__text">
                    <?php esc_html_e( 'Upgrade your executive wardrobe with pure Egyptian cotton craftsmanship. Designed for breathless comfort, tailored fits, and all-day sharpness.', 'lmw-theme' ); ?>
                </p>
                <div class="lmw-offers-banner__coupon">
                    <span class="lmw-offers-banner__coupon-label"><?php esc_html_e( 'Use Promo Code:', 'lmw-theme' ); ?></span>
                    <span class="lmw-offers-banner__coupon-code">FORMAL20</span>
                </div>
                <div class="lmw-offers-banner__action">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--accent lmw-btn--lg">
                        <span><?php esc_html_e( 'Claim Offer & Shop Now', 'lmw-theme' ); ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
