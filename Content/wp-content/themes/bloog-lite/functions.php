<?php
/**
 * Bloog Lite functions and definitions
 *
 * @package Bloog Lite
 */

if ( ! function_exists( 'bloog_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bloog_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Bloog Lite, use a find and replace
	 * to change 'bloog-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bloog-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'bloog-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bloog_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( array( 'css/editor-style.css') );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // bloog_lite_setup
add_action( 'after_setup_theme', 'bloog_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bloog_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bloog_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'bloog_lite_content_width', 0 );

//adding class to body boxed/full-width
function bloog_lite_bodyclass($classes){
	$classes[]= get_theme_mod('layout_option');
	return $classes;
}
add_filter('body_class','bloog_lite_bodyclass' );

/**
 * Enqueue scripts and styles.
 */
function bloog_lite_scripts() {
	$query_args = array('family' => 'Oswald:400,300,700|Raleway:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Lato:400,300,700,900,100|Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic');
	wp_enqueue_style('bloog-lite-google-fonts-css', add_query_arg($query_args, "//fonts.googleapis.com/css"));
	wp_enqueue_style( 'bloog-lite-style', get_stylesheet_uri() );
    wp_enqueue_style( 'bloog-lite-respond', get_template_directory_uri() . '/css/responsive.css', array() );

	wp_enqueue_script( 'bloog-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
    wp_enqueue_script( 'bloog-lite-customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'), '4.2.2', true );
    
	wp_enqueue_script( 'bloog-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    
   if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bloog_lite_scripts' );

/**
 *  Cropping image to a required size
 */
 add_image_size('bloog-post-image-size', 940, 627, true); // post image size 
 add_image_size('bloog-homeslider-image-size', 970, 550, true); // post image home slider size
 //add_image_size('bloog-homepage_post_fullwidth',970,400,true); // home page full width image
 add_image_size('bloog-post-image-withsidebar', 650, 479, true); // home page with sidebar
 add_image_size('bloog-about-us-page-img', 380, 380, true); // home page with sidebar
 add_image_size('bloog-grid-view-img', 300, 200, true); // home page with sidebar
 add_image_size ('bloog-feature-page-img', 292, 169); // feature page image display in sidebar and footer sidebar
 add_image_size ('bloog-recent-post-thumb', 86, 57, true);
  
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/bloog-functions.php';

/**
 * Load customizer line
 */
require get_template_directory() . '/inc/bloog-customizer.php';

/**
 * Load post dropdown selector
 */
require get_template_directory() . '/inc/post-dropdown.php';

/**
 * Load post dropdown selector
 */
require get_template_directory() . '/inc/category-dropdown.php';

/**
 *  Load bloog widgets in site
 */
 require get_template_directory() . '/inc/bloog-widgets.php';

/**
 *  Load bloog setup instruction in site
 */
 require get_template_directory() . '/inc/about-theme.php';