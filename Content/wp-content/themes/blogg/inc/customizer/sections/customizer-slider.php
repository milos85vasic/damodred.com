<?php
/**
 * Slider Settings
 *
 * Register Slider section, settings and controls for Theme Customizer
 *
 * @package Blogg
 */

/**
 * Adds all slider settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_slider_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'blogg_section_slider', array(
		'title'    => esc_html__( 'Slider Settings', 'blogg' ),
		'priority' => 55,
		'panel'    => 'blogg_options_panel',
	) );


	// Add Show Slider Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_theme_options[display_slider_option]', array(
			'label' => esc_html__( 'Display Slider', 'blogg' ),
			'section' => 'blogg_section_slider',
			'settings' => array(),
		)
	) );

	// Display Slider
	$wp_customize->add_setting( 'blogg_display_slider', array(
		'default'           => false,
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_display_slider', array(
		'label'    => esc_html__( 'Display the Slider', 'blogg' ),
		'section'  => 'blogg_section_slider',
		'type'     => 'checkbox',
	) );		

	
	
	// Slider category
	$wp_customize->add_setting( 'blogg_slider_cat', array(
		'default' => '',
		'sanitize_callback' => 'blogg_sanitize_slidecat',
	) );

	$wp_customize->add_control( 'blogg_slider_cat', array(
		'type' => 'select',
		'label' => esc_html__( 'Choose a category', 'blogg' ),
		'description' => esc_html__( 'Choose your category to load slides from. Make sure your posts have featured images and we recommend also that you create a special category just for featured slide posts.', 'blogg' ),
		'choices' => blogg_slide_cats(),
		'section' => 'blogg_section_slider',
	) );	
	
	
    /** No. of slides */
    $wp_customize->add_setting( 'blogg_slide_count', array(
            'default'           => 3,
            'sanitize_callback' => 'absint'
        ) );
    
    $wp_customize->add_control( 'blogg_slide_count', array(
            'type'        => 'number',
            'section'     => 'blogg_section_slider',
            'label'       => esc_html__( 'Number of Slides', 'blogg' ),
            'description' => esc_html__( 'Choose the number of slides you want to display when showing the Latest Posts option.', 'blogg' ),
            'input_attrs' => array(
				'min'   => 1,
				'max'   => 8,
				'step'  => 1,
            ),
        )
    );	


	// Slide excerpt size
	$wp_customize->add_setting( 'blogg_slide_excerpt_size', array(
		'default' => 10,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'blogg_slide_excerpt_size', array(
		'type' => 'number',
		'label' => esc_html__( 'Slider Excerpt Size', 'blogg' ),
		'description' => esc_html__( 'This lets you choose how many words to show in your slide excerpt from 4 to 20 words. Default is 10.', 'blogg' ),
		'section' => 'blogg_section_slider',
		'input_attrs' => array(
				'min' => 4, // Required. Minimum value for the slider
				'max' => 20, // Required. Maximum value for the slider
				'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
		),
	) );
	
	// Add Slide Element Headline.
	$wp_customize->add_control( new Blogg_Customize_Header_Control(
		$wp_customize, 'blogg_theme_options[display_slider_elements]', array(
			'label' => esc_html__( 'Display Slider Elements', 'blogg' ),
			'section' => 'blogg_section_slider',
			'settings' => array(),
		)
	) );

	// Display slide excerpt
	$wp_customize->add_setting( 'blogg_display_slide_excerpt', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_display_slide_excerpt', array(
		'label'    => esc_html__( 'Display the Slide Excerpt', 'blogg' ),
		'section'  => 'blogg_section_slider',
		'type'     => 'checkbox',
	) );	

	
	// Display Slide read more
	$wp_customize->add_setting( 'blogg_display_slide_readmore', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_display_slide_readmore', array(
		'label'    => esc_html__( 'Display the Slide Read More', 'blogg' ),
		'section'  => 'blogg_section_slider',
		'type'     => 'checkbox',
	) );	
	
	

}
add_action( 'customize_register', 'blogg_customize_register_slider_settings' );



/**
 * Function to list post categories in customizer options
 * This loads categories for our slider dropdown select
 */
function blogg_slide_cats() {
	$cats = array();
	$cats[0] = 'All';

	foreach ( get_categories() as $categories => $category ) {
		$cats[ $category->term_id ] = $category->name;
	}
	return $cats;
}