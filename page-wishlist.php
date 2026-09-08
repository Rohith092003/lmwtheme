<?php
/**
 * Template Name: Wishlist
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main lmw-wishlist-page">
    <div class="lmw-container">
        
        <header class="lmw-page-header">
            <h1 class="lmw-page-title"><?php esc_html_e( 'My Wishlist', 'lmw-theme' ); ?></h1>
            <p class="lmw-page-subtitle"><?php esc_html_e( 'Your favorite handpicked shirts saved for later', 'lmw-theme' ); ?></p>
        </header>

        <!-- Wishlist Container (Populated via JS from localStorage) -->
        <div id="lmw-wishlist-container" class="lmw-wishlist-content">
            
            <div id="lmw-wishlist-empty" class="lmw-empty-state" style="display: none;">
                <div class="lmw-empty-state__icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <h2 class="lmw-empty-state__title"><?php esc_html_e( 'Your Wishlist is Empty', 'lmw-theme' ); ?></h2>
                <p class="lmw-empty-state__desc"><?php esc_html_e( 'Explore our catalog and click the heart icon on any shirt to save it to your wishlist.', 'lmw-theme' ); ?></p>
                <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="lmw-btn lmw-btn--primary">
                    <?php esc_html_e( 'Browse Shirts Collection', 'lmw-theme' ); ?>
                </a>
            </div>

            <div id="lmw-wishlist-grid" class="lmw-wishlist-grid" style="display: none;">
                <!-- Dynamically rendered items -->
            </div>

        </div>

    </div>
</main>

<?php
get_footer();
