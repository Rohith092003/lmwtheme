<?php
/**
 * Template Part: Newsletter / CTA
 *
 * Email subscription call-to-action section.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-section lmw-newsletter" id="newsletter">
    <div class="lmw-container">
        <div class="lmw-newsletter__inner">
            <h2 class="lmw-newsletter__title"><?php esc_html_e( 'Stay in Style', 'lmw-theme' ); ?></h2>
            <p class="lmw-newsletter__text">
                <?php esc_html_e( 'Subscribe for exclusive offers, new arrivals, and styling tips delivered to your inbox.', 'lmw-theme' ); ?>
            </p>
            <form class="lmw-newsletter__form" action="#" method="post">
                <input
                    type="email"
                    name="email"
                    class="lmw-newsletter__input"
                    placeholder="<?php esc_attr_e( 'Enter your email address', 'lmw-theme' ); ?>"
                    required
                    aria-label="<?php esc_attr_e( 'Email address', 'lmw-theme' ); ?>"
                >
                <button type="submit" class="lmw-btn lmw-btn--accent lmw-newsletter__btn">
                    <?php esc_html_e( 'Subscribe', 'lmw-theme' ); ?>
                </button>
            </form>
            <p class="lmw-newsletter__disclaimer">
                <?php esc_html_e( 'No spam, ever. Unsubscribe anytime.', 'lmw-theme' ); ?>
            </p>
        </div>
    </div>
</section>
