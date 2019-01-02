<?php
/**
 * Featured Settings
 *
 * Register Featured section, settings and controls for Theme Customizer
 *
 * @package Blogg
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_featured_settings( $wp_customize ) {

/**
 * Function to list Custom Post Type
*/
if( ! function_exists( 'blogg_get_posts' ) ) :
function blogg_get_posts( $post_type = 'post' ){
    
    $args = array(
    	'posts_per_page'   => -1,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'blogg' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            $post_options[ $posts->ID ] = $posts->post_title;
        }
    }
    return $post_options;
    wp_reset_postdata();
}
endif;


	// Add Sections for Post Settings.
	$wp_customize->add_section( 'blogg_section_featured', array(
		'title'    => esc_html__( 'Featured Box Settings', 'blogg' ),
		'priority' => 40,
		'panel' => 'blogg_options_panel',
	) );
	
 	// Add Setting and Control for enabling the featured boxes
	$wp_customize->add_setting( 'blogg_display_featured_boxes', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'blogg_display_featured_boxes', array(
		'label'    => esc_html__( 'Display Featured Boxes', 'blogg' ),
		'section'  => 'blogg_section_featured',
		'type'     => 'checkbox',
	) );
	
    /** Featured Content One */
    $wp_customize->add_setting( 'featured_content_one',	array(
			'default'			=> '',
			'sanitize_callback' => 'blogg_sanitize_select'
		)
	);

	$wp_customize->add_control( 'featured_content_one', array(
                'label'	  => esc_html__( 'Featured Content One', 'blogg' ),
    			'section' => 'blogg_section_featured',
				'type' => 'select',
    			'choices' => blogg_get_posts( 'page' ),	
     		)
	);
    
    /** Featured Content Two */
    $wp_customize->add_setting( 'featured_content_two', array(
			'default'			=> '',
			'sanitize_callback' => 'blogg_sanitize_select'
		)
	);

	$wp_customize->add_control( 'featured_content_two', array(
                'label'	  => esc_html__( 'Featured Content Two', 'blogg' ),
    			'section' => 'blogg_section_featured',
				'type' => 'select',
    			'choices' => blogg_get_posts( 'page' ),	
     		)
	);
    
    /** Featured Content Three */
    $wp_customize->add_setting( 'featured_content_three', array(
			'default'			=> '',
			'sanitize_callback' => 'blogg_sanitize_select'
		)
	);

	$wp_customize->add_control( 'featured_content_three', array(
                'label'	  => esc_html__( 'Featured Content Three', 'blogg' ),
    			'section' => 'blogg_section_featured',
				'type' => 'select',
    			'choices' => blogg_get_posts( 'page' ),	
     		)
	);

	// Featured Box section Width
	$wp_customize->add_setting( 'blogg_featured_boxes_width', array(
		'default'           => '2560',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blogg_sanitize_range',
	) );

	$wp_customize->add_control( 'blogg_featured_boxes_width', array(
		'type'            => 'range',
		'section'         => 'blogg_section_featured',
		'label'           => esc_html__( 'Featured Box Section Width', 'blogg' ),
		'description'     => esc_html__( 'Adjust the featured box section to the width you want. Min width is 960px while the max width is 2560px.', 'blogg' ),
		'input_attrs' => array(
			'min'   => 960,
			'max'   => 2560,
			'step'  => 10,
			'style' => 'width: 100%',
		),
	) );		
	
}
add_action( 'customize_register', 'blogg_customize_register_featured_settings' );