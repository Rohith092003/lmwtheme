<?php
/**
 * Thankyou page
 *
 * Override of templates/checkout/thankyou.php
 *
 * @package LMW_Theme
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order lmw-thankyou-page">

    <?php
    if ( $order ) :

        do_action( 'woocommerce_before_thankyou', $order->get_id() );
        ?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <div class="lmw-order-status-card lmw-order-status-card--failed">
                <div class="lmw-order-status-card__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                </div>
                <h1 class="lmw-order-status-card__title"><?php esc_html_e( 'Order Payment Failed', 'lmw-theme' ); ?></h1>
                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'lmw-theme' ); ?></p>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay lmw-btn lmw-btn--primary"><?php esc_html_e( 'Pay Now', 'lmw-theme' ); ?></a>
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay lmw-btn lmw-btn--outline"><?php esc_html_e( 'My Account', 'lmw-theme' ); ?></a>
                    <?php endif; ?>
                </p>
            </div>

        <?php else : ?>

            <div class="lmw-order-status-card lmw-order-status-card--success">
                <div class="lmw-order-status-card__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <h1 class="lmw-order-status-card__title"><?php esc_html_e( 'Order Confirmed!', 'lmw-theme' ); ?></h1>
                <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received lmw-order-status-card__desc">
                    <?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you for shopping with LMW. Your order has been placed successfully and we are preparing it for shipment.', 'lmw-theme' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </p>
            </div>

            <!-- Order Key Details Grid -->
            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details lmw-order-summary-grid">
                <li class="woocommerce-order-overview__order order">
                    <span class="lmw-label"><?php esc_html_e( 'Order Number:', 'lmw-theme' ); ?></span>
                    <strong>#<?php echo esc_html( $order->get_order_number() ); ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    <span class="lmw-label"><?php esc_html_e( 'Date Placed:', 'lmw-theme' ); ?></span>
                    <strong><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong>
                </li>

                <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                    <li class="woocommerce-order-overview__email email">
                        <span class="lmw-label"><?php esc_html_e( 'Email:', 'lmw-theme' ); ?></span>
                        <strong><?php echo esc_html( $order->get_billing_email() ); ?></strong>
                    </li>
                <?php endif; ?>

                <li class="woocommerce-order-overview__total total">
                    <span class="lmw-label"><?php esc_html_e( 'Total Amount:', 'lmw-theme' ); ?></span>
                    <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>

                <?php if ( $order->get_payment_method_title() ) : ?>
                    <li class="woocommerce-order-overview__payment-method method">
                        <span class="lmw-label"><?php esc_html_e( 'Payment Method:', 'lmw-theme' ); ?></span>
                        <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="lmw-order-actions-bar">
                <button type="button" class="lmw-btn lmw-btn--outline" onclick="window.print();">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    <span><?php esc_html_e( 'Print Order Receipt', 'lmw-theme' ); ?></span>
                </button>
                <a href="<?php echo esc_url( home_url( '/order-tracking/' ) ); ?>" class="lmw-btn lmw-btn--secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
                    <span><?php esc_html_e( 'Track Order Status', 'lmw-theme' ); ?></span>
                </a>
            </div>

        <?php endif; ?>

        <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
        <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

    <?php else : ?>

        <div class="lmw-order-status-card lmw-order-status-card--success">
            <h1 class="lmw-order-status-card__title"><?php esc_html_e( 'Order Received', 'lmw-theme' ); ?></h1>
            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'lmw-theme' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        </div>

    <?php endif; ?>

</div>
