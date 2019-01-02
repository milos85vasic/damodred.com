<?php

/**
 * Option Panel
 *
 * @package Elegant_Magazine
 */

$default = elegant_magazine_get_default_theme_options();
/*theme option panel info*/
require get_template_directory().'/inc/customizer/frontpage-options.php';

//font and color options
require get_template_directory().'/inc/customizer/font-color-options.php';

// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
	array(
		'title'      => esc_html__('Theme Options', 'elegant-magazine'),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

// Preloader Section.
$wp_customize->add_section('site_preloader_settings',
    array(
        'title'      => esc_html__('Preloader', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - preloader.
$wp_customize->add_setting('enable_site_preloader',
    array(
        'default'           => $default['enable_site_preloader'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_site_preloader',
    array(
        'label'    => esc_html__('Enable preloader', 'elegant-magazine'),
        'section'  => 'site_preloader_settings',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);


/**
 * Header section
 *
 * @package Elegant_Magazine
 */

// Frontpage Section.
$wp_customize->add_section('header_options_settings',
	array(
		'title'      => esc_html__('Header', 'elegant-magazine'),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);



// Setting - show_site_title_section.
$wp_customize->add_setting('top_header_transparency',
    array(
        'default'           => $default['top_header_transparency'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);
$wp_customize->add_control('top_header_transparency',
    array(
        'label'    => esc_html__('Transparent top header', 'elegant-magazine'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'elegant_magazine_top_header_status'
    )
);




// Setting - show_site_title_section.
$wp_customize->add_setting('show_date_section',
    array(
        'default'           => $default['show_date_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_date_section',
    array(
        'label'    => esc_html__('Show date on top header', 'elegant-magazine'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'elegant_magazine_top_header_status'
    )
);



// Setting - show_site_title_section.
$wp_customize->add_setting('show_social_menu_section',
    array(
        'default'           => $default['show_social_menu_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_social_menu_section',
    array(
        'label'    => esc_html__('Show social menu on top header', 'elegant-magazine'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 11,
        //'active_callback' => 'elegant_magazine_top_header_status'
    )
);


// Breadcrumb Section.
$wp_customize->add_section('site_breadcrumb_settings',
    array(
        'title'      => esc_html__('Breadcrumb', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - breadcrumb.
$wp_customize->add_setting('enable_breadcrumb',
    array(
        'default'           => $default['enable_breadcrumb'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_breadcrumb',
    array(
        'label'    => esc_html__('Show breadcrumbs', 'elegant-magazine'),
        'section'  => 'site_breadcrumb_settings',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);



/**
 * Layout options section
 *
 * @package Elegant_Magazine
 */

// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title'      => esc_html__('Layout', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_content_alignment',
    array(
        'default'           => $default['global_content_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_select',
    )
);

$wp_customize->add_control( 'global_content_alignment',
    array(
        'label'       => esc_html__('Content alignment', 'elegant-magazine'),
        'description' => esc_html__('Select global content alignment', 'elegant-magazine'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'align-content-left' => esc_html__( 'Content - Primary sidebar', 'elegant-magazine' ),
            'align-content-right' => esc_html__( 'Primary sidebar - Content', 'elegant-magazine' ),
            'full-width-content' => esc_html__( 'Full width content', 'elegant-magazine' )
        ),
        'priority'    => 130,
    ));



/**
 * Archive options section
 *
 * @package Elegant_Magazine
 */

// Archive Section.
$wp_customize->add_section('site_archive_settings',
    array(
        'title'      => esc_html__('Archive', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

 //Setting - archive content view of news.
$wp_customize->add_setting('archive_layout',
    array(
        'default'           => $default['archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_layout',
    array(
        'label'       => esc_html__('Archive layout', 'elegant-magazine'),
        'description' => esc_html__('Select layout for archive', 'elegant-magazine'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-layout-full' => esc_html__( 'Full', 'elegant-magazine' ),
            'archive-layout-list' => esc_html__( 'List', 'elegant-magazine' ),

        ),
        'priority'    => 130,
    ));

// Setting - archive content view of news.
$wp_customize->add_setting('archive_image_alignment',
    array(
        'default'           => $default['archive_image_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_image_alignment',
    array(
        'label'       => esc_html__('Image alignment', 'elegant-magazine'),
        'description' => esc_html__('Select image alignment for archive', 'elegant-magazine'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-image-left' => esc_html__( 'Left', 'elegant-magazine' ),
            'archive-image-right' => esc_html__( 'Right', 'elegant-magazine' )
        ),
        'priority'    => 130,
        'active_callback' => 'elegant_magazine_archive_image_status'
    ));

 //Setting - archive content view of news.
$wp_customize->add_setting('archive_content_view',
    array(
        'default'           => $default['archive_content_view'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_content_view',
    array(
        'label'       => esc_html__('Content view', 'elegant-magazine'),
        'description' => esc_html__('Select content view for archive', 'elegant-magazine'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-content-excerpt' => esc_html__( 'Post excerpt', 'elegant-magazine' ),
            'archive-content-full' => esc_html__( 'Full Content', 'elegant-magazine' )

        ),
        'priority'    => 130,
    ));


//========== Related posts options ===============

// Single Section.
$wp_customize->add_section('site_single_related_posts_settings',
    array(
        'title'      => esc_html__('Related Posts', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_related_posts',
    array(
        'default'           => $default['single_show_related_posts'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);

$wp_customize->add_control( 'single_show_related_posts',
    array(
        'label'    => __( 'Show on single posts', 'elegant-magazine' ),
        'section'  => 'site_single_related_posts_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_related_posts_title',
    array(
        'default'           => $default['single_related_posts_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'single_related_posts_title',
    array(
        'label'    => __( 'Title', 'elegant-magazine' ),
        'section'  => 'site_single_related_posts_settings',
        'type'     => 'text',
        'priority' => 100,
        'active_callback' => 'elegant_magazine_related_posts_status'
    )
);


//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section('site_footer_latest_blog_settings',
    array(
        'title'      => esc_html__('Latest blog carousel', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - latest blog carousel.
$wp_customize->add_setting('footer_show_latest_blog_carousel',
    array(
        'default'           => $default['footer_show_latest_blog_carousel'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'elegant_magazine_sanitize_checkbox',
    )
);

$wp_customize->add_control( 'footer_show_latest_blog_carousel',
    array(
        'label'    => __( 'Show above footer', 'elegant-magazine' ),
        'section'  => 'site_footer_latest_blog_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);

// Footer Section.
$wp_customize->add_section('site_footer_settings',
    array(
        'title'      => esc_html__('Footer', 'elegant-magazine'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('footer_copyright_text',
    array(
        'default'           => $default['footer_copyright_text'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'footer_copyright_text',
    array(
        'label'    => __( 'Copyright Text', 'elegant-magazine' ),
        'section'  => 'site_footer_settings',
        'type'     => 'text',
        'priority' => 100,
    )
);