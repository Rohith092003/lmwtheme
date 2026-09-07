<?php
/**
 * Template Part: Why Choose Us
 *
 * Trust/value proposition section with icon cards.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$features = array(
    array(
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
        'title' => __( 'Premium Fabrics', 'lmw-theme' ),
        'desc'  => __( 'Carefully selected materials for comfort and durability that lasts.', 'lmw-theme' ),
    ),
    array(
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>',
        'title' => __( 'Fast Delivery', 'lmw-theme' ),
        'desc'  => __( 'Quick and reliable shipping across India with real-time tracking.', 'lmw-theme' ),
    ),
    array(
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
        'title' => __( 'Best Value', 'lmw-theme' ),
        'desc'  => __( 'Premium quality at fair prices. No middlemen, direct to you.', 'lmw-theme' ),
    ),
    array(
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
        'title' => __( 'Easy Returns', 'lmw-theme' ),
        'desc'  => __( 'Hassle-free 7-day return policy. Your satisfaction is our priority.', 'lmw-theme' ),
    ),
);
?>

<section class="lmw-section lmw-features" id="why-us">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'The LMW Difference', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'Why Choose Us', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-features__grid">
            <?php foreach ( $features as $f ) : ?>
                <div class="lmw-features__card">
                    <div class="lmw-features__icon">
                        <?php echo $f['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — SVG markup is hardcoded above ?>
                    </div>
                    <h3 class="lmw-features__title"><?php echo esc_html( $f['title'] ); ?></h3>
                    <p class="lmw-features__desc"><?php echo esc_html( $f['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
