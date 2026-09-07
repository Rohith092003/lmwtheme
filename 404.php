<?php
/**
 * 404 error page template
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main">
    <div class="lmw-container">

        <div class="lmw-404">
            <h1 class="lmw-404__title">404</h1>
            <h2 class="lmw-404__subtitle"><?php esc_html_e( 'Page Not Found', 'lmw-theme' ); ?></h2>
            <p class="lmw-404__message">
                <?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'lmw-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lmw-btn lmw-btn--primary">
                <?php esc_html_e( 'Back to Home', 'lmw-theme' ); ?>
            </a>
        </div>

    </div>
</main>

<?php
get_footer();
