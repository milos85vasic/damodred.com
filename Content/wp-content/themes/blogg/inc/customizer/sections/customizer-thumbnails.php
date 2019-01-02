<?php
/**
 * Thumbnail Settings
 * Register Thumbnails section, settings and controls for the Theme Customizer
 * Settings and controls to manage image thumbnail cropping
 *
 * @package Blogg
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_thumbnail_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'blogg_section_thumbnails', array(
		'title'    => esc_html__( 'Thumbnail Settings', 'blogg' ),
		'priority' => 50,
		'panel'    => 'blogg_options_panel',
	) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_theme_options[crop_featured_images]', array(
		'label' => esc_html__( 'Crop Blog Featured Images', 'blogg' ),
		'section' => 'blogg_section_thumbnails',
		'settings' => array(),
		)
	) );
	
	
	// Add Setting and Control for cropping default featured images on blog and archives.
	$wp_customize->add_setting( 'blogg_crop_standard_featured', array(
		'default'           => false,
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_crop_standard_featured', array(
		'label'    => esc_html__( 'Crop featured images for the standard (default) blog Layout', 'blogg' ),
		'section'  => 'blogg_section_thumbnails',
		'type'     => 'checkbox',
	) );	
	
	// Add Setting and Control for cropping Grid featured images on blog and archives.
	$wp_customize->add_setting( 'blogg_crop_grid_featured', array(
		'default'           => false,
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_crop_grid_featured', array(
		'label'    => esc_html__( 'Crop featured images for the Grid Blog Layout', 'blogg' ),
		'section'  => 'blogg_section_thumbnails',
		'type'     => 'checkbox',
	) );	
	
}
add_action( 'customize_register', 'blogg_customize_register_thumbnail_settings' );
