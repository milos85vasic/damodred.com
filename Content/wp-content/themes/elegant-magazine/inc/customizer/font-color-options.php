<?php

/**
 * Font and Color Option Panel
 *
 * @package Elegant_Magazine
 */

$default = elegant_magazine_get_default_theme_options();



// Setting - show_site_title_section.
$wp_customize->add_setting('top_header_background_color',
    array(
        'default'           => $default['top_header_background_color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'top_header_background_color',
        array(
            'label'      => esc_html__( 'Top header background color', 'elegant-magazine' ),
            'section'    => 'colors',
            'settings'   => 'top_header_background_color',
            'priority' => 9,
            //'active_callback' => 'elegant_magazine_top_header_status'
        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('top_header_text_color',
    array(
        'default'           => $default['top_header_text_color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'top_header_text_color',
        array(
            'label'      => esc_html__( 'Top header texts color', 'elegant-magazine' ),
            'section'    => 'colors',
            'settings'   => 'top_header_text_color',
            'priority' => 9,
            //'active_callback' => 'elegant_magazine_top_header_status'
        )
    )
);

