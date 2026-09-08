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

$new_query = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section class="lmw-section lmw-products-section lmw-products-section--alt" id="new-arrivals">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Just In', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'New Arrivals', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-products-grid">
            <?php if ( $new_query->have_posts() ) : ?>
                <ul class="products lmw-products-grid__list">
                    <?php while ( $new_query->have_posts() ) : $new_query->the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="lmw-no-products"><?php esc_html_e( 'No new arrivals found.', 'lmw-theme' ); ?></p>
            <?php endif; ?>
        </div>

        <div class="lmw-section__footer">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) . '?orderby=date' ); ?>" class="lmw-btn lmw-btn--outline">
                <?php esc_html_e( 'See What\'s New', 'lmw-theme' ); ?>
            </a>
        </div>
    </div>
</section>
