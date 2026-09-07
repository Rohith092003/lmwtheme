<?php
/**
 * Template Part: New Arrivals
 *
 * Shows latest products sorted by date.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-section lmw-products-section lmw-products-section--alt" id="new-arrivals">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Just In', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'New Arrivals', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-products-grid">
            <?php
            echo do_shortcode( '[products limit="8" columns="4" orderby="date" order="DESC"]' );
            ?>
        </div>

        <div class="lmw-section__footer">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) . '?orderby=date' ); ?>" class="lmw-btn lmw-btn--outline">
                <?php esc_html_e( 'See What\'s New', 'lmw-theme' ); ?>
            </a>
        </div>
    </div>
</section>
