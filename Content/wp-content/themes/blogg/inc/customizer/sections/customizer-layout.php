<?php
/**
 * Layout Settings
 *
 * Register Layout section, settings and controls for Theme Customizer
 *
 * @package Blogg
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_layout_settings( $wp_customize ) {


	// Add Section for Theme Options.
	$wp_customize->add_section( 'blogg_section_layout', array(
		'title'    => esc_html__( 'Layout Settings', 'blogg' ),
		'priority' => 10,
		'panel'    => 'blogg_options_panel',
	) );

	// Page Width
	$wp_customize->add_setting( 'blogg_page_width', array(
		'default'           => '2560',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_range',
	) );

	$wp_customize->add_control( 'blogg_page_width', array(
		'type'            => 'range',
		'section'         => 'blogg_section_layout',
		'label'           => esc_html__( 'Page Width', 'blogg' ),
		'description'     => esc_html__( 'Adjust the overall page width to give a boxed layout that shows the page background. Min width is 960px while the max width is 2560px.', 'blogg' ),
		'input_attrs' => array(
			'min'   => 960,
			'max'   => 2560,
			'step'  => 10,
			'style' => 'width: 100%',
		),
	) );	
	
	// Header  Width
	$wp_customize->add_setting( 'blogg_header_width', array(
		'default'           => '1120',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_range',
	) );

	$wp_customize->add_control( 'blogg_header_width', array(
		'type'            => 'range',
		'section'         => 'blogg_section_layout',
		'label'           => esc_html__( 'Header Width', 'blogg' ),
		'description'     => esc_html__( 'Adjust the width of the top header area. This only gets applied in desktop viewing. Min width is 960px while the max width is 2560px.', 'blogg' ),
		'input_attrs' => array(
			'min'   => 960,
			'max'   => 2560,
			'step'  => 10,
			'style' => 'width: 100%',
		),
	) );	
		
}
add_action( 'customize_register', 'blogg_customize_register_layout_settings' );