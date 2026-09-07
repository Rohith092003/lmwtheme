<?php
/**
 * Theme Customizer settings
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function lmw_theme_customize_register( $wp_customize ) {

    // ─── Store Information Section ───
    $wp_customize->add_section( 'lmw_store_info', array(
        'title'    => __( 'Store Information', 'lmw-theme' ),
        'priority' => 30,
    ) );

    // Store phone
    $wp_customize->add_setting( 'lmw_store_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'lmw_store_phone', array(
        'label'   => __( 'Store Phone', 'lmw-theme' ),
        'section' => 'lmw_store_info',
        'type'    => 'text',
    ) );

    // Store email
    $wp_customize->add_setting( 'lmw_store_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'lmw_store_email', array(
        'label'   => __( 'Store Email', 'lmw-theme' ),
        'section' => 'lmw_store_info',
        'type'    => 'email',
    ) );

    // Store address
    $wp_customize->add_setting( 'lmw_store_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'lmw_store_address', array(
        'label'   => __( 'Store Address', 'lmw-theme' ),
        'section' => 'lmw_store_info',
        'type'    => 'textarea',
    ) );

    // ─── Social Media Section ───
    $wp_customize->add_section( 'lmw_social_media', array(
        'title'    => __( 'Social Media', 'lmw-theme' ),
        'priority' => 35,
    ) );

    $social_links = array(
        'facebook'  => __( 'Facebook URL', 'lmw-theme' ),
        'instagram' => __( 'Instagram URL', 'lmw-theme' ),
        'twitter'   => __( 'X (Twitter) URL', 'lmw-theme' ),
        'youtube'   => __( 'YouTube URL', 'lmw-theme' ),
    );

    foreach ( $social_links as $key => $label ) {
        $wp_customize->add_setting( "lmw_social_{$key}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "lmw_social_{$key}", array(
            'label'   => $label,
            'section' => 'lmw_social_media',
            'type'    => 'url',
        ) );
    }
}
add_action( 'customize_register', 'lmw_theme_customize_register' );
