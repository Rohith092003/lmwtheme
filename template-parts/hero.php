<?php
/**
 * Template Part: Hero Banner
 *
 * Ultra-premium luxury sartorial menswear hero section.
 * Designed to build instant trust, highlight craftsmanship, and drive conversion.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-hero" id="hero">
    <div class="lmw-hero__bg-mesh"></div>

    <div class="lmw-container lmw-hero__container">
        <div class="lmw-hero__grid">
            
            <!-- Left: Brand Authority, Headline & Trust Reassurance -->
            <div class="lmw-hero__content">
                
                <!-- Prestige Overline Badge -->
                <div class="lmw-hero__badge">
                    <span class="lmw-hero__badge-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </span>
                    <span class="lmw-hero__badge-text"><?php esc_html_e( 'EST. 2026 • LUXURY SARTORIAL MENSWEAR', 'lmw-theme' ); ?></span>
                </div>

                <!-- Editorial Headline -->
                <h1 class="lmw-hero__title">
                    <?php esc_html_e( 'Crafted for Distinction.', 'lmw-theme' ); ?><br>
                    <span class="lmw-hero__title--accent"><?php esc_html_e( 'Tailored to Perfection.', 'lmw-theme' ); ?></span>
                </h1>

                <!-- Brand Story Copy -->
                <p class="lmw-hero__subtitle">
                    <?php esc_html_e( 'Impeccably tailored from 100% Giza long-staple Egyptian cotton. Designed with Italian structural collars and French seams to deliver unrivaled elegance, breathability, and all-day comfort.', 'lmw-theme' ); ?>
                </p>

                <!-- Primary CTAs -->
                <div class="lmw-hero__actions">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--accent lmw-btn--hero">
                        <span><?php esc_html_e( 'Shop The Collection', 'lmw-theme' ); ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#categories" class="lmw-btn lmw-btn--outline lmw-btn--outline-white lmw-btn--hero">
                        <span><?php esc_html_e( 'Explore Formal Fits', 'lmw-theme' ); ?></span>
                    </a>
                </div>

                <!-- Social Proof & Customer Trust Validation -->
                <div class="lmw-hero__proof">
                    <div class="lmw-hero__proof-stars">
                        <span class="lmw-hero__stars-svg-row">
                            <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                                <svg class="lmw-star-svg" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <?php endfor; ?>
                        </span>
                        <span class="lmw-hero__proof-rating">4.9 / 5</span>
                    </div>
                    <div class="lmw-hero__proof-sep"></div>
                    <div class="lmw-hero__proof-text">
                        <strong>15,000+</strong> <?php esc_html_e( 'Discerning Gentlemen Dressed Across India', 'lmw-theme' ); ?>
                    </div>
                </div>

            </div>

            <!-- Right: Studio Fashion Masterpiece Portrait -->
            <div class="lmw-hero__visual">
                <div class="lmw-hero__portrait-wrapper">
                    
                    <div class="lmw-hero__portrait-frame">
                        <img src="<?php echo esc_url( LMW_THEME_URI . '/assets/images/hero-model.jpg' ); ?>" 
                             alt="<?php esc_attr_e( 'LMW Tailored Luxury Sartorial Shirt', 'lmw-theme' ); ?>" 
                             class="lmw-hero__model-img" 
                             loading="eager" />
                        <div class="lmw-hero__portrait-gradient"></div>
                        
                        <!-- Integrated Editorial Caption Placard -->
                        <div class="lmw-hero__editorial-placard">
                            <span class="lmw-hero__placard-tag"><?php esc_html_e( 'THE SARTORIAL EDIT 2026', 'lmw-theme' ); ?></span>
                            <div class="lmw-hero__placard-title"><?php esc_html_e( 'The Executive Royal Oxford', 'lmw-theme' ); ?></div>
                            <div class="lmw-hero__placard-detail"><?php esc_html_e( '100% Egyptian Giza Cotton • Non-Iron Weave', 'lmw-theme' ); ?></div>
                        </div>
                    </div>

                    <!-- Luxury Seal Badge -->
                    <div class="lmw-hero__prestige-seal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><polyline points="9 12 11 14 15 10"></polyline></svg>
                        <span><?php esc_html_e( 'Master Tailored', 'lmw-theme' ); ?></span>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Integrated High-Trust Reassurance Bar -->
    <div class="lmw-hero__trust-strip">
        <div class="lmw-container">
            <div class="lmw-hero__trust-grid">
                
                <div class="lmw-hero__trust-col">
                    <div class="lmw-hero__trust-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <div class="lmw-hero__trust-info">
                        <h4><?php esc_html_e( 'Free Express Shipping', 'lmw-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Dispatched within 24h & free above ₹999', 'lmw-theme' ); ?></p>
                    </div>
                </div>

                <div class="lmw-hero__trust-col">
                    <div class="lmw-hero__trust-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                    </div>
                    <div class="lmw-hero__trust-info">
                        <h4><?php esc_html_e( '7-Day Easy Exchange', 'lmw-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Complimentary doorstep size replacement', 'lmw-theme' ); ?></p>
                    </div>
                </div>

                <div class="lmw-hero__trust-col">
                    <div class="lmw-hero__trust-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                    <div class="lmw-hero__trust-info">
                        <h4><?php esc_html_e( '100% Egyptian Cotton', 'lmw-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Handpicked long-staple breathable weave', 'lmw-theme' ); ?></p>
                    </div>
                </div>

                <div class="lmw-hero__trust-col">
                    <div class="lmw-hero__trust-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </div>
                    <div class="lmw-hero__trust-info">
                        <h4><?php esc_html_e( '256-Bit Secure Checkout', 'lmw-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Razorpay, UPI, Credit Cards & COD', 'lmw-theme' ); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
