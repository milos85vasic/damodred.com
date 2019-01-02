<?php 
/**
 * Register theme sidebars
 * @package Blogg
*/
  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function blogg_widgets_init() {
	
	register_sidebar( array(
		'name' => esc_html__( 'Blog Sidebar', 'blogg' ),
		'id' => 'blog-sidebar',
		'description' => esc_html__( 'Sidebar for your blog and archives.', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Page Right Sidebar', 'blogg' ),
		'id' => 'right-sidebar',
		'description' => esc_html__( 'Right sidebar for your pages.', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Page Left Sidebar', 'blogg' ),
		'id' => 'left-sidebar',
		'description' => esc_html__( 'Left sidebar for your pages.', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Banner', 'blogg' ),
		'id' => 'banner',
		'description' => esc_html__( 'For Images and Sliders.', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Top', 'blogg' ),
		'id' => 'top',
		'description' => esc_html__( 'Provide attention getting content to get user action.', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );		
	
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 1', 'blogg' ),
		'id' => 'cbottom1',
		'description' => esc_html__( 'Content Bottom 1 position', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 2', 'blogg' ),
		'id' => 'cbottom2',
		'description' => esc_html__( 'Content Bottom 2 position', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 3', 'blogg' ),
		'id' => 'cbottom3',
		'description' => esc_html__( 'Content Bottom 3 position', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom 4', 'blogg' ),
		'id' => 'cbottom4',
		'description' => esc_html__( 'Content Bottom 4 position', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );		
	
	register_sidebar( array(
		'name' => esc_html__( 'Bottom', 'blogg' ),
		'id' => 'bottom',
		'description' => esc_html__( 'Bottom position. Many use this to load a set of instagram photos or even newsletter sign-ups.', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Breadcrumbs', 'blogg' ),
		'id' => 'breadcrumbs',
		'description' => esc_html__( 'For adding breadcrumb navigation if using a plugin, or you can add content here.', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );	
	
	register_sidebar( array(
		'name' => esc_html__( 'Footer', 'blogg' ),
		'id' => 'footer',
		'description' => esc_html__( 'Footer position', 'blogg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );	
	
	// Register recent posts widget
	register_widget( 'Blogg_Recent_Posts_Widget' );
	
}
add_action( 'widgets_init', 'blogg_widgets_init' );


// Count the number of widgets to enable resizable widgets in the content top group.
function blogg_cbottom_group() {
	$count = 0;
	if ( is_active_sidebar( 'cbottom1' ) )
		$count++;
	if ( is_active_sidebar( 'cbottom2' ) )
		$count++;
	if ( is_active_sidebar( 'cbottom3' ) )
		$count++;		
	if ( is_active_sidebar( 'cbottom4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
		case '2':
			$class = 'col-lg-6';
			break;
		case '3':
			$class = 'col-lg-4';
			break;
		case '4':
			$class = 'col-sm-12 col-md-6 col-lg-3';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}