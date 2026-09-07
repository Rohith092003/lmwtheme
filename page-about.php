<?php
/**
 * Template Name: About Us
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main">

    <!-- Page Banner -->
    <section class="lmw-page-banner">
        <div class="lmw-container">
            <h1 class="lmw-page-banner__title"><?php the_title(); ?></h1>
        </div>
    </section>

    <!-- Story -->
    <section class="lmw-section lmw-about-story">
        <div class="lmw-container">
            <div class="lmw-about-story__grid">
                <div class="lmw-about-story__content">
                    <span class="lmw-section__label"><?php esc_html_e( 'Our Story', 'lmw-theme' ); ?></span>
                    <h2 class="lmw-section__title"><?php esc_html_e( 'Crafting Confidence, One Shirt at a Time', 'lmw-theme' ); ?></h2>
                    <p><?php esc_html_e( 'LMW Fashion was born from a simple belief: every man deserves to look and feel his best without breaking the bank. We started as a small retail store with a passion for quality shirts and have grown into a trusted brand known for premium fabrics, modern fits, and honest pricing.', 'lmw-theme' ); ?></p>
                    <p><?php esc_html_e( 'Our team works directly with mills and manufacturers to source the finest cotton, linen, and blended fabrics. Every shirt goes through rigorous quality checks before reaching you — whether you shop online or visit us in-store.', 'lmw-theme' ); ?></p>
                </div>
                <div class="lmw-about-story__image">
                    <div class="lmw-about-story__placeholder">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="lmw-section lmw-about-values" style="background-color: var(--lmw-off-white);">
        <div class="lmw-container">
            <div class="lmw-section__header">
                <span class="lmw-section__label"><?php esc_html_e( 'What Drives Us', 'lmw-theme' ); ?></span>
                <h2 class="lmw-section__title"><?php esc_html_e( 'Our Values', 'lmw-theme' ); ?></h2>
            </div>
            <div class="lmw-about-values__grid">
                <div class="lmw-about-values__card">
                    <h3><?php esc_html_e( 'Quality First', 'lmw-theme' ); ?></h3>
                    <p><?php esc_html_e( 'We never compromise on fabric quality, stitching, or finishing. Each product is made to last.', 'lmw-theme' ); ?></p>
                </div>
                <div class="lmw-about-values__card">
                    <h3><?php esc_html_e( 'Honest Pricing', 'lmw-theme' ); ?></h3>
                    <p><?php esc_html_e( 'No inflated MRPs, no fake discounts. Just fair prices for premium products.', 'lmw-theme' ); ?></p>
                </div>
                <div class="lmw-about-values__card">
                    <h3><?php esc_html_e( 'Customer Care', 'lmw-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Your satisfaction matters most. Easy returns, responsive support, and genuine care.', 'lmw-theme' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="lmw-section" style="text-align:center;">
        <div class="lmw-container">
            <h2><?php esc_html_e( 'Experience the LMW Difference', 'lmw-theme' ); ?></h2>
            <p style="color:var(--lmw-mid-grey);margin:1rem 0 2rem;max-width:480px;margin-left:auto;margin-right:auto;">
                <?php esc_html_e( 'Browse our latest collection and see why thousands of customers trust LMW Fashion.', 'lmw-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lmw-btn lmw-btn--primary">
                <?php esc_html_e( 'Shop Now', 'lmw-theme' ); ?>
            </a>
        </div>
    </section>

</main>

<?php
get_footer();
