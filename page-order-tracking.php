<?php
/**
 * Template Name: Order Tracking
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main lmw-tracking-page">
    <div class="lmw-container">
        
        <div class="lmw-tracking-wrapper">
            <header class="lmw-page-header">
                <h1 class="lmw-page-title"><?php esc_html_e( 'Track Your Order', 'lmw-theme' ); ?></h1>
                <p class="lmw-page-subtitle"><?php esc_html_e( 'Enter your Order ID and the billing email address you used during checkout to track your shipment status in real-time.', 'lmw-theme' ); ?></p>
            </header>

            <div class="lmw-tracking-card">
                <?php
                if ( shortcode_exists( 'woocommerce_order_tracking' ) ) {
                    echo do_shortcode( '[woocommerce_order_tracking]' );
                } else {
                    ?>
                    <form action="<?php echo esc_url( get_permalink() ); ?>" method="post" class="woocommerce-form woocommerce-form-track-order track_order">
                        <p class="form-row form-row-first">
                            <label for="orderid"><?php esc_html_e( 'Order ID', 'lmw-theme' ); ?></label>
                            <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php esc_attr_e( 'Found in your order confirmation email', 'lmw-theme' ); ?>" required />
                        </p>
                        <p class="form-row form-row-last">
                            <label for="order_email"><?php esc_html_e( 'Billing email', 'lmw-theme' ); ?></label>
                            <input class="input-text" type="email" name="order_email" id="order_email" placeholder="<?php esc_attr_e( 'Email used during checkout', 'lmw-theme' ); ?>" required />
                        </p>
                        <div class="clear"></div>
                        <p class="form-row">
                            <button type="submit" class="button lmw-btn lmw-btn--primary" name="track" value="<?php esc_attr_e( 'Track', 'lmw-theme' ); ?>"><?php esc_html_e( 'Track Shipment', 'lmw-theme' ); ?></button>
                        </p>
                        <?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>
                    </form>
                    <?php
                }
                ?>
            </div>

            <!-- Customer Service Assistance -->
            <div class="lmw-tracking-help">
                <h3><?php esc_html_e( 'Need assistance with your delivery?', 'lmw-theme' ); ?></h3>
                <p><?php esc_html_e( 'Our customer support team is available Monday to Saturday, 9 AM to 7 PM IST to assist you.', 'lmw-theme' ); ?></p>
                <div class="lmw-tracking-help__links">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="lmw-btn lmw-btn--outline">
                        <?php esc_html_e( 'Contact Support Desk', 'lmw-theme' ); ?>
                    </a>
                </div>
            </div>
        </div>

    </div>
</main>

<?php
get_footer();
