<?php
/**
 * Sanitize Functions
 *
 * Used to validate the user input of the theme settings
 * Based on https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @package Blogg
 */

// Text Area
 function blogg_sanitize_textarea($input){
	return wp_kses_post( $input );
}

// Strip Slashes
	function blogg_sanitize_strip_slashes($input) {
		return wp_kses_stripslashes($input);
	}	

// Sanitize range slider
function blogg_sanitize_range( $input ) {
	filter_var( $input, FILTER_FLAG_ALLOW_FRACTION );
	return ( $input );
}

// Adds sanitization callback function: Slider Category
function blogg_sanitize_slidecat( $input ) {
	if ( array_key_exists( $input, blogg_slide_cats() ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Checkbox sanitization callback example.
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked` as a boolean value, either TRUE or FALSE.
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function blogg_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
	
/**
 * Select & Radio Button sanitization callback
 * @param String  $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function blogg_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
