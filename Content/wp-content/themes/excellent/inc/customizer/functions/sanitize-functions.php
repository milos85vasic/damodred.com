<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
/********************* EXCELLENT CUSTOMIZER SANITIZE FUNCTIONS *******************************/
function excellent_checkbox_integer( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}
function excellent_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}
function excellent_sanitize_latest_from_blog_select($input) {
	
	$input = sanitize_key( $input );
	return ( ( isset( $input ) && true == $input ) ? $input : '' );

}

function excellent_numeric_value( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}
function excellent_sanitize_page( $input ) {
	if(  get_post( $input ) ){
		return $input;
	}
	else {
		return '';
	}
}
function excellent_reset_alls( $input ) {
	if ( $input == 1 ) {
		delete_option( 'excellent_theme_options');
		$input=0;
		return absint($input);
	} 
	else {
		return '';
	}
}