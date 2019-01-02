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
function blogg_customize_register_colour_settings( $wp_customize ) {


// Site Title Colour
 	$wp_customize->add_setting( 'blogg_sitetitle_colour', array(
		'default'        => '#161616',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogg_sitetitle_colour', array(
		'label'   => esc_html__( 'Site Title Colour', 'blogg' ),
		'section' => 'colors',
		'settings'   => 'blogg_sitetitle_colour',
	) ) );
	
// Site Title tagline
 	$wp_customize->add_setting( 'blogg_tagline_colour', array(
		'default'        => '#9a9a9a',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogg_tagline_colour', array(
		'label'   => esc_html__( 'Site Tagline Colour', 'blogg' ),
		'section' => 'colors',
		'settings'   => 'blogg_tagline_colour',
	) ) );		
			
// Primary Colour
 	$wp_customize->add_setting( 'blogg_first_colour', array(
		'default'        => '#ab7946',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogg_first_colour', array(
		'label'   => esc_html__( 'First Colour', 'blogg' ),
		'description'   => esc_html__( 'This is the orange colour.', 'blogg' ),
		'section' => 'colors',
		'settings'   => 'blogg_first_colour',
	) ) );		
	
// Secondary Colour
 	$wp_customize->add_setting( 'blogg_second_colour', array(
		'default'        => '#161616',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogg_second_colour', array(
		'label'   => esc_html__( 'Second Colour', 'blogg' ),
		'description'   => esc_html__( 'This is the dark grey colour.', 'blogg' ),
		'section' => 'colors',
		'settings'   => 'blogg_second_colour',
	) ) );		
	
// Third Colour
 	$wp_customize->add_setting( 'blogg_third_colour', array(
		'default'        => '#e6e6e6',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogg_third_colour', array(
		'label'   => esc_html__( 'Third Colour', 'blogg' ),
		'description'   => esc_html__( 'This is a very light grey colour; used mostly for borders and lines in the page.', 'blogg' ),
		'section' => 'colors',
		'settings'   => 'blogg_third_colour',
	) ) );	
		

}
add_action( 'customize_register', 'blogg_customize_register_colour_settings' );
