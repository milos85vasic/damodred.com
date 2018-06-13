<?php
/**
 * Bloog Lite Custom Sidebar
 *
 * @package Bloog Lite
 */
 add_action('widgets_init','bloog_additional_widgets');
 
 function bloog_additional_widgets(){
    
    // Registering main right sidebar
	register_sidebar( array(
		'name' 				=> __( 'Right Sidebar', 'bloog-lite' ),
		'id' 					=> 'bloog_right_sidebar',
		'description'   	=> __( 'Shows widgets at Right side.', 'bloog-lite' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering header social icon widget
	register_sidebar( array(
		'name' 				=> __( 'Social Icon Header', 'bloog-lite' ),
		'id' 					=> 'social_icon_header',
		'description'   	=> __( 'Shows widgets at header social bar', 'bloog-lite' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering footer for layer 3
	register_sidebar( array(
		'name' 				=> __( 'Email Twitter Phone Section', 'bloog-lite' ),
		'id' 					=> 'email_twitter_phone_section',
		'description'   	=> __( 'Shows widgets before footer widget section', 'bloog-lite' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

    // Registering footer for layer 1
	register_sidebar( array(
		'name' 				=> __( 'Footer 1 (For layer one)', 'bloog-lite' ),
		'id' 					=> 'footer_one_sidebar',
		'description'   	=> __( 'Shows widgets at footer layer one', 'bloog-lite' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering footer for layer 1
	register_sidebar( array(
		'name' 				=> __( 'Footer 2 (For layer one)', 'bloog-lite' ),
		'id' 					=> 'footer_two_sidebar',
		'description'   	=> __( 'Shows widgets at footer layer one', 'bloog-lite' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );
    
    // Registering footer for layer 1
	register_sidebar( array(
		'name' 				=> __( 'Footer 3 (For layer one)', 'bloog-lite' ),
		'id' 					=> 'footer_three_sidebar',
		'description'   	=> __( 'Shows widgets at footer layer one', 'bloog-lite' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

    // Registering footer for layer 2
	register_sidebar( array(
		'name' 				=> __( 'Footer 4 (For layer two)', 'bloog-lite' ),
		'id' 					=> 'footer_four_sidebar',
		'description'   	=> __( 'Shows widgets at footer layer two', 'bloog-lite' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<div class="bloog-wrapper"><h3 class="widget-title"><span>',
		'after_title'   	=> '</span></div></h3>'
	) ); 
        
 } // END OF Bloog Lite REGISTER SIDEBAR FUNCTION

/**
 * Bloog Lite Custom Widgets
 *
 * @package Bloog Lite
 */

function bloog_lite_widgets_updated_field_value( $widget_field, $new_field_value ) {
    
	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $aglite_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
		
	// Allow some tags in textareas
	} elseif( $aglite_widgets_field_type == 'textarea' ) {
		// Check if field array specifed allowed tags
		if( !isset( $aglite_widgets_allowed_tags ) ) {
			// If not, fallback to default tags
			$aglite_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $aglite_widgets_allowed_tags );
		
	// No allowed tags for all other fields
	} else {
		return strip_tags( $new_field_value );
	}

}

/**
 * Include helper functions that display widget fields in the dashboard
 *
 * @since Bloog Lite Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-fields.php';

/**
 * Feature Page Preview Widget
 *
 * @since Bloog Lite Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-featurepage.php';

/**
 * Register Post Preview Widget
 *
 * @since Bloog Lite Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widgets-recentposts.php';

/**
 * Widget for twitter email and phone
 *
 * @since Bloog Lite Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-email-twitter-phone.php';