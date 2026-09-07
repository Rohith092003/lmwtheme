<?php
/**
 * Template Part: Best Sellers
 *
 * Shows top-selling products using WooCommerce's popularity sorting.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-section lmw-products-section" id="best-sellers">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Customer Favourites', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'Best Sellers', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-products-grid">
            <?php
            echo do_shortcode( '[products limit="4" columns="4" best_selling="true"]' );
            ?>
        </div>
    </div>
</section>
