<?php
/**
 * Blog Settings
 *
 * Register Blog Settings section, settings and controls for Theme Customizer
 *
 * @package Blogg
 */

/**
 * Adds blog settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_blog_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'blogg_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'blogg' ),
		'priority' => 30,
		'panel' => 'blogg_options_panel',
	) );
	
	// Add Customize Archive Title Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_post_archive_title_option', array(
			'label' => esc_html__( 'Customize Archive Titles', 'blogg' ),
			'section' => 'blogg_section_blog',
			'settings' => array(),
		)
	) );	
	// show hide archive heading labels
	$wp_customize->add_setting( 'blogg_show_archive_labels',	array(
		'default' => true,
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'blogg_show_archive_labels', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show or hide the archive heading labels like Category:  or Tags: that show just before the names. Default is enabled to hide the label.', 'blogg' ),
		'section'  => 'blogg_section_blog',
	) );	

	// Add Settings and Controls for blog layout.
	$wp_customize->add_setting( 'blogg_blog_layout', array(
		'default'           => 'default',
		'sanitize_callback' => 'blogg_sanitize_select',
	) );

	$wp_customize->add_control( 'blogg_blog_layout', array(
		'label'    => esc_html__( 'Blog Layout', 'blogg' ),
		'section'  => 'blogg_section_blog',
		'settings' => 'blogg_blog_layout',
		'type'     => 'select',
		'choices'  => array(
			'default' => esc_html__( 'Default Right Sidebar', 'blogg' ),
			'default-left'  => esc_html__( 'Default Left Sidebar', 'blogg' ),
			'grid'  => esc_html__( 'Grid Full Width', 'blogg' ),
		),
	) );
	
	// Add Settings and Controls for blog content.
	$wp_customize->add_setting( 'blogg_blog_content', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_blog_content', array(
		'label'    => esc_html__( 'Blog Excerpts', 'blogg' ),
		'description' => esc_html__( 'This will let you choose to use excerpts for your blog summaries. This is for the Large and Standard default blog layouts.', 'blogg' ), 
		'section'  => 'blogg_section_blog',
		'type'     => 'checkbox',
	) );		

	// Add Setting and Control for Excerpt Length.
	$wp_customize->add_setting( 'blogg_excerpt_length', array(
		'default'           => 35,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'blogg_excerpt_length', array(
		'label'    => esc_html__( 'Excerpt Length', 'blogg' ),
		'section'  => 'blogg_section_blog',
		'type'     => 'number',
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 1,
        ),		
	) );

	// Add Partial for Blog Layout and Excerpt Length.
	$wp_customize->selective_refresh->add_partial( 'blogg_blog_content_partial', array(
		'selector'         => '.site-main',
		'settings'         => array(
			'blogg_blog_layout',
			'blogg_blog_content',
			'blogg_excerpt_length',
		),
		'render_callback'  => 'blogg_customize_partial_blog_content',
		'fallback_refresh' => false,
	) );

}
add_action( 'customize_register', 'blogg_customize_register_blog_settings' );

/**
 * Render the blog title for the selective refresh partial.
 */
function blogg_customize_partial_blog_title() {
	echo wp_kses_post( get_theme_mod('blogg_blog_title' )  );
}

/**
 * Render the blog description for the selective refresh partial.
 */
function blogg_customize_partial_blog_description() {
	echo wp_kses_post( get_theme_mod( 'blogg_blog_description' ) );
}

/**
 * Render the blog content for the selective refresh partial.
 */
function blogg_customize_partial_blog_content() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/posts/content', get_post_format() );
	}
}
