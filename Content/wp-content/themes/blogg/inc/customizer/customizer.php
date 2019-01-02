<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Blogg
 */

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel.
	$wp_customize->add_panel( 'blogg_options_panel', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'blogg' ),
	) );

	// Change default background section.
	$wp_customize->get_control( 'background_color' )->section   = 'background_image';
	$wp_customize->get_section( 'background_image' )->title     = esc_html__( 'Page Background', 'blogg' );

	// Add postMessage support for site title and description so we can preview changes instantly.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Add selective refresh for site title and description.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title',
		'render_callback' => 'blogg_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'blogg_customize_partial_blogdescription',
	) );
		
	// Add Show Site Title Setting.
	$wp_customize->add_setting( 'blogg_show_site_title', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_show_site_title', array(
		'label'    => esc_html__( 'Show Site Title', 'blogg' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
	) );

	// Add Hide Tagline Setting.
	$wp_customize->add_setting( 'blogg_show_site_description', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_show_site_description', array(
		'label'    => esc_html__( 'Show Tagline', 'blogg' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
	) );
	
}
add_action( 'customize_register', 'blogg_customize_register_options' );


/**
 * Render the blog title for the selective refresh partial.
 */
function blogg_customize_partial_logo_letter() {
	echo wp_kses_post( get_theme_mod('blogg_logo_letter' )  );
}

/**
 * Render the site title for the selective refresh partial.
 */
function blogg_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function blogg_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function blogg_customize_preview_js() {
	wp_enqueue_script( 'blogg-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20180609', true );
}
add_action( 'customize_preview_init', 'blogg_customize_preview_js' );

/**
 * Embed JS for Customizer Controls.
 */
function blogg_customizer_controls_js() {
	wp_enqueue_script( 'blogg-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '20180609', true );
}
add_action( 'customize_controls_enqueue_scripts', 'blogg_customizer_controls_js' );

/**
 * Embed CSS styles Customizer Controls.
 */
function blogg_customizer_controls_css() {
	wp_enqueue_style( 'blogg-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '20180609' );
}
add_action( 'customize_controls_print_styles', 'blogg_customizer_controls_css' );
