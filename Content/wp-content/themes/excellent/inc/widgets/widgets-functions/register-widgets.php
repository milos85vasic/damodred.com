<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
/**************** EXCELLENT REGISTER WIDGETS ***************************************/
add_action('widgets_init', 'excellent_widgets_init');
function excellent_widgets_init() {

	register_sidebar(array(
			'name' => __('Main Sidebar', 'excellent'),
			'id' => 'excellent_main_sidebar',
			'description' => __('Shows widgets at Main Sidebar.', 'excellent'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('Top Header Info', 'excellent'),
			'id' => 'excellent_header_info',
			'description' => __('Shows widgets on all page.', 'excellent'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Contact Page Sidebar', 'excellent'),
			'id' => 'excellent_contact_page_sidebar',
			'description' => __('Shows widgets on Contact Page Template.', 'excellent'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Iframe Code For Google Maps', 'excellent'),
			'id' => 'excellent_form_for_contact_page',
			'description' => __('Add Iframe Code using text widgets', 'excellent'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('WooCommerce Sidebar', 'excellent'),
			'id' => 'excellent_woocommerce_sidebar',
			'description' => __('Add WooCommerce Widgets Only', 'excellent'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	$excellent_settings = excellent_get_theme_options();
	for($i =1; $i<= $excellent_settings['excellent_footer_column_section']; $i++){
	register_sidebar(array(
			'name' => __('Footer Column ', 'excellent') . $i,
			'id' => 'excellent_footer_'.$i,
			'description' => __('Shows widgets at Footer Column ', 'excellent').$i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
}