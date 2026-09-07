<?php
/**
 * The sidebar template
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="lmw-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'lmw-theme' ); ?>">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
