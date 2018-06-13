<?php
/**
 * Plugin Name: Pinterest Pin It Button On Image Hover And After Post & Page Content
 * Version: 2.5
 * Description: Pin Your WordPress Blog Posts Pages Images With Pinterest
 * Author: Weblizar
 * Author URI: http://weblizar.com/plugins/
 * Plugin URI: http://weblizar.com/plugins/pinterest-pin-it-button/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 */

/**
 * Constant Values & Variables
 */
define("WEBLIZAR_PINIT_PLUGIN_URL", plugin_dir_url(__FILE__));
define("WEBLIZAR_PINIT_TD", "weblizar_pinit");

/**
 * Get Ready Plugin Translation
 */
add_action('plugins_loaded', 'PINITTranslation');
function PINITTranslation() {
	load_plugin_textdomain( WEBLIZAR_PINIT_TD, FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

/**
 * Default Setting
 */
register_activation_hook( __FILE__, 'PiniIt_DefaultSettings' );
function PiniIt_DefaultSettings(){
    add_option("WL_Enable_Pinit_Post", 1);
    add_option("WL_Enable_Pinit_Page", 1);
	add_option("WL_Pinit_Btn_On_Hover", "true");
	add_option("WL_Mobile_Status", 1);
	add_option("WL_Pinit_Btn_Color", "red");
	add_option("WL_Pinit_Btn_Design", "rectangle");
	add_option("WL_Pinit_Btn_Size", "small");	
}

//Load saved pin it button settings
$PinItOnHover 	= get_option("WL_Pinit_Btn_On_Hover");

//Show Pin It Button On Image Hover
if($PinItOnHover == "true"){
	// Add hook for frontend <head></head>
	add_action('wp_head', 'wl_pinit_js');
}
function wl_pinit_js() {
	$PinItOnHover 	= get_option("WL_Pinit_Btn_On_Hover");
	$PinItColor		= get_option("WL_Pinit_Btn_Color");
	$PinItSize		= get_option("WL_Pinit_Btn_Size");
	$PinItStatus 	= get_option("WL_Mobile_Status");
	
	//don't show on mobile
	if(wp_is_mobile() && $PinItStatus == 0) {
		// do nothing
	} else {
		?><script type="text/javascript" async defer data-pin-color="<?php echo $PinItColor; ?>" <?php if($PinItSize == "large") { ?>data-pin-height="28"<?php }?> data-pin-hover="<?php echo $PinItOnHover; ?>" src="<?php echo WEBLIZAR_PINIT_PLUGIN_URL."js/pinit.js"; ?>"></script><?php
	}
}

//Add Pin It Button After Post Content
function Load_pin_it_button_after_post_content($content){
	if (is_single() && get_post_type( $post = get_post() ) == "post") {
		//check for enable post pin it button
		$PinItPost 		= get_option("WL_Enable_Pinit_Post");
		$PinItStatus 	= get_option("WL_Mobile_Status");
		if(get_option("WL_Enable_Pinit_Post")) {
			if(wp_is_mobile() && $PinItStatus == 0) {
				// do nothing //don't show on mobile
			} else {
				$content .= '<p><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red" data-pin-height="128"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_28.png" /></a></p>';
			}
		}	
	}
	return $content;
}
add_filter( "the_content", "Load_pin_it_button_after_post_content" );


//Add Pin It Button After Page Content
function Load_pin_it_button_after_page_content($content){
	if (!is_single()  && get_post_type( $post = get_post() ) == "page") {
		//check for enable page pin it button
		$PinItPage 		= get_option("WL_Enable_Pinit_Page");
		$PinItStatus 	= get_option("WL_Mobile_Status");
		if(get_option("WL_Enable_Pinit_Page")) {
			if(wp_is_mobile() && $PinItStatus == 0) {
				// do nothing //don't show on mobile
			} else {
				$content .= '<p><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-color="red" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_28.png" /></a></p>';
			}
		}
	}
	return $content;
}
add_filter( "the_content", "Load_pin_it_button_after_page_content" );

//Plugin Settings Admin Menu
add_action('admin_menu','WL_PinItButtonPage');

function WL_PinItButtonPage() {
    $PinItAdminMenu = add_menu_page( 'Pinterest PinIt Button Settings', 'Pinterest PinIt Button', 'administrator', 'pinterest-pinit-button-on-hover', 'pinterest_pinit_button_settings_page', 'dashicons-admin-post');
    add_action( 'admin_print_styles-' . $PinItAdminMenu, 'PiniIt_Menu_Assets' );
}

//Load PinItAdminMenu Pages Assets JS/CSS/Images
function PiniIt_Menu_Assets() {
	if(is_admin()) {
		wp_enqueue_style('bootstrap_css', WEBLIZAR_PINIT_PLUGIN_URL.'css/bootstrap.css');
		wp_enqueue_style('weblizar-smartech-css', WEBLIZAR_PINIT_PLUGIN_URL.'css/weblizar-smartech.css');
		wp_enqueue_style('weblizar-recom', WEBLIZAR_PINIT_PLUGIN_URL.'css/recom.css');
		wp_enqueue_style('font-awesome_min', WEBLIZAR_PINIT_PLUGIN_URL.'font-awesome/css/font-awesome.min.css');
		wp_enqueue_style('font-animate', WEBLIZAR_PINIT_PLUGIN_URL.'css/animate.css');
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap-min-js',WEBLIZAR_PINIT_PLUGIN_URL.'js/bootstrap.min.js');
		wp_enqueue_script('weblizar-smartech-js',WEBLIZAR_PINIT_PLUGIN_URL.'js/weblizar-smartech.js',array('jquery'));
	}
}

function pinterest_pinit_button_settings_page() {
	require_once("template.php");
}

//Save Plugin Settings
add_action( 'wp_ajax_save_pinit', 'PinItSaveSettings' );
function PinItSaveSettings() {
	$PinItPost 		= sanitize_text_field($_POST['PinItPost']);
	$PinItPage	 	= sanitize_text_field($_POST['PinItPage']);
	$PinItOnHover	= sanitize_text_field($_POST['PinItOnHover']);
	$PinItStatus 	= sanitize_text_field($_POST['PinItStatus']);
	$PinItDesign 	= sanitize_text_field($_POST['PinItDesign']);
	$PinItColor 	= sanitize_text_field($_POST['PinItColor']);
	$PinItSize 		= sanitize_text_field($_POST['PinItSize']);
	
	update_option('WL_Enable_Pinit_Post', $PinItPost);
	update_option('WL_Enable_Pinit_Page', $PinItPage);
	update_option('WL_Pinit_Btn_On_Hover', $PinItOnHover);
	update_option('WL_Mobile_Status', $PinItStatus);
	update_option('WL_Pinit_Btn_Design', $PinItDesign);
	update_option('WL_Pinit_Btn_Color', $PinItColor);
	update_option('WL_Pinit_Btn_Size', $PinItSize);
} ?>