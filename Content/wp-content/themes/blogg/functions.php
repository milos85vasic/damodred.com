<?php
/**
 * Blogg functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Blogg only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'blogg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 * Note that this function is hooked into the after_setup_theme hook, which runs before the init hook. 
	 * The init hook is too late for some features, such as indicating support for post thumbnails.
	 */
	function blogg_setup() {
		
		// Set the default content width.
		$GLOBALS['content_width'] = 1120;
		
		// Make theme available for translation.
		load_theme_textdomain( 'blogg', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Classic editor styles
		add_editor_style( array( 'assets/css/editor-style.css', blogg_fonts_url() ) );
		
		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		
		// Recent Posts widget thumbnail
		add_image_size( 'blogg-recent-thumbnail', 110, 95, true );
		
		// Enable support for the standard post thumbnail crop
		if( esc_attr(get_theme_mod( 'blogg_crop_standard_featured', false ) ) ) {
			add_image_size( 'blogg-standard-thumbnail', 730, 400, true );
		}	
		// Enable support for grid blog post thumbnail crop
		if( esc_attr(get_theme_mod( 'blogg_crop_grid_featured', false ) ) ) {
			add_image_size( 'blogg-grid-thumbnail', 550, 370, true );
		}
		// Enable support for the slider thumbnail 
		if( esc_attr(get_theme_mod( 'blogg_display_slider', false ) ) ) {
			add_image_size( 'blogg-slide-thumbnail', 1920, 700, true );
		}		
		
		// Enable support for the featured box thumbnail 
		if( esc_attr(get_theme_mod( 'blogg_display_featured_boxes', false ) ) ) {
			add_image_size( 'blogg-featured-box', 430, 300, true );
		}
		
		// Add excerpt support to pages
		add_post_type_support( 'page', 'excerpt' );
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'blogg' ),
			'social'  => esc_html__( 'Social Icon Menu', 'blogg' ),
			'footer'  => esc_html__( 'Footer Menu', 'blogg' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blogg_custom_background_args', array(
			'default-color' => 'f2f2f2',
			'default-image' => '',
		) ) );
	
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	
	}
endif;
add_action( 'after_setup_theme', 'blogg_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
function blogg_content_width() {
	$content_width = $GLOBALS['content_width'];
	// Check if the page has a sidebar.
	if ( is_active_sidebar( 'left-sidebar'  ) || is_active_sidebar( 'right-sidebar' ) || is_active_sidebar( 'blog-sidebar' ) ) {
		$content_width = 720;
	}	
  $GLOBALS['content_width'] = apply_filters( 'blogg_content_width', $content_width );
}
add_action( 'template_redirect', 'blogg_content_width', 0 );

/**
 * Enqueue admin scripts and styles
 */
function blogg_admin_scripts( $hook ) {
	if ( 'post.php' != $hook ) {
        return;
	}
	
/**
* Load editor fonts from Google
*/
wp_enqueue_style( 'blogg-admin-fonts', blogg_fonts_url(), array(), null );
}
add_action( 'admin_enqueue_scripts', 'blogg_admin_scripts', 5 );


/**
 * Register Google fonts
 * You can disable from the customizer if you want different fonts.
 * @return string Google fonts URL for the theme.
 */
	 
if ( ! function_exists( 'blogg_fonts_url' ) ) :

	function blogg_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Abril Fatface, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Lato font: on or off', 'blogg' ) ) {
			$fonts[] = 'Lato:300,400,700,700i,900,900i';
		}

		/* translators: If there are characters in your language that are not supported by Molle, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Molle font: on or off', 'blogg' ) ) {
			$fonts[] = 'Molle:400i';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				), 'https://fonts.googleapis.com/css'
			);
		}

		return esc_url_raw( $fonts_url );
	}
endif;


// Add preconnect for Google Fonts.

function blogg_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'blogg-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}	
		return $urls;
}
add_filter( 'wp_resource_hints', 'blogg_resource_hints', 10, 2 );


// Enqueue scripts and styles.
function blogg_scripts() {
	
	
	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );
	
	// Enable or Disable Google default fonts
	if( esc_attr(get_theme_mod( 'blogg_default_google_fonts', true ) ) ) {
		wp_enqueue_style( 'blogg-fonts', blogg_fonts_url(), array(), null );
	}
	
	// Bootstrap CSS
	wp_enqueue_style( 'bootstrap-reboot', get_theme_file_uri( '/assets/css/bootstrap-reboot.css' ), '4.1.3', 'screen' );	
	wp_enqueue_style( 'bootstrap-grid', get_theme_file_uri( '/assets/css/bootstrap-grid.css' ), '4.1.3', 'screen' );
	
	// Theme CSS
	wp_enqueue_style( 'blogg-stylesheet', get_stylesheet_uri(), array(), $theme_version );
	
	// Main Menu
	wp_enqueue_script( 'blogg-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '1.0.0', true );	
		wp_localize_script( 'blogg-navigation', 'blogg_menu_title', blogg_get_svg( 'menu' ) . esc_html__( 'Menu', 'blogg' ) );
		
	// Skip Link
	wp_enqueue_script( 'blogg-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	// Icomoon SVG Script
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.js' ), array(), '1.2.4', true );
	
	// Bootstrap with Slider Scripts
	if ( esc_attr(get_theme_mod( 'blogg_display_slider', false ) ) ) { 
		wp_enqueue_script( 'bootstrap-scripts', get_template_directory_uri() . '/assets/js/bootstrap-scripts.js', array(), '4.0.0', true );		
		wp_enqueue_script( 'blogg-theme-scripts', get_template_directory_uri() . '/assets/js/theme-scripts.js', array(), '1.0.0', true );
	}
	// Comments script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blogg_scripts' );


/**
 * Add pingback url on single posts
 */
function blogg_pingback_url() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' )) );
	}
}
add_action( 'wp_head', 'blogg_pingback_url' );


// Theme info
require get_template_directory() . '/inc/theme-info/blogg-info-class-about.php';
require get_template_directory() . '/inc/theme-info/blogg-info.php';

// SVG Icons
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/inline-styles.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/sidebars.php';
require get_template_directory() . '/inc/post-slider.php';

// Register recent posts widget
require get_template_directory() . '/inc/recent-posts-widget.php';

// CUSTOMIZER
require( get_template_directory() . '/inc/customizer/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/controls/headline-control.php' );
require( get_template_directory() . '/inc/customizer/controls/upgrade-control.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-basic.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-layout.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-blog.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-thumbnails.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-slider.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-colours.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-featured.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-pro-upgrade.php' );

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
