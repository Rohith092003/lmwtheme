<?php
/**
 * The Template for displaying product archives, including the main shop page
 * which is a post type archive.
 *
 * Override of templates/archive-product.php
 *
 * @package LMW_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs lmw-main wrapper)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );
?>

<header class="woocommerce-products-header lmw-archive-header">
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <h1 class="woocommerce-products-header__title page-title lmw-archive-title"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php
    /**
     * Hook: woocommerce_archive_description.
     *
     * @hooked woocommerce_taxonomy_archive_description - 10
     * @hooked woocommerce_product_archive_description - 10
     */
    do_action( 'woocommerce_archive_description' );
    ?>
</header>

<!-- Mobile Filter Sticky Action Bar (Flipkart Style) -->
<div class="lmw-shop-mobile-bar">
    <button type="button" id="lmw-mobile-filter-trigger" class="lmw-mobile-bar-btn lmw-mobile-bar-btn--filter">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
        <span><?php esc_html_e( 'Filter', 'lmw-theme' ); ?></span>
        <span id="lmw-mobile-filter-badge" class="lmw-mobile-badge" style="display:none;">0</span>
    </button>
    <div class="lmw-mobile-bar-divider"></div>
    <div class="lmw-mobile-bar-btn lmw-mobile-bar-btn--sort">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
        <span><?php esc_html_e( 'Sort', 'lmw-theme' ); ?></span>
    </div>
</div>

<div class="lmw-shop-layout">

    <!-- Faceted Filter Sidebar -->
    <?php get_template_part( 'template-parts/shop-filter-sidebar' ); ?>

    <!-- Main Products Area -->
    <div class="lmw-shop-main" id="lmw-shop-products-container">

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="lmw-shop-toolbar">
                <button type="button" id="lmw-desktop-filter-toggle" class="lmw-desktop-filter-toggle">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    <span><?php esc_html_e( 'Filters', 'lmw-theme' ); ?></span>
                </button>
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 */
                do_action( 'woocommerce_before_shop_loop' );
                ?>
            </div>

            <!-- Product Grid -->
            <div id="lmw-shop-products-grid" class="lmw-shop-products-grid">
                <?php
                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();

                        do_action( 'woocommerce_shop_loop' );

                        wc_get_template_part( 'content', 'product' );
                    }
                }

                woocommerce_product_loop_end();
                ?>
            </div>

            <!-- Pagination -->
            <div class="lmw-shop-pagination" id="lmw-shop-pagination">
                <?php do_action( 'woocommerce_after_shop_loop' ); ?>
            </div>

        <?php else : ?>

            <div class="lmw-no-products-wrapper">
                <div class="lmw-no-products-card">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                    <h2><?php esc_html_e( 'No matching shirts found', 'lmw-theme' ); ?></h2>
                    <p><?php esc_html_e( 'Try clearing some of your filters or searching for different sizes and colors.', 'lmw-theme' ); ?></p>
                    <button type="button" class="lmw-btn lmw-btn--primary lmw-reset-filters-btn">
                        <?php esc_html_e( 'Clear All Filters', 'lmw-theme' ); ?>
                    </button>
                </div>
            </div>

        <?php endif; ?>

    </div>

</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (closes lmw-main wrapper)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
