<?php
/**
 * Template Part: Featured Products
 *
 * Displays products tagged as "featured" in WooCommerce,
 * with a fallback to top products if none are tagged.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$featured_args = array(
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'tax_query'      => array(
        array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
        ),
    ),
);
$featured_query = new WP_Query( $featured_args );

// Fallback to latest products if no products are marked 'featured'
if ( ! $featured_query->have_posts() ) {
    $featured_query = new WP_Query( array(
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
}
?>

<section class="lmw-section lmw-products-section" id="featured-products">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Curated for You', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'Featured Products', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-products-grid">
            <?php if ( $featured_query->have_posts() ) : ?>
                <ul class="products lmw-products-grid__list">
                    <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="lmw-no-products"><?php esc_html_e( 'No featured products found.', 'lmw-theme' ); ?></p>
            <?php endif; ?>
        </div>

        <div class="lmw-section__footer">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--outline">
                <?php esc_html_e( 'View All Products', 'lmw-theme' ); ?>
            </a>
        </div>
    </div>
</section>
