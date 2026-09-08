<?php
/**
 * Template Part: Hero Banner
 *
 * Ultra-premium 2-column hero banner featuring studio model photography,
 * trust badges, call to actions, and executive fashion aesthetic.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="lmw-hero" id="hero">
    <div class="lmw-hero__overlay"></div>
    <div class="lmw-hero__glow lmw-hero__glow--1"></div>
    <div class="lmw-hero__glow lmw-hero__glow--2"></div>

    <div class="lmw-container">
        <div class="lmw-hero__grid">
            
            <!-- Left: Hero Text & Value Props -->
            <div class="lmw-hero__content">
                <div class="lmw-hero__badge">
                    <span class="lmw-hero__badge-pulse"></span>
                    <span class="lmw-hero__badge-text"><?php esc_html_e( 'Luxury Collection 2026', 'lmw-theme' ); ?></span>
                </div>

                <h1 class="lmw-hero__title">
                    <?php esc_html_e( 'Elevate Your', 'lmw-theme' ); ?><br>
                    <span class="lmw-hero__title--accent"><?php esc_html_e( 'Everyday Style', 'lmw-theme' ); ?></span>
                </h1>

                <p class="lmw-hero__subtitle">
                    <?php esc_html_e( 'Handcrafted with fine Egyptian cotton and precision tailoring. Experience breathable comfort, wrinkle-resistant luxury, and undeniable executive confidence.', 'lmw-theme' ); ?>
                </p>

                <div class="lmw-hero__actions">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--accent lmw-btn--hero">
                        <span><?php esc_html_e( 'Shop Collection', 'lmw-theme' ); ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#categories" class="lmw-btn lmw-btn--outline lmw-btn--outline-white lmw-btn--hero">
                        <?php esc_html_e( 'Explore Fits', 'lmw-theme' ); ?>
                    </a>
                </div>

                <div class="lmw-hero__stats">
                    <div class="lmw-hero__stat">
                        <span class="lmw-hero__stat-num">10k+</span>
                        <span class="lmw-hero__stat-label"><?php esc_html_e( 'Gentlemen Dressed', 'lmw-theme' ); ?></span>
                    </div>
                    <div class="lmw-hero__stat-divider"></div>
                    <div class="lmw-hero__stat">
                        <span class="lmw-hero__stat-num">100%</span>
                        <span class="lmw-hero__stat-label"><?php esc_html_e( 'Pure Cotton', 'lmw-theme' ); ?></span>
                    </div>
                    <div class="lmw-hero__stat-divider"></div>
                    <div class="lmw-hero__stat">
                        <span class="lmw-hero__stat-num">4.9 ★</span>
                        <span class="lmw-hero__stat-label"><?php esc_html_e( 'Customer Rating', 'lmw-theme' ); ?></span>
                    </div>
                </div>
            </div>

            <!-- Right: Studio Fashion Visual & Floating Badges -->
            <div class="lmw-hero__visual">
                <div class="lmw-hero__image-card">
                    <div class="lmw-hero__image-inner">
                        <img src="<?php echo esc_url( LMW_THEME_URI . '/assets/images/hero-model.jpg' ); ?>" 
                             alt="<?php esc_attr_e( 'LMW Tailored Luxury Shirt Collection', 'lmw-theme' ); ?>" 
                             class="lmw-hero__model-img" 
                             loading="eager" />
                        <div class="lmw-hero__image-overlay"></div>
                    </div>

                    <!-- Floating Badge Top: Royal Fit -->
                    <div class="lmw-hero__floating lmw-hero__floating--top">
                        <div class="lmw-hero__floating-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        </div>
                        <div>
                            <div class="lmw-hero__floating-title"><?php esc_html_e( 'Executive Oxford Fit', 'lmw-theme' ); ?></div>
                            <div class="lmw-hero__floating-sub"><?php esc_html_e( 'Wrinkle-Resistant Cotton', 'lmw-theme' ); ?></div>
                        </div>
                    </div>

                    <!-- Floating Badge Bottom: Social Proof -->
                    <div class="lmw-hero__floating lmw-hero__floating--bottom">
                        <div class="lmw-hero__floating-stars">★★★★★</div>
                        <div class="lmw-hero__floating-title"><?php esc_html_e( '2,450+ Verified Reviews', 'lmw-theme' ); ?></div>
                        <div class="lmw-hero__floating-sub"><?php esc_html_e( 'Voted #1 Best Fit & Comfort', 'lmw-theme' ); ?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
