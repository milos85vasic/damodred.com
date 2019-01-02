<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
/******************** EXCELLENT SLIDER SETTINGS ******************************************/
$excellent_settings = excellent_get_theme_options();
$wp_customize->add_section( 'featured_content', array(
	'title' => __( 'Slider Settings', 'excellent' ),
	'priority' => 140,
	'panel' => 'excellent_featuredcontent_panel'
));
$wp_customize->add_section( 'slider_category_content', array(
	'title' => __( 'Select Category Slider', 'excellent' ),
	'priority' => 150,
	'panel' => 'excellent_featuredcontent_panel'
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_enable_slider]', array(
	'default' => $excellent_settings['excellent_enable_slider'],
	'sanitize_callback' => 'excellent_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_enable_slider]', array(
	'priority'=>10,
	'label' => __('Enable Slider', 'excellent'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'frontpage' => __('Front Page','excellent'),
		'enitresite' => __('Entire Site','excellent'),
		'disable' => __('Disable Slider','excellent'),
	),
));
$wp_customize->add_setting('excellent_theme_options[excellent_secondary_text]', array(
	'default' =>$excellent_settings['excellent_secondary_text'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('excellent_theme_options[excellent_secondary_text]', array(
	'priority' =>20,
	'label' => __('Secondary Button Text', 'excellent'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting('excellent_theme_options[excellent_secondary_url]', array(
	'default' =>$excellent_settings['excellent_secondary_url'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('excellent_theme_options[excellent_secondary_url]', array(
	'priority' =>30,
	'label' => __('Secondary Button Url', 'excellent'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_animation_effect]', array(
	'default' => $excellent_settings['excellent_animation_effect'],
	'sanitize_callback' => 'excellent_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_animation_effect]', array(
	'priority'=>40,
	'label' => __('Animation Effect', 'excellent'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'slide' => __('Slide','excellent'),
		'fade' => __('Fade','excellent'),
	),
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_slideshowSpeed]', array(
	'default' => $excellent_settings['excellent_slideshowSpeed'],
	'sanitize_callback' => 'excellent_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_slideshowSpeed]', array(
	'priority'=>50,
	'label' => __('Set the speed of the slideshow cycling', 'excellent'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_animationSpeed]', array(
	'default' => $excellent_settings['excellent_animationSpeed'],
	'sanitize_callback' => 'excellent_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_animationSpeed]', array(
	'priority'=>60,
	'label' => __(' Set the speed of animations', 'excellent'),
	'description' => __('This feature will not work on Animation Effect set to fade','excellent'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_direction]', array(
	'default' => $excellent_settings['excellent_direction'],
	'sanitize_callback' => 'excellent_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_direction]', array(
	'priority'=>70,
	'label' => __(' Controls the animation direction', 'excellent'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'horizontal' => __('Horizontal','excellent'),
		'vertical' => __('Vertical','excellent'),
	),
));
$wp_customize->add_setting('excellent_theme_options[excellent_slider_content_bg_color]', array(
	'default' =>$excellent_settings['excellent_slider_content_bg_color'],
	'sanitize_callback' => 'excellent_sanitize_select',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('excellent_theme_options[excellent_slider_content_bg_color]', array(
	'priority' =>80,
	'label' => __('Slider Content With background color', 'excellent'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
	'on' => __('Show Background Color','excellent'),
	'off' => __('Hide Background Color','excellent'),
	),
));
/* Select your category to display Slider */
$wp_customize->add_setting( 'excellent_theme_options[excellent_category_slider]', array(
		'default'				=>array(),
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'excellent_sanitize_latest_from_blog_select',
		'type'				=> 'option'
	));
$wp_customize->add_control(
	new Excellent_Category_Control(
	$wp_customize,
	'excellent_theme_options[excellent_category_slider]',
		array(
			'priority' 				=> 10,
			'label'					=> __('Select Slider Category','excellent'),
			'description'			=> __('By default it will display all post','excellent'),
			'section'				=> 'slider_category_content',
			'settings'				=> 'excellent_theme_options[excellent_category_slider]',
			'type'					=>'select'
		)
	)
);