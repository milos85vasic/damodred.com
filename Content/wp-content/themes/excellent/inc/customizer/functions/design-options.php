<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
$excellent_settings = excellent_get_theme_options();
/******************** EXCELLENT LAYOUT OPTIONS ******************************************/
	$wp_customize->add_section('excellent_layout_options', array(
		'title' => __('Layout Options', 'excellent'),
		'priority' => 102,
		'panel' => 'excellent_options_panel'
	));
	$wp_customize->add_setting('excellent_theme_options[excellent_responsive]', array(
		'default' => $excellent_settings['excellent_responsive'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('excellent_theme_options[excellent_responsive]', array(
		'priority' =>10,
		'label' => __('Responsive Layout', 'excellent'),
		'section' => 'excellent_layout_options',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'on' => __('ON ','excellent'),
			'off' => __('OFF','excellent'),
		),
	));
	$wp_customize->add_setting('excellent_theme_options[excellent_blog_layout]', array(
		'default' => $excellent_settings['excellent_blog_layout'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('excellent_theme_options[excellent_blog_layout]', array(
		'priority' =>30,
		'label' => __('Blog Layout', 'excellent'),
		'section'    => 'excellent_layout_options',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'large_image_display' => __('Blog with large Image','excellent'),
			'medium_image_display' => __('Blog with small Image','excellent'),
			'two_column_image_display' => __('Blog with Two Column','excellent'),
		),
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_entry_meta_single]', array(
		'default' => $excellent_settings['excellent_entry_meta_single'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_entry_meta_single]', array(
		'priority'=>40,
		'label' => __('Disable Entry Meta from Single Page', 'excellent'),
		'section' => 'excellent_layout_options',
		'type' => 'select',
		'choices' => array(
		'show' => __('Display Entry Format','excellent'),
		'hide' => __('Hide Entry Format','excellent'),
	),
	));
	$wp_customize->add_setting( 'excellent_theme_options[excellent_entry_meta_blog]', array(
		'default' => $excellent_settings['excellent_entry_meta_blog'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_entry_meta_blog]', array(
		'priority'=>45,
		'label' => __('Disable Entry Meta from Blog Page', 'excellent'),
		'section' => 'excellent_layout_options',
		'type'	=> 'select',
		'choices' => array(
		'show-meta' => __('Display Entry Meta','excellent'),
		'hide-meta' => __('Hide Entry Meta','excellent'),
	),
	));
	$wp_customize->add_setting('excellent_theme_options[excellent_design_layout]', array(
		'default'        => $excellent_settings['excellent_design_layout'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type'                  => 'option',
	));
	$wp_customize->add_control('excellent_theme_options[excellent_design_layout]', array(
	'priority'  =>50,
	'label'      => __('Design Layout', 'excellent'),
	'section'    => 'excellent_layout_options',
	'type'       => 'select',
	'checked'   => 'checked',
	'choices'    => array(
		'full-width-layout' => __('Full Width Layout','excellent'),
		'boxed-layout' => __('Boxed Layout','excellent'),
		'small-boxed-layout' => __('Small Boxed Layout','excellent'),
	),
));