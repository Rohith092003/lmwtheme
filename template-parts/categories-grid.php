<?php
/**
 * Template Part: Shop by Category
 *
 * Displays product categories in an ultra-premium grid with AI studio photography fallbacks.
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
            <span class="lmw-section__label"><?php esc_html_e( 'Curated Collections', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'Shop by Category', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-categories__grid">
            <?php 
            $cat_fallbacks = array(
                'formal-shirts' => LMW_THEME_URI . '/assets/images/shirt-1.jpg',
                'casual-shirts' => LMW_THEME_URI . '/assets/images/shirt-2.jpg',
                'printed-shirts'=> LMW_THEME_URI . '/assets/images/shirt-3.jpg',
                'party-wear'    => LMW_THEME_URI . '/assets/images/shirt-4.jpg',
                't-shirts'      => LMW_THEME_URI . '/assets/images/shirt-5.jpg',
            );
            $cat_idx = 1;

            foreach ( $categories as $cat ) :
                $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image_url    = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'lmw-product-card' ) : '';
                
                // If empty or placeholder or broken, use AI studio images
                if ( empty( $image_url ) || strpos( $image_url, 'placeholder' ) !== false ) {
                    $slug = $cat->slug;
                    if ( isset( $cat_fallbacks[ $slug ] ) ) {
                        $image_url = $cat_fallbacks[ $slug ];
                    } elseif ( $cat_idx === 5 ) {
                        $image_url = LMW_THEME_URI . '/assets/images/cat-5.jpg';
                    } else {
                        $fallback_num = ( ( $cat_idx - 1 ) % 6 ) + 1;
                        $image_url = LMW_THEME_URI . '/assets/images/shirt-' . $fallback_num . '.jpg';
                    }
                }
                $link = get_term_link( $cat );
                $card_fallback = LMW_THEME_URI . '/assets/images/cat-5.jpg';
                $cat_idx++;
            ?>
                <a href="<?php echo esc_url( $link ); ?>" class="lmw-categories__card">
                    <div class="lmw-categories__image">
                        <img src="<?php echo esc_url( $image_url ); ?>" 
                             alt="<?php echo esc_attr( $cat->name ); ?>" 
                             loading="lazy"
                             onerror="this.onerror=null;this.src='<?php echo esc_url( $card_fallback ); ?>';">
                        <div class="lmw-categories__badge">
                            <?php
                            printf(
                                /* translators: %d: number of products */
                                esc_html( _n( '%d Item', '%d Items', $cat->count, 'lmw-theme' ) ),
                                $cat->count
                            );
                            ?>
                        </div>
                    </div>
                    <div class="lmw-categories__info">
                        <h3 class="lmw-categories__name"><?php echo esc_html( $cat->name ); ?></h3>
                        <span class="lmw-categories__explore-link">
                            <span><?php esc_html_e( 'Explore Collection', 'lmw-theme' ); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
