<?php
/**
 * The template for displaying product content within loops
 *
 * Override of templates/content-product.php
 *
 * @package LMW_Theme
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$product_id    = $product->get_id();
$brand         = get_post_meta( $product_id, '_lmw_brand', true );
$regular_price = $product->get_regular_price();
$sale_price    = $product->get_sale_price();
$discount_pct  = 0;

if ( $product->is_on_sale() && ! empty( $regular_price ) && ! empty( $sale_price ) && (float) $regular_price > 0 ) {
    $discount_pct = round( ( ( (float) $regular_price - (float) $sale_price ) / (float) $regular_price ) * 100 );
}

// Check if new arrival (published in last 30 days)
$is_new = ( time() - get_post_time( 'U', false, $product_id ) ) < ( 30 * DAY_IN_SECONDS );

// Available sizes for variable products
$sizes_list = '';
if ( $product->is_type( 'variable' ) ) {
    $attributes = $product->get_variation_attributes();
    if ( isset( $attributes['pa_size'] ) ) {
        $sizes_list = implode( ', ', array_slice( $attributes['pa_size'], 0, 4 ) );
    } elseif ( isset( $attributes['size'] ) ) {
        $sizes_list = implode( ', ', array_slice( $attributes['size'], 0, 4 ) );
    }
}

// Smart AI Fashion fallback image
$dummy_idx = ( $product_id % 6 ) + 1;
$fallback_img = LMW_THEME_URI . '/assets/images/shirt-' . $dummy_idx . '.jpg';

$card_image_url = '';
if ( has_post_thumbnail( $product_id ) ) {
    $thumb_url = wp_get_attachment_image_url( get_post_thumbnail_id( $product_id ), 'woocommerce_thumbnail' );
    if ( ! empty( $thumb_url ) && strpos( $thumb_url, 'placeholder' ) === false ) {
        $card_image_url = $thumb_url;
    }
}
if ( empty( $card_image_url ) ) {
    $card_image_url = $fallback_img;
}
?>
<li <?php wc_product_class( 'lmw-product-card', $product ); ?> data-product-id="<?php echo esc_attr( $product_id ); ?>">
    
    <div class="lmw-product-card__media">
        <!-- Badges -->
        <div class="lmw-product-card__badges">
            <?php if ( $discount_pct > 0 ) : ?>
                <span class="lmw-badge lmw-badge--sale"><?php printf( esc_html__( '%d%% OFF', 'lmw-theme' ), $discount_pct ); ?></span>
            <?php elseif ( $product->is_on_sale() ) : ?>
                <span class="lmw-badge lmw-badge--sale"><?php esc_html_e( 'Sale', 'lmw-theme' ); ?></span>
            <?php endif; ?>

            <?php if ( $is_new ) : ?>
                <span class="lmw-badge lmw-badge--new"><?php esc_html_e( 'New', 'lmw-theme' ); ?></span>
            <?php endif; ?>
        </div>

        <!-- Wishlist Toggle -->
        <button type="button" 
                class="lmw-product-card__wishlist-btn js-wishlist-toggle" 
                aria-label="<?php esc_attr_e( 'Add to wishlist', 'lmw-theme' ); ?>"
                data-id="<?php echo esc_attr( $product_id ); ?>"
                data-title="<?php echo esc_attr( $product->get_name() ); ?>"
                data-price="<?php echo esc_attr( strip_tags( $product->get_price_html() ) ); ?>"
                data-image="<?php echo esc_url( $card_image_url ); ?>"
                data-url="<?php echo esc_url( get_permalink() ); ?>">
            <svg class="lmw-icon-heart" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </button>

        <!-- Product Link & Image -->
        <a href="<?php the_permalink(); ?>" class="lmw-product-card__link">
            <img src="<?php echo esc_url( $card_image_url ); ?>" 
                 alt="<?php echo esc_attr( get_the_title() ); ?>" 
                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lmw-product-card__img" 
                 loading="lazy" 
                 onerror="this.onerror=null;this.src='<?php echo esc_url( $fallback_img ); ?>';" />
        </a>
        
        <?php if ( ! empty( $sizes_list ) ) : ?>
            <div class="lmw-product-card__sizes-preview">
                <span><?php esc_html_e( 'Sizes:', 'lmw-theme' ); ?> <?php echo esc_html( $sizes_list ); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="lmw-product-card__content">
        <?php if ( ! empty( $brand ) ) : ?>
            <div class="lmw-product-card__brand"><?php echo esc_html( $brand ); ?></div>
        <?php else : ?>
            <div class="lmw-product-card__brand"><?php esc_html_e( 'LMW Signature', 'lmw-theme' ); ?></div>
        <?php endif; ?>

        <h2 class="woocommerce-loop-product__title lmw-product-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <?php if ( wc_review_ratings_enabled() && ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) ) : ?>
            <div class="lmw-product-card__rating">
                <?php echo $rating_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <span class="lmw-product-card__review-count">(<?php echo esc_html( $product->get_review_count() ); ?>)</span>
            </div>
        <?php else : ?>
            <div class="lmw-product-card__rating">
                <span class="lmw-stars">★★★★★</span>
                <span class="lmw-product-card__review-count">(4.9)</span>
            </div>
        <?php endif; ?>

        <div class="lmw-product-card__price">
            <?php woocommerce_template_loop_price(); ?>
        </div>

        <div class="lmw-product-card__actions">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    </div>

</li>
