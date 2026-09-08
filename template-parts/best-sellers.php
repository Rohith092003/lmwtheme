<?php
/**
 * Template Part: Best Sellers
 *
 * Shows top-selling products using WooCommerce's total_sales meta,
 * with fallback to latest products.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$bestseller_args = array(
    'post_type'      => 'product',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'meta_key'       => 'total_sales',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
);
$bestseller_query = new WP_Query( $bestseller_args );

if ( ! $bestseller_query->have_posts() ) {
    $bestseller_query = new WP_Query( array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => 'popularity',
    ) );
}

if ( ! $bestseller_query->have_posts() ) {
    $bestseller_query = new WP_Query( array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
}
?>

<section class="lmw-section lmw-products-section" id="best-sellers">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Customer Favourites', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'Best Sellers', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-products-grid">
            <?php if ( $bestseller_query->have_posts() ) : ?>
                <ul class="products lmw-products-grid__list">
                    <?php while ( $bestseller_query->have_posts() ) : $bestseller_query->the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="lmw-no-products"><?php esc_html_e( 'No best sellers found.', 'lmw-theme' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
