<?php
/**
 * Empty cart page
 *
 * Override of templates/cart/cart-empty.php
 *
 * @package LMW_Theme
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>
<div class="lmw-empty-cart">
    <div class="lmw-empty-cart__icon">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
    </div>
    
    <h2 class="lmw-empty-cart__title"><?php esc_html_e( 'Your Shopping Bag is Empty', 'lmw-theme' ); ?></h2>
    <p class="lmw-empty-cart__text"><?php esc_html_e( 'Looks like you haven\'t added any items to your bag yet. Explore our latest arrivals to find your perfect fit.', 'lmw-theme' ); ?></p>
    
    <?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
        <p class="return-to-shop">
            <a class="button wc-backward lmw-btn lmw-btn--primary" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                <?php esc_html_e( 'Explore Collection', 'lmw-theme' ); ?>
            </a>
        </p>
    <?php endif; ?>
</div>
