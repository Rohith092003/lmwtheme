<?php
/**
 * Template Part: Shop by Category
 *
 * Displays product categories in a grid.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'parent'     => 0,
    'exclude'    => array( get_option( 'default_product_cat' ) ),
    'number'     => 6,
    'orderby'    => 'count',
    'order'      => 'DESC',
) );

if ( empty( $categories ) || is_wp_error( $categories ) ) {
    return;
}
?>

<section class="lmw-section lmw-categories" id="categories">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Collections', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'Shop by Category', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-categories__grid">
            <?php foreach ( $categories as $cat ) :
                $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image_url    = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'lmw-product-card' ) : '';
                $link         = get_term_link( $cat );
            ?>
                <a href="<?php echo esc_url( $link ); ?>" class="lmw-categories__card">
                    <div class="lmw-categories__image">
                        <?php if ( $image_url ) : ?>
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>" loading="lazy">
                        <?php else : ?>
                            <div class="lmw-categories__placeholder">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="lmw-categories__info">
                        <h3 class="lmw-categories__name"><?php echo esc_html( $cat->name ); ?></h3>
                        <span class="lmw-categories__count">
                            <?php
                            printf(
                                /* translators: %d: number of products */
                                esc_html( _n( '%d Product', '%d Products', $cat->count, 'lmw-theme' ) ),
                                $cat->count
                            );
                            ?>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
