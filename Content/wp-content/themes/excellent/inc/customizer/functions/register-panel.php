<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
/******************** EXCELLENT CUSTOMIZE REGISTER *********************************************/
add_action( 'customize_register', 'excellent_customize_register_wordpress_default' );
function excellent_customize_register_wordpress_default( $wp_customize ) {
	$wp_customize->add_panel( 'excellent_wordpress_default_panel', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'WordPress Settings', 'excellent' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'excellent_customize_register_options');
function excellent_customize_register_options( $wp_customize ) {
	$wp_customize->add_panel( 'excellent_options_panel', array(
		'priority' => 6,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options', 'excellent' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'excellent_customize_register_frontpage_options');
function excellent_customize_register_frontpage_options( $wp_customize ) {
	$wp_customize->add_panel( 'excellent_frontpage_panel', array(
		'priority' => 7,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Frontpage Template', 'excellent' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'excellent_customize_register_featuredcontent' );
function excellent_customize_register_featuredcontent( $wp_customize ) {
	$wp_customize->add_panel( 'excellent_featuredcontent_panel', array(
		'priority' => 8,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Slider Options', 'excellent' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'excellent_customize_register_widgets' );
function excellent_customize_register_widgets( $wp_customize ) {
	$wp_customize->add_panel( 'widgets', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Widgets', 'excellent' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'excellent_customize_register_colors' );
function excellent_customize_register_colors( $wp_customize ) {
	$wp_customize->add_panel( 'colors', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Colors Section', 'excellent' ),
		'description' => '',
	) );
}