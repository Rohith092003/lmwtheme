<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override of templates/content-single-product.php
 *
 * @package LMW_Theme
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_id    = $product->get_id();
$brand         = get_post_meta( $product_id, '_lmw_brand', true );
$regular_price = $product->get_regular_price();
$sale_price    = $product->get_sale_price();
$mrp           = get_post_meta( $product_id, '_lmw_mrp', true );

// If MRP not set on parent, use regular price as reference
if ( empty( $mrp ) && ! empty( $regular_price ) ) {
    $mrp = $regular_price;
}

$savings = 0;
$savings_pct = 0;
$current_price = $product->get_price();

if ( ! empty( $mrp ) && (float) $mrp > (float) $current_price ) {
    $savings     = (float) $mrp - (float) $current_price;
    $savings_pct = round( ( $savings / (float) $mrp ) * 100 );
}

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'lmw-single-product', $product ); ?>>

    <div class="lmw-single-product__layout">
        
        <!-- Left: Product Images & Gallery -->
        <div class="lmw-single-product__gallery">
            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action( 'woocommerce_before_single_product_summary' );
            ?>
        </div>

        <!-- Right: Product Summary & Purchasing -->
        <div class="summary entry-summary lmw-single-product__summary">
            
            <?php if ( ! empty( $brand ) ) : ?>
                <div class="lmw-single-product__brand"><?php echo esc_html( $brand ); ?></div>
            <?php endif; ?>

            <h1 class="product_title entry-title lmw-single-product__title"><?php the_title(); ?></h1>

            <div class="lmw-single-product__meta-top">
                <div class="lmw-single-product__rating">
                    <?php if ( wc_review_ratings_enabled() && ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) ) : ?>
                        <?php echo $rating_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <span class="lmw-single-product__rating-count">
                            <?php printf( esc_html( _n( '%s Customer Review', '%s Customer Reviews', $product->get_review_count(), 'lmw-theme' ) ), esc_html( $product->get_review_count() ) ); ?>
                        </span>
                    <?php else : ?>
                        <span class="lmw-stars-row" aria-label="Rated 4.9 out of 5">
                            <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                                <svg class="lmw-star-svg" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <?php endfor; ?>
                        </span>
                        <span class="lmw-single-product__rating-count">4.9 (148 Customer Reviews)</span>
                    <?php endif; ?>
                </div>

                <div class="lmw-single-product__stock-badge">
                    <?php if ( $product->is_in_stock() ) : ?>
                        <span class="lmw-stock-tag lmw-stock-tag--in-stock">
                            <span class="lmw-dot"></span> <?php esc_html_e( 'In Stock — Ready to Dispatch', 'lmw-theme' ); ?>
                        </span>
                    <?php else : ?>
                        <span class="lmw-stock-tag lmw-stock-tag--out-of-stock">
                            <?php esc_html_e( 'Out of Stock', 'lmw-theme' ); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="lmw-single-product__price-box">
                <div class="lmw-single-product__price">
                    <?php woocommerce_template_single_price(); ?>
                </div>
                
                <?php if ( $savings > 0 ) : ?>
                    <div class="lmw-single-product__savings">
                        <span class="lmw-save-badge"><?php printf( esc_html__( 'SAVE %d%%', 'lmw-theme' ), $savings_pct ); ?></span>
                        <span class="lmw-save-amount"><?php printf( esc_html__( 'You save ₹%s', 'lmw-theme' ), wc_format_decimal( $savings, 0 ) ); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="lmw-single-product__short-desc">
                <?php woocommerce_template_single_excerpt(); ?>
            </div>

            <!-- Size Guide Trigger -->
            <div class="lmw-single-product__size-guide-trigger">
                <button type="button" class="lmw-size-guide-btn js-open-size-guide" aria-haspopup="dialog">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.3 8.7 8.7 21.3c-1 1-2.5 1-3.4 0l-2.6-2.6c-1-1-1-2.5 0-3.4L15.3 2.7c1-1 2.5-1 3.4 0l2.6 2.6c1 1 1 2.5 0 3.4Z"></path>
                        <path d="m14.5 3.5 2 2"></path>
                        <path d="m11.5 6.5 2 2"></path>
                        <path d="m8.5 9.5 2 2"></path>
                        <path d="m5.5 12.5 2 2"></path>
                    </svg>
                    <span><?php esc_html_e( 'Size Guide & Fit Chart', 'lmw-theme' ); ?></span>
                </button>
            </div>

            <!-- Add to Cart & Variations -->
            <div class="lmw-single-product__cart-form">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>

            <!-- Wishlist & SKU Details -->
            <div class="lmw-single-product__secondary-actions">
                <button type="button" 
                        class="lmw-btn-wishlist-inline js-wishlist-toggle"
                        data-id="<?php echo esc_attr( $product_id ); ?>"
                        data-title="<?php echo esc_attr( $product->get_name() ); ?>"
                        data-price="<?php echo esc_attr( wp_strip_all_tags( wc_price( $product->get_price() ) ) ); ?>"
                        data-image="<?php echo esc_url( wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_thumbnail' ) ?: wc_placeholder_img_src( 'woocommerce_thumbnail' ) ); ?>"
                        data-url="<?php echo esc_url( get_permalink() ); ?>">
                    <svg class="lmw-icon-heart" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span><?php esc_html_e( 'Add to Wishlist', 'lmw-theme' ); ?></span>
                </button>
            </div>

            <!-- Trust Badges -->
            <div class="lmw-single-product__trust-badges">
                <div class="lmw-trust-badge-item">
                    <div class="lmw-trust-badge-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <div class="lmw-trust-badge-content">
                        <strong><?php esc_html_e( 'Free Express Delivery', 'lmw-theme' ); ?></strong>
                        <p><?php esc_html_e( 'Complimentary shipping across India on orders above ₹999', 'lmw-theme' ); ?></p>
                    </div>
                </div>
                <div class="lmw-trust-badge-item">
                    <div class="lmw-trust-badge-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                    </div>
                    <div class="lmw-trust-badge-content">
                        <strong><?php esc_html_e( '7-Day Easy Returns & Exchange', 'lmw-theme' ); ?></strong>
                        <p><?php esc_html_e( 'Doorstep reverse pickup & instant size replacement', 'lmw-theme' ); ?></p>
                    </div>
                </div>
                <div class="lmw-trust-badge-item">
                    <div class="lmw-trust-badge-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <div class="lmw-trust-badge-content">
                        <strong><?php esc_html_e( '100% Genuine Egyptian Cotton', 'lmw-theme' ); ?></strong>
                        <p><?php esc_html_e( 'Ultra-fine long-staple breathable weave guaranteed', 'lmw-theme' ); ?></p>
                    </div>
                </div>
            </div>

            <!-- Meta: SKU, Category -->
            <div class="lmw-single-product__meta-footer">
                <?php woocommerce_template_single_meta(); ?>
            </div>

        </div>
    </div>

    <!-- Product Tabs & Info -->
    <div class="lmw-single-product__tabs-section">
        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>

</div>

<!-- Size Guide Modal -->
<div id="lmw-size-guide-modal" class="lmw-modal" role="dialog" aria-modal="true" aria-labelledby="lmw-size-guide-title" style="display: none;">
    <div class="lmw-modal__backdrop js-close-size-guide"></div>
    <div class="lmw-modal__dialog">
        <div class="lmw-modal__header">
            <h3 id="lmw-size-guide-title" class="lmw-modal__title"><?php esc_html_e( 'Men\'s Shirt Size Guide (Inches)', 'lmw-theme' ); ?></h3>
            <button type="button" class="lmw-modal__close js-close-size-guide" aria-label="<?php esc_attr_e( 'Close', 'lmw-theme' ); ?>">&times;</button>
        </div>
        <div class="lmw-modal__body">
            <p class="lmw-modal__desc"><?php esc_html_e( 'Measure around the fullest part of your chest, keeping the tape horizontal. All measurements are in inches.', 'lmw-theme' ); ?></p>
            <div class="lmw-table-responsive">
                <table class="lmw-size-table">
                    <thead>
                        <tr>
                            <th><?php esc_html_e( 'Size', 'lmw-theme' ); ?></th>
                            <th><?php esc_html_e( 'Chest (in)', 'lmw-theme' ); ?></th>
                            <th><?php esc_html_e( 'Length (in)', 'lmw-theme' ); ?></th>
                            <th><?php esc_html_e( 'Shoulder (in)', 'lmw-theme' ); ?></th>
                            <th><?php esc_html_e( 'Sleeve (in)', 'lmw-theme' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>S (38)</strong></td>
                            <td>38 - 39</td>
                            <td>28.5</td>
                            <td>17.5</td>
                            <td>24.5</td>
                        </tr>
                        <tr>
                            <td><strong>M (40)</strong></td>
                            <td>40 - 41</td>
                            <td>29.5</td>
                            <td>18.5</td>
                            <td>25.0</td>
                        </tr>
                        <tr>
                            <td><strong>L (42)</strong></td>
                            <td>42 - 43</td>
                            <td>30.5</td>
                            <td>19.5</td>
                            <td>25.5</td>
                        </tr>
                        <tr>
                            <td><strong>XL (44)</strong></td>
                            <td>44 - 45</td>
                            <td>31.5</td>
                            <td>20.5</td>
                            <td>26.0</td>
                        </tr>
                        <tr>
                            <td><strong>XXL (46)</strong></td>
                            <td>46 - 48</td>
                            <td>32.5</td>
                            <td>21.5</td>
                            <td>26.5</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="lmw-size-guide__tip">
                <strong><?php esc_html_e( 'Fitting Tip:', 'lmw-theme' ); ?></strong>
                <span><?php esc_html_e( 'For a relaxed casual look or muscular build, we recommend choosing one size larger.', 'lmw-theme' ); ?></span>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
