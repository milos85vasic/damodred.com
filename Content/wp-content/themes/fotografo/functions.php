<?php
/**
 * Fotografo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fotografo
 */

if ( ! function_exists( 'fotografo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fotografo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Fotografo, use a find and replace
	 * to change 'fotografo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'fotografo', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'fotografo' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fotografo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'fotografo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fotografo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fotografo_content_width', 640 );
}
add_action( 'after_setup_theme', 'fotografo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fotografo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fotografo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'fotografo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}
add_action( 'widgets_init', 'fotografo_widgets_init' );

if ( ! function_exists( 'fotografo_fonts_url' ) ) :
/**
 * Register Google fonts for Evento.
 *
 * Create your own evento_fonts_url() function to override in a child theme.
 *
 * @since Evento 1.0.2
 *
 * @return string Google fonts URL for the theme.
 */
function fotografo_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin';
	$fonts[] = 'Oswald:300,400,700';
	$fonts[] = 'Lato:400,400i,700,700i';


	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function fotografo_scripts() {
	wp_enqueue_style( 'fotografo-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'fotografo-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css' );
	
	wp_enqueue_style( 'elegant-icons', get_template_directory_uri() . '/fonts/elegant_icons/style.css' );
	
	wp_enqueue_style( 'fotografo-fonts', fotografo_fonts_url(), array(), null);  

	wp_enqueue_script( 'jquery' );
		
	wp_enqueue_script( 'fotografo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	
	wp_enqueue_script( 'tether', get_template_directory_uri() . '/js/tether.js', array(), '20151215', true );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fotografo_scripts' );


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
 * TGMPA
 */
require get_template_directory() . '/inc/fotografo-plugins.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
