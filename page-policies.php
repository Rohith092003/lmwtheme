<?php
/**
 * Template Name: Store Policies
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main lmw-policies-page">
    <div class="lmw-container">
        
        <header class="lmw-page-header">
            <h1 class="lmw-page-title"><?php esc_html_e( 'Customer Support & Store Policies', 'lmw-theme' ); ?></h1>
            <p class="lmw-page-subtitle"><?php esc_html_e( 'Transparency, trust, and our commitment to your shopping satisfaction.', 'lmw-theme' ); ?></p>
        </header>

        <div class="lmw-policies-layout">
            <!-- Sidebar Navigation / Anchor Links -->
            <nav class="lmw-policies-nav" aria-label="<?php esc_attr_e( 'Policies Navigation', 'lmw-theme' ); ?>">
                <a href="#returns-exchanges" class="lmw-policies-nav__link active"><?php esc_html_e( 'Returns & Exchanges', 'lmw-theme' ); ?></a>
                <a href="#shipping-delivery" class="lmw-policies-nav__link"><?php esc_html_e( 'Shipping & Delivery', 'lmw-theme' ); ?></a>
                <a href="#terms-conditions" class="lmw-policies-nav__link"><?php esc_html_e( 'Terms & Conditions', 'lmw-theme' ); ?></a>
                <a href="#privacy-policy" class="lmw-policies-nav__link"><?php esc_html_e( 'Privacy Policy', 'lmw-theme' ); ?></a>
            </nav>

            <!-- Policy Sections Content -->
            <div class="lmw-policies-content">
                
                <!-- 1. Returns & Exchanges -->
                <section id="returns-exchanges" class="lmw-policy-section">
                    <div class="lmw-policy-header">
                        <div class="lmw-policy-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                        </div>
                        <h2><?php esc_html_e( '7-Day Hassle-Free Returns & Size Exchanges', 'lmw-theme' ); ?></h2>
                    </div>

                    <p><?php esc_html_e( 'At LMW, we take immense pride in the craftsmanship of our shirts. If your garment does not fit perfectly or if you change your mind, you can request a replacement size or full refund within 7 days of delivery.', 'lmw-theme' ); ?></p>

                    <h3><?php esc_html_e( 'Eligibility for Return/Exchange:', 'lmw-theme' ); ?></h3>
                    <ul>
                        <li><?php esc_html_e( 'The shirt must be in its original, unworn, and unwashed condition.', 'lmw-theme' ); ?></li>
                        <li><?php esc_html_e( 'All original brand tags, collar supports, and packaging must be intact.', 'lmw-theme' ); ?></li>
                        <li><?php esc_html_e( 'Proof of purchase (invoice or order number) must accompany the request.', 'lmw-theme' ); ?></li>
                    </ul>

                    <h3><?php esc_html_e( 'Exchange Workflow:', 'lmw-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Size exchanges are completely free of charge! Once we receive the returned shirt at our fulfillment center and complete quality inspection, the requested replacement size will be dispatched within 24 to 48 hours.', 'lmw-theme' ); ?></p>
                </section>

                <!-- 2. Shipping & Delivery -->
                <section id="shipping-delivery" class="lmw-policy-section">
                    <div class="lmw-policy-header">
                        <div class="lmw-policy-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                        </div>
                        <h2><?php esc_html_e( 'Shipping & Delivery Guidelines', 'lmw-theme' ); ?></h2>
                    </div>

                    <div class="lmw-highlight-box">
                        <strong><?php esc_html_e( 'Free Express Shipping across India on all prepaid and COD orders above ₹999.', 'lmw-theme' ); ?></strong>
                    </div>

                    <h3><?php esc_html_e( 'Delivery Timelines:', 'lmw-theme' ); ?></h3>
                    <ul>
                        <li><strong><?php esc_html_e( 'Metro Cities:', 'lmw-theme' ); ?></strong> <?php esc_html_e( '2 to 4 business days.', 'lmw-theme' ); ?></li>
                        <li><strong><?php esc_html_e( 'Rest of India:', 'lmw-theme' ); ?></strong> <?php esc_html_e( '4 to 7 business days.', 'lmw-theme' ); ?></li>
                        <li><strong><?php esc_html_e( 'Order Processing:', 'lmw-theme' ); ?></strong> <?php esc_html_e( 'All verified orders are packaged and dispatched within 24 hours from our warehouse.', 'lmw-theme' ); ?></li>
                    </ul>
                </section>

                <!-- 3. Terms & Conditions -->
                <section id="terms-conditions" class="lmw-policy-section">
                    <div class="lmw-policy-header">
                        <div class="lmw-policy-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <h2><?php esc_html_e( 'Terms of Service', 'lmw-theme' ); ?></h2>
                    </div>

                    <p><?php esc_html_e( 'By accessing and ordering from this website, you agree to be bound by these Terms of Service. Prices and availability of shirts are subject to change without prior notice. In the event of a pricing or stock error, LMW reserves the right to cancel the order and provide a full refund.', 'lmw-theme' ); ?></p>
                </section>

                <!-- 4. Privacy Policy -->
                <section id="privacy-policy" class="lmw-policy-section">
                    <div class="lmw-policy-header">
                        <div class="lmw-policy-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <h2><?php esc_html_e( 'Privacy & Data Protection', 'lmw-theme' ); ?></h2>
                    </div>

                    <p><?php esc_html_e( 'Your privacy is paramount. We collect personal information (name, contact number, shipping address, and email) solely to process and fulfill your orders, provide shipment tracking, and deliver customer support. We never sell or distribute customer data to third-party advertisers.', 'lmw-theme' ); ?></p>
                    <p><?php esc_html_e( 'All online payment transactions are processed securely through RBI-compliant, PCI-DSS Level 1 certified payment gateways with 256-bit SSL encryption. LMW does not store your credit card, debit card, or UPI banking credentials on our servers.', 'lmw-theme' ); ?></p>
                </section>

            </div>
        </div>

    </div>
</main>

<?php
get_footer();
