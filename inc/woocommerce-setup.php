<?php
/**
 * WooCommerce Setup — Theme integration with WooCommerce
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Declare WooCommerce support.
 */
function lmw_theme_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 4,
            'min_rows'        => 1,
            'default_columns' => 4,
            'min_columns'     => 1,
            'max_columns'     => 6,
        ),
    ) );

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'lmw_theme_woocommerce_support' );

/**
 * Enqueue WooCommerce-specific styles.
 */
function lmw_theme_woocommerce_styles() {
    wp_enqueue_style(
        'lmw-woocommerce-css',
        LMW_THEME_URI . '/assets/css/shop.css',
        array( 'lmw-theme-style' ),
        LMW_THEME_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'lmw_theme_woocommerce_styles' );

/**
 * Disable default WooCommerce styles that we override.
 */
function lmw_theme_dequeue_wc_styles( $enqueue_styles ) {
    // Remove WooCommerce float-based layouts and smallscreen CSS;
    // our theme provides full modern flexbox & grid responsive styling.
    unset( $enqueue_styles['woocommerce-smallscreen'] );
    unset( $enqueue_styles['woocommerce-layout'] );
    return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'lmw_theme_dequeue_wc_styles' );

/**
 * Filter default WooCommerce placeholder image to use our high-res AI studio shirt image.
 */
function lmw_theme_wc_placeholder_img_src( $src ) {
    return LMW_THEME_URI . '/assets/images/shirt-1.jpg';
}
add_filter( 'woocommerce_placeholder_img_src', 'lmw_theme_wc_placeholder_img_src' );

/**
 * Change number of products per row.
 */
function lmw_theme_wc_products_per_row() {
    return 4;
}
add_filter( 'loop_shop_columns', 'lmw_theme_wc_products_per_row' );

/**
 * Change number of products displayed per page.
 */
function lmw_theme_wc_products_per_page() {
    return 16;
}
add_filter( 'loop_shop_per_page', 'lmw_theme_wc_products_per_page' );

/**
 * WooCommerce content wrappers matching our theme markup.
 */
function lmw_theme_wc_wrapper_before() {
    echo '<main id="main-content" class="lmw-main"><div class="lmw-container">';
}

function lmw_theme_wc_wrapper_after() {
    echo '</div></main>';
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'lmw_theme_wc_wrapper_before' );
add_action( 'woocommerce_after_main_content', 'lmw_theme_wc_wrapper_after' );

/**
 * WooCommerce breadcrumb defaults.
 */
function lmw_theme_wc_breadcrumb_defaults( $defaults ) {
    $defaults['delimiter']   = ' <span class="lmw-breadcrumb-sep">/</span> ';
    $defaults['wrap_before'] = '<nav class="lmw-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'lmw-theme' ) . '"><div class="lmw-container">';
    $defaults['wrap_after']  = '</div></nav>';
    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'lmw_theme_wc_breadcrumb_defaults' );

/**
 * Enable customer registration on the My Account page.
 */
add_filter( 'pre_option_woocommerce_enable_myaccount_registration', function() {
    return 'yes';
} );

/**
 * Allow customers to create their own password during registration.
 */
add_filter( 'pre_option_woocommerce_registration_generate_password', function() {
    return 'no';
} );

/**
 * Ensure WooCommerce loads theme template overrides directly from theme's woocommerce/ directory.
 */
function lmw_theme_wc_locate_template( $template, $template_name, $template_path ) {
    $candidates = array(
        get_stylesheet_directory() . '/woocommerce/' . $template_name,
        get_template_directory() . '/woocommerce/' . $template_name,
        defined( 'LMW_THEME_DIR' ) ? LMW_THEME_DIR . '/woocommerce/' . $template_name : '',
    );
    foreach ( $candidates as $candidate ) {
        if ( ! empty( $candidate ) && file_exists( $candidate ) ) {
            return $candidate;
        }
    }
    return $template;
}
add_filter( 'woocommerce_locate_template', 'lmw_theme_wc_locate_template', 999, 3 );

/**
 * Output luxury trust and member benefits bar on customer login page.
 */
function lmw_theme_auth_perks_bar() {
    ?>
    <div class="lmw-auth-trust-bar">
        <div class="lmw-auth-trust-item">
            <div class="lmw-auth-trust-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="lmw-auth-trust-text">
                <strong>100% Encrypted & Private</strong>
                <span>Bank-grade security protects your credentials and personal wardrobe data.</span>
            </div>
        </div>
        <div class="lmw-auth-trust-item">
            <div class="lmw-auth-trust-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
            <div class="lmw-auth-trust-text">
                <strong>Complimentary Express Delivery</strong>
                <span>Club members receive priority expedited courier shipping on all orders.</span>
            </div>
        </div>
        <div class="lmw-auth-trust-item">
            <div class="lmw-auth-trust-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
            </div>
            <div class="lmw-auth-trust-text">
                <strong>7-Day Bespoke Exchanges</strong>
                <span>Effortless size swaps and fit consultations handled by personal stylists.</span>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'woocommerce_after_customer_login_form', 'lmw_theme_auth_perks_bar', 20 );

/**
 * Support custom faceted query parameters on main shop queries.
 */
function lmw_theme_modify_shop_query( $q ) {
    if ( ! is_admin() && $q->is_main_query() && ( is_shop() || is_product_taxonomy() ) ) {
        $tax_query = (array) $q->get( 'tax_query' );

        // 1. Size filter
        if ( ! empty( $_GET['filter_size'] ) ) {
            $sizes = array_filter( explode( ',', sanitize_text_field( wp_unslash( $_GET['filter_size'] ) ) ) );
            if ( ! empty( $sizes ) ) {
                $tax_query[] = array(
                    'taxonomy' => 'pa_size',
                    'field'    => 'slug',
                    'terms'    => $sizes,
                    'operator' => 'IN',
                );
            }
        }

        // 2. Color filter
        if ( ! empty( $_GET['filter_color'] ) ) {
            $colors = array_filter( explode( ',', sanitize_text_field( wp_unslash( $_GET['filter_color'] ) ) ) );
            if ( ! empty( $colors ) ) {
                $tax_query[] = array(
                    'taxonomy' => 'pa_color',
                    'field'    => 'slug',
                    'terms'    => $colors,
                    'operator' => 'IN',
                );
            }
        }

        // 3. Category filter (if selected via GET on main shop)
        if ( ! empty( $_GET['product_cat'] ) && ! is_product_category() ) {
            $cat = sanitize_text_field( wp_unslash( $_GET['product_cat'] ) );
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $cat,
            );
        }

        if ( ! empty( $tax_query ) ) {
            $tax_query['relation'] = 'AND';
            $q->set( 'tax_query', $tax_query );
        }

        // 4. Min & Max price filters
        $min_price = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
        $max_price = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 0;

        if ( $min_price > 0 || ( $max_price > 0 && $max_price < 4000 ) ) {
            $meta_query = (array) $q->get( 'meta_query' );
            if ( $min_price > 0 && $max_price > 0 && $max_price < 4000 ) {
                $meta_query[] = array(
                    'key'     => '_price',
                    'value'   => array( $min_price, $max_price ),
                    'type'    => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            } elseif ( $min_price > 0 ) {
                $meta_query[] = array(
                    'key'     => '_price',
                    'value'   => $min_price,
                    'type'    => 'NUMERIC',
                    'compare' => '>=',
                );
            } elseif ( $max_price > 0 && $max_price < 4000 ) {
                $meta_query[] = array(
                    'key'     => '_price',
                    'value'   => $max_price,
                    'type'    => 'NUMERIC',
                    'compare' => '<=',
                );
            }
            $q->set( 'meta_query', $meta_query );
        }
    }
}
add_action( 'woocommerce_product_query', 'lmw_theme_modify_shop_query' );

/**
 * AJAX handler for live shop faceted filtering.
 */
function lmw_theme_ajax_filter_products() {
    check_ajax_referer( 'lmw_shop_filter_nonce', 'nonce' );

    $paged      = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : 1;
    $orderby    = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : 'menu_order';
    $cat        = isset( $_POST['product_cat'] ) ? sanitize_text_field( wp_unslash( $_POST['product_cat'] ) ) : '';
    $sizes_raw  = isset( $_POST['filter_size'] ) ? sanitize_text_field( wp_unslash( $_POST['filter_size'] ) ) : '';
    $colors_raw = isset( $_POST['filter_color'] ) ? sanitize_text_field( wp_unslash( $_POST['filter_color'] ) ) : '';
    $min_price  = isset( $_POST['min_price'] ) ? floatval( $_POST['min_price'] ) : 0;
    $max_price  = isset( $_POST['max_price'] ) ? floatval( $_POST['max_price'] ) : 0;

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => apply_filters( 'loop_shop_per_page', 24 ),
        'paged'          => $paged,
        'tax_query'      => array( 'relation' => 'AND' ),
        'meta_query'     => array(),
    );

    // Sorting
    switch ( $orderby ) {
        case 'price':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order']    = 'ASC';
            break;
        case 'price-desc':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order']    = 'DESC';
            break;
        case 'date':
            $args['orderby'] = 'date';
            $args['order']   = 'DESC';
            break;
        case 'popularity':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order']    = 'DESC';
            break;
        case 'rating':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_wc_average_rating';
            $args['order']    = 'DESC';
            break;
        default:
            $args['orderby'] = 'menu_order title';
            $args['order']   = 'ASC';
            break;
    }

    // Category
    if ( ! empty( $cat ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $cat,
        );
    }

    // Sizes
    if ( ! empty( $sizes_raw ) ) {
        $sizes = array_filter( explode( ',', $sizes_raw ) );
        if ( ! empty( $sizes ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'pa_size',
                'field'    => 'slug',
                'terms'    => $sizes,
                'operator' => 'IN',
            );
        }
    }

    // Colors
    if ( ! empty( $colors_raw ) ) {
        $colors = array_filter( explode( ',', $colors_raw ) );
        if ( ! empty( $colors ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'pa_color',
                'field'    => 'slug',
                'terms'    => $colors,
                'operator' => 'IN',
            );
        }
    }

    // Price
    if ( $min_price > 0 && $max_price > 0 && $max_price < 4000 ) {
        $args['meta_query'][] = array(
            'key'     => '_price',
            'value'   => array( $min_price, $max_price ),
            'type'    => 'NUMERIC',
            'compare' => 'BETWEEN',
        );
    } elseif ( $min_price > 0 ) {
        $args['meta_query'][] = array(
            'key'     => '_price',
            'value'   => $min_price,
            'type'    => 'NUMERIC',
            'compare' => '>=',
        );
    } elseif ( $max_price > 0 && $max_price < 4000 ) {
        $args['meta_query'][] = array(
            'key'     => '_price',
            'value'   => $max_price,
            'type'    => 'NUMERIC',
            'compare' => '<=',
        );
    }

    $query = new WP_Query( $args );

    ob_start();
    if ( $query->have_posts() ) {
        woocommerce_product_loop_start();
        while ( $query->have_posts() ) {
            $query->the_post();
            wc_get_template_part( 'content', 'product' );
        }
        woocommerce_product_loop_end();
    } else {
        ?>
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
        <?php
    }
    $products_html = ob_get_clean();

    $total = $query->found_posts;
    if ( $total > 0 ) {
        $count_str = sprintf( _n( 'Showing 1 result', 'Showing all %d results', $total, 'lmw-theme' ), $total );
    } else {
        $count_str = __( 'Showing 0 results', 'lmw-theme' );
    }

    wp_reset_postdata();

    wp_send_json_success( array(
        'html'        => $products_html,
        'count_html'  => '<p class="woocommerce-result-count">' . esc_html( $count_str ) . '</p>',
        'found_posts' => $total,
    ) );
}
add_action( 'wp_ajax_lmw_filter_products', 'lmw_theme_ajax_filter_products' );
add_action( 'wp_ajax_nopriv_lmw_filter_products', 'lmw_theme_ajax_filter_products' );

