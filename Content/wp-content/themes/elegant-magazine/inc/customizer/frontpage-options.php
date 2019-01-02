<?php

/**
 * Option Panel
 *
 * @package Elegant_Magazine
 */

$default = elegant_magazine_get_default_theme_options();

/**
 * Frontpage options section
 *
 * @package Elegant_Magazine
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('frontpage_option_panel',
    array(
        'title'      => esc_html__('Frontpage Options', 'elegant-magazine'),
        'priority'   => 199,
        'capability' => 'edit_theme_options',
    )
);

// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings',
    array(
        'title'      => esc_html__('Advertisement', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);



// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default'           => $default['banner_advertisement_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label'       => esc_html__('Banner Section Advertisement', 'elegant-magazine'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'elegant-magazine'), 1170, 90),
            'section'     => 'frontpage_advertisement_settings',
            'width' => 1170,
            'height' => 90,
            'flex_width' => true,
            'flex_height' => true,
            'priority'    => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default'           => $default['banner_advertisement_section_url'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label'    => esc_html__('URL Link', 'elegant-magazine'),
        'section'  => 'frontpage_advertisement_settings',
        'type'     => 'text',
        'priority' => 130,
    )
);



// Ticker Section.
$wp_customize->add_section('frontpage_ticker_settings',
    array(
        'title'      => esc_html__('Ticker news', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


// Setting - show_ticker_section.
$wp_customize->add_setting('show_ticker_news_section',
	array(
		'default'           => $default['show_ticker_news_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
	)
);


$wp_customize->add_control('show_ticker_news_section',
	array(
		'label'    => esc_html__('Enable Ticker News', 'elegant-magazine'),
		'section'  => 'frontpage_ticker_settings',
		'type'     => 'checkbox',
		'priority' => 10,
	)
);

// Setting - ticker_title.
$wp_customize->add_setting('ticker_section_title',
	array(
		'default'           => $default['ticker_section_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('ticker_section_title',
	array(
		'label'    => esc_html__('Ticker Title', 'elegant-magazine'),
		'section'  => 'frontpage_ticker_settings',
		'type'     => 'text',
		'priority' => 15,
		'active_callback' => 'elegant_magazine_ticker_news_status'
	)
);

// Setting - drop down category for Ticker News section.
$wp_customize->add_setting('select_ticker_news_category',
	array(
		'default'           => $default['select_ticker_news_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(new Elegant_Magazine_Dropdown_Taxonomies_Control($wp_customize, 'select_ticker_news_category',
		array(
			'label'       => esc_html__('Ticker News Category', 'elegant-magazine'),
			'description' => esc_html__('Select category to be shown on ticker ', 'elegant-magazine'),
			'section'     => 'frontpage_ticker_settings',
			'type'        => 'dropdown-taxonomies',
			'taxonomy'    => 'category',
			'priority'    => 20,
            'active_callback' => 'elegant_magazine_ticker_news_status'
		)));




// Ticker Section.
$wp_customize->add_section('frontpage_main_news_settings',
    array(
        'title'      => esc_html__('Main banner news', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default'           => $default['show_main_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label'    => esc_html__('Enable main news section', 'elegant-magazine'),
        'section'  => 'frontpage_main_news_settings',
        'type'     => 'checkbox',
        'priority' => 22,
        //'active_callback' => 'elegant_magazine_slider_section_status'
    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default'           => $default['select_slider_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Elegant_Magazine_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label'       => esc_html__('Slider news category', 'elegant-magazine'),
        'description' => esc_html__('Select category to be shown on slider ', 'elegant-magazine'),
        'section'     => 'frontpage_main_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => 'elegant_magazine_slider_section_status'
    )));



// Setting - drop down category for slider.
$wp_customize->add_setting('select_featured_news_category',
    array(
        'default'           => $default['select_featured_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(new Elegant_Magazine_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_news_category',
    array(
        'label'       => esc_html__('Featured news category', 'elegant-magazine'),
        'description' => esc_html__('Select category to be shown on featured section ', 'elegant-magazine'),
        'section'     => 'frontpage_main_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 24,
        'active_callback' => 'elegant_magazine_slider_section_status'
    )));

/*Home Page Layout*/
$wp_customize->add_setting( 'frontpage_content_status',
    array(
        'default'           => $default['frontpage_content_status'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'frontpage_content_status',
    array(
        'label'    => esc_html__( 'Enable static page content', 'elegant-magazine' ),
        'section'  => 'static_front_page',
        'type'     => 'checkbox',
        'priority' => 150,
        'active_callback' => 'elegant_magazine_frontpage_content_status'

    )
);

// Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title'      => esc_html__('Layout', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


$wp_customize->add_control( 'frontpage_content_alignment',
    array(
        'label'       => esc_html__('Frontpage Content alignment', 'elegant-magazine'),
        'description' => esc_html__('Select frontpage content alignment', 'elegant-magazine'),
        'section'     => 'frontpage_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'align-content-left' => esc_html__( 'Home Content - Home Sidebar', 'elegant-magazine' ),
            'align-content-right' => esc_html__( 'Home Sidebar - Home Content', 'elegant-magazine' ),
            'full-width-content' => esc_html__( 'Only Home Content', 'elegant-magazine' )
        ),
        'priority'    => 130,
    ));

// Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title'      => esc_html__('Layout', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_alignment',
    array(
        'default'           => $default['frontpage_content_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_select',
    )
);

$wp_customize->add_control( 'frontpage_content_alignment',
    array(
        'label'       => esc_html__('Frontpage Content alignment', 'elegant-magazine'),
        'description' => esc_html__('Select frontpage content alignment', 'elegant-magazine'),
        'section'     => 'frontpage_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'align-content-left' => esc_html__( 'Home Content - Home Sidebar', 'elegant-magazine' ),
            'align-content-right' => esc_html__( 'Home Sidebar - Home Content', 'elegant-magazine' ),
            'full-width-content' => esc_html__( 'Only Home Content', 'elegant-magazine' )
        ),
        'priority'    => 130,
    ));