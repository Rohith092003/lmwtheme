<?php
/**
 * Checkout Form
 *
 * Override of templates/checkout/form-checkout.php
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'lmw-theme' ) ) );
    return;
}
?>

<div class="lmw-checkout-page">
    <h1 class="lmw-checkout-page__title"><?php esc_html_e( 'Checkout', 'lmw-theme' ); ?></h1>

    <form name="checkout" method="post" class="checkout woocommerce-checkout lmw-checkout-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <div class="lmw-checkout-layout">
            <!-- Left Column: Customer & Delivery Details -->
            <div class="lmw-checkout-layout__fields">
                <?php if ( $checkout->get_checkout_fields() ) : ?>

                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <div class="col2-set" id="customer_details">
                        <div class="col-1 lmw-checkout-billing">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>

                        <div class="col-2 lmw-checkout-shipping">
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>
            </div>

            <!-- Right Column: Order Review, Trust Badges, Payment -->
            <div class="lmw-checkout-layout__order-review">
                <div class="lmw-checkout-review-card">
                    <h3 id="order_review_heading" class="lmw-checkout-review-title"><?php esc_html_e( 'Your Order Summary', 'lmw-theme' ); ?></h3>

                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

                    <!-- Trust assurance badges -->
                    <div class="lmw-checkout-trust">
                        <div class="lmw-checkout-trust__item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            <span><?php esc_html_e( '256-Bit SSL Bank Grade Encryption', 'lmw-theme' ); ?></span>
                        </div>
                        <div class="lmw-checkout-trust__item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                            <span><?php esc_html_e( '7-Day Easy Return & Replacement Guarantee', 'lmw-theme' ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
