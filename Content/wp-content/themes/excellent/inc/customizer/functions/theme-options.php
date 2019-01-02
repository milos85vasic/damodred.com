<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
$excellent_settings = excellent_get_theme_options();
/********************  EXCELLENT THEME OPTIONS ******************************************/
	$wp_customize->add_section('title_tagline', array(
	'title' => __('Site Title & Logo Options', 'excellent'),
	'priority' => 10,
	'panel' => 'excellent_wordpress_default_panel'
	));
	$wp_customize->add_setting('excellent_theme_options[excellent_header_display]', array(
		'capability' => 'edit_theme_options',
		'default' => $excellent_settings['excellent_header_display'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('excellent_theme_options[excellent_header_display]', array(
		'label' => __('Site Logo/ Text Options', 'excellent'),
		'priority' => 102,
		'section' => 'title_tagline',
		'type' => 'select',
		'checked' => 'checked',
			'choices' => array(
			'header_text' => __('Display Site Title Only','excellent'),
			'header_logo' => __('Display Site Logo Only','excellent'),
			'show_both' => __('Show Both','excellent'),
			'disable_both' => __('Disable Both','excellent'),
		),
	));
	$wp_customize->add_setting('excellent_theme_options[excellent_site_sticky_hide_social_icon]', array(
		'capability' => 'edit_theme_options',
		'default' => $excellent_settings['excellent_site_sticky_hide_social_icon'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('excellent_theme_options[excellent_site_sticky_hide_social_icon]', array(
		'label' => __('Show Site Title and Hide Social Icon on Sticky Header', 'excellent'),
		'priority' => 104,
		'section' => 'title_tagline',
		'type' => 'select',
		'checked' => 'checked',
			'choices' => array(
			'on' => __('ON','excellent'),
			'off' => __('OFF','excellent'),
		),
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_logo_high_resolution]', array(
		'default' => $excellent_settings['excellent_logo_high_resolution'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_logo_high_resolution]', array(
		'priority'=>110,
		'label' => __('Logo for high resolution screen(Use 2X size image)', 'excellent'),
		'section' => 'title_tagline',
		'type' => 'checkbox',
	));
	$wp_customize->add_section('excellent_custom_header', array(
		'title' => __('Excellent Options', 'excellent'),
		'priority' => 503,
		'panel' => 'excellent_options_panel'
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_search_custom_header]', array(
		'default' => $excellent_settings['excellent_search_custom_header'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_search_custom_header]', array(
		'priority'=>20,
		'label' => __('Disable Search Form', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_stick_menu]', array(
		'default' => $excellent_settings['excellent_stick_menu'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_stick_menu]', array(
		'priority'=>30,
		'label' => __('Disable Stick Menu', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_scroll]', array(
		'default' => $excellent_settings['excellent_scroll'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_scroll]', array(
		'priority'=>40,
		'label' => __('Disable Goto Top', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_top_social_icons]', array(
		'default' => $excellent_settings['excellent_top_social_icons'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_top_social_icons]', array(
		'priority'=>40,
		'label' => __('Disable Top Social Icons', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_buttom_social_icons]', array(
		'default' => $excellent_settings['excellent_buttom_social_icons'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_buttom_social_icons]', array(
		'priority'=>40,
		'label' => __('Disable Bottom Social Icons', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_scrollreveal_effect]', array(
		'default' => $excellent_settings['excellent_scrollreveal_effect'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_scrollreveal_effect]', array(
		'priority'=>45,
		'label' => __('Disable WOW Effect', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_reset_all]', array(
		'default' => $excellent_settings['excellent_reset_all'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'excellent_reset_alls',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_reset_all]', array(
		'priority'=>70,
		'label' => __('Reset all default settings. (Refresh it to view the effect)', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_display_page_single_featured_image]', array(
		'default' => $excellent_settings['excellent_display_page_single_featured_image'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_display_page_single_featured_image]', array(
		'priority'=>48,
		'label' => __('Disable Page/Single Featured Image', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_small_feature_single_post]', array(
		'default' => $excellent_settings['excellent_small_feature_single_post'],
		'sanitize_callback' => 'excellent_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_small_feature_single_post]', array(
		'priority'=>48,
		'label' => __('Display Small Featured Image in Single Post', 'excellent'),
		'section' => 'excellent_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_section('excellent_footer_image', array(
		'title' => __('Footer Background Image', 'excellent'),
		'priority' => 510,
		'panel' => 'excellent_options_panel'
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent-img-upload-footer-image]',array(
		'default'	=> $excellent_settings['excellent-img-upload-footer-image'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type' => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'excellent_theme_options[excellent-img-upload-footer-image]', array(
		'label' => __('Footer Background Image','excellent'),
		'description' => __('Image will be displayed on footer','excellent'),
		'priority'	=> 50,
		'section' => 'excellent_footer_image',
		)
	));
/********************** EXCELLENT WORDPRESS DEFAULT PANEL ***********************************/
	$wp_customize->add_section('header_image', array(
	'title' => __('Header Media', 'excellent'),
	'priority' => 20,
	'panel' => 'excellent_wordpress_default_panel'
	));
	$wp_customize->add_section('colors', array(
	'title' => __('Colors', 'excellent'),
	'priority' => 30,
	'panel' => 'excellent_wordpress_default_panel'
	));
	$wp_customize->add_section('background_image', array(
	'title' => __('Background Image', 'excellent'),
	'priority' => 40,
	'panel' => 'excellent_wordpress_default_panel'
	));
	$wp_customize->add_section('nav', array(
	'title' => __('Navigation', 'excellent'),
	'priority' => 50,
	'panel' => 'excellent_wordpress_default_panel'
	));
	$wp_customize->add_section('static_front_page', array(
	'title' => __('Static Front Page', 'excellent'),
	'priority' => 60,
	'panel' => 'excellent_wordpress_default_panel'
	));