<?php
/**
 * Widgets
 *
 * @package juliet
 */
?>
<?php

function juliet_widgets_init() {
    
    /* Sidebar Widgets */
    
    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar - Default', 'juliet' ),
		'id'            => 'sidebar-default',
		'before_widget' => '<div id="%1$s" class="default-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar - Front Page', 'juliet' ),
		'id'            => 'sidebar-frontpage',
		'before_widget' => '<div id="%1$s" class="frontpage-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar - Post', 'juliet' ),
		'id'            => 'sidebar-single',
		'before_widget' => '<div id="%1$s" class="single-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar - Page', 'juliet' ),
		'id'            => 'sidebar-page',
		'before_widget' => '<div id="%1$s" class="page-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    
    /* Header Widgets */
    
	register_sidebar( array(
		'name'          => esc_html__( 'Header - Left', 'juliet' ),
		'id'            => 'header-row-1-left',
		'description'   => esc_html__( 'Add widgets here to appear in the top left area.', 'juliet' ),
		'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="header-widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Header - Right', 'juliet' ),
		'id'            => 'header-row-1-right',
		'description'   => esc_html__( 'Add widgets here to appear in the top right area.', 'juliet' ),
		'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="header-widget-title">',
		'after_title'   => '</h3>',
	) );
    
    /* Footer Widgets */

    register_sidebar( array(
		'name'          => esc_html__( 'Footer - Col 1', 'juliet' ),
		'id'            => 'footer-row-1-col-1',
		'before_widget' => '<div id="%1$s" class="footer-row-1-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Footer - Col 2', 'juliet' ),
		'id'            => 'footer-row-1-col-2',
		'before_widget' => '<div id="%1$s" class="footer-row-1-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Footer - Col 3', 'juliet' ),
		'id'            => 'footer-row-1-col-3',
		'before_widget' => '<div id="%1$s" class="footer-row-1-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Footer - Col 4', 'juliet' ),
		'id'            => 'footer-row-1-col-4',
		'before_widget' => '<div id="%1$s" class="footer-row-1-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer - Last', 'juliet' ),
		'id'            => 'footer-row-2-center',
		'before_widget' => '<div id="%1$s" class="footer-row-2-center-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    /* Off Canvas Menu */
    register_sidebar( array(
		'name'          => esc_html__( 'Off Canvas Menu', 'juliet' ),
		'id'            => 'sidebar-offcanvas',
		'before_widget' => '<div id="%1$s" class="offcanvas-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="ad-widget-title">',
		'after_title'   => '</h3>',
	) );
    
}
add_action( 'widgets_init', 'juliet_widgets_init' );

?>