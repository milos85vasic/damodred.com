<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.1
 */
/********************* Color Option **********************************************/
	$wp_customize->add_section( 'colors', array(
		'title' 						=> __('Color Options','excellent'),
		'priority'					=> 90,
		'panel'					=>'colors'
	));
	$color_scheme = excellent_get_color_scheme();
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default_color',
		'sanitize_callback' => 'excellent_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'description'    => __( 'Select Color Style', 'excellent' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => excellent_get_color_scheme_choices(),
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'site_page_nav_link_title_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_page_nav_link_title_color', array(
		'description'       => __( 'Nav, links and Hover', 'excellent' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'excellent_button_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'excellent_button_color', array(
		'description'       => __( 'Default Buttons, Testimonial and Submit', 'excellent' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'excellent_feature_box_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'excellent_feature_box_color', array(
		'description'       => __( 'Our Feature Big letter and link', 'excellent' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'excellent_bbpress_woocommerce_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'excellent_bbpress_woocommerce_color', array(
		'description'       => __( 'WooCommerce/ bbPress', 'excellent' ),
		'section'     => 'colors',
	) ) );