<?php
/**
 * Basic Settings
 *
 * Register Basic Settings section, settings and controls for Theme Customizer
 *
 * @package Blogg
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_basic_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'blogg_section_basic', array(
		'title'    => esc_html__( 'Basic Settings', 'blogg' ),
		'priority' => 8,
		'panel' => 'blogg_options_panel',
	) );
	
	// Add Post Details Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_theme_options[basic_options]', array(
			'label' => esc_html__( 'Basic Options', 'blogg' ),
			'section' => 'blogg_section_basic',
			'settings' => array(),
		)
	) );	
	// Add Blog Title setting and control.
	$wp_customize->add_setting( 'blogg_copyright', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'blogg_copyright', array(
		'label'    => esc_html__( 'Copyright Name', 'blogg' ),
		'section'  => 'blogg_section_basic',
		'type'     => 'text',
	) );
	
	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'blogg_show_design_by', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_show_design_by', array(
		'label'    => esc_html__( 'Show the Design By Credit Line', 'blogg' ),
		'section'  => 'blogg_section_basic',
		'type'     => 'checkbox',
	) );

		// Add Gallery Comments Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_theme_options[basic_options]', array(
			'label' => esc_html__( 'WP Gallery Options', 'blogg' ),
			'section' => 'blogg_section_basic',
			'settings' => array(),
		)
	) );
	
	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'blogg_attachment_comments', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_attachment_comments', array(
		'label'    => esc_html__( 'Enable Gallery View Comments', 'blogg' ),
		'section'  => 'blogg_section_basic',
		'type'     => 'checkbox',
	) );

	// Add Google Fonts Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_theme_options[google_fonts_option]', array(
			'label' => esc_html__( 'Default Google Fonts', 'blogg' ),
			'section' => 'blogg_section_basic',
			'settings' => array(),
		)
	) );

	// Enable Default Google Fonts
	$wp_customize->add_setting( 'blogg_default_google_fonts', array(
		'default'           => true,
		'description' => esc_html__( 'This theme has a couple Google Fonts included. If you choose to use a plugin for different fonts, you can disable them.', 'blogg' ),
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_default_google_fonts', array(
		'label'    => esc_html__( 'Enable the Default Google Fonts', 'blogg' ),
		'section'  => 'blogg_section_basic',
		'type'     => 'checkbox',
	) );	
	
}
add_action( 'customize_register', 'blogg_customize_register_basic_settings' );

