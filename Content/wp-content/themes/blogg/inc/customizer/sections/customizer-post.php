<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Blogg
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'blogg_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'blogg' ),
		'priority' => 40,
		'panel' => 'blogg_options_panel',
	) );
	
	// Add Post Layout Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_post_layout_option', array(
			'label' => esc_html__( 'Post Layout', 'blogg' ),
			'section' => 'blogg_section_post',
			'settings' => array(),
		)
	) );

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting( 'blogg_single_layout', array(
		'default'           => 'single-right',
		'sanitize_callback' => 'blogg_sanitize_select',
	) );

	$wp_customize->add_control( 'blogg_single_layout', array(
		'label'    => esc_html__( 'Sidebar Position', 'blogg' ),
		'description' => esc_html__( 'This will let you choose your full post layout.', 'blogg' ), 
		'section'  => 'blogg_section_post',
		'type'     => 'radio',
		'choices'  => array(
			'default' => esc_html__( 'Post No Sidebar', 'blogg' ),
			'single-left'  => esc_html__( 'Post Left Sidebar', 'blogg' ),
			'single-right' => esc_html__( 'Post Right Sidebar', 'blogg' ),		
		),
	) );		
	
	// Add Single Post Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_theme_options[single_post]', array(
			'label' => esc_html__( 'Single Post', 'blogg' ),
			'section' => 'blogg_section_post',
			'settings' => array(),
		)
	) );
	
	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'blogg_meta_category', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_meta_category', array(
		'label'    => esc_html__( 'Display categories', 'blogg' ),
		'section'  => 'blogg_section_post',
		'type'     => 'checkbox',
	) );
	
	// Add Setting and Control for showing post full meta info
	$wp_customize->add_setting( 'blogg_meta_info', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_meta_info', array(
		'label'    => esc_html__( 'Display All Meta Info', 'blogg' ),
		'section'  => 'blogg_section_post',
		'type'     => 'checkbox',
	) );	

	// Add Setting and Control for showing author avatar
	$wp_customize->add_setting( 'blogg_display_author_avatar', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_display_author_avatar', array(
		'label'    => esc_html__( 'Display Author Avatar', 'blogg' ),
		'section'  => 'blogg_section_post',
		'type'     => 'checkbox',
	) );
	
	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting( 'blogg_meta_tags', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_meta_tags', array(
		'label'    => esc_html__( 'Display tags', 'blogg' ),
		'section'  => 'blogg_section_post',
		'type'     => 'checkbox',
	) );
		
	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting( 'blogg_post_navigation', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_post_navigation', array(
		'label'    => esc_html__( 'Display previous/next post navigation', 'blogg' ),
		'section'  => 'blogg_section_post',
		'type'     => 'checkbox',
	) );	

}
add_action( 'customize_register', 'blogg_customize_register_post_settings' );


/**
 * Render single posts partial
 */
function blogg_customize_partial_single_post() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/posts/content', 'single' );
	}
}
