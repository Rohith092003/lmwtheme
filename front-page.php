<?php
/**
 * Homepage Template (front-page.php)
 *
 * Modern fashion-focused landing page for LMW Fashion.
 * Uses WooCommerce product queries for dynamic sections.
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main lmw-homepage">

    <?php get_template_part( 'template-parts/hero' ); ?>

    <?php get_template_part( 'template-parts/categories-grid' ); ?>

    <?php get_template_part( 'template-parts/featured-products' ); ?>

    <?php get_template_part( 'template-parts/new-arrivals' ); ?>

    <?php get_template_part( 'template-parts/offers-banner' ); ?>

    <?php get_template_part( 'template-parts/best-sellers' ); ?>

    <?php get_template_part( 'template-parts/testimonials' ); ?>

    <?php get_template_part( 'template-parts/why-choose-us' ); ?>

    <?php get_template_part( 'template-parts/newsletter' ); ?>

</main>

<?php
get_footer();
