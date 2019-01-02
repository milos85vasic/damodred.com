<?php
/**
 * Basic Settings
 *
 * Register Basic Settings section, settings and controls for Theme Customizer
 *
 * @package Blogg
 */
 
/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function blogg_customize_register_upgrade_settings( $wp_customize ) {

// SECTION - UPGRADE
    $wp_customize->add_section( 'blogg_upgrade', array(
        'title'       => esc_html__( 'Upgrade to Pro', 'blogg' ),
        'priority'    => 0
    ) );
	
		$wp_customize->add_setting( 'blogg_upgrade_pro', array(
			'default' => '',
			'sanitize_callback' => '__return_false'
		) );
		
		$wp_customize->add_control( new Blogg_Customize_Static_Text_Control( $wp_customize, 'blogg_upgrade_pro', array(
			'label'	=> esc_html__('Get The Pro Version:','blogg'),
			'section'	=> 'blogg_upgrade',
			'description' => array('')
		) ) );	
		
}
add_action( 'customize_register', 'blogg_customize_register_upgrade_settings' );