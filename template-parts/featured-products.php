<?php
/**
 * Template Part: Featured Products
 *
 * Displays products tagged as "featured" in WooCommerce.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-section lmw-products-section" id="featured-products">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Curated for You', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'Featured Products', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-products-grid">
            <?php
            echo do_shortcode( '[products limit="8" columns="4" visibility="featured" orderby="date" order="DESC"]' );
            ?>
        </div>

        <div class="lmw-section__footer">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--outline">
                <?php esc_html_e( 'View All Products', 'lmw-theme' ); ?>
            </a>
        </div>
    </div>
</section>
