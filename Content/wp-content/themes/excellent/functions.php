<?php

remove_filter('template_redirect','redirect_canonical');

/**
 * Display all excellent functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */

/************************************************************************************************/
if ( ! function_exists( 'excellent_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function excellent_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width=790;
	}

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-thumbnails');

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'topmenu' => __( 'Top Menu', 'excellent' ),
		'primary' => __( 'Main Menu', 'excellent' ),
		'footermenu' => __( 'Footer Menu', 'excellent' ),
		'social-link'  => __( 'Add Social Icons Only', 'excellent' ),
	) );

	/* 
	* Enable support for custom logo. 
	*
	*/ 
	add_theme_support( 'custom-logo', array(
		'flex-width' => true, 
		'flex-height' => true,
	) );

	//Indicate widget sidebars can use selective refresh in the Customizer. 
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Switch default core markup for comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat' ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'excellent_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( array( 'css/editor-style.css') );

	/**
	* Making the theme Woocommrece compatible
	*/

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif; // excellent_setup
add_action( 'after_setup_theme', 'excellent_setup' );

/***************************************************************************************/
function excellent_content_width() {
	if ( is_page_template( 'page-templates/gallery-template.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1170;
	}
}
add_action( 'template_redirect', 'excellent_content_width' );

/***************************************************************************************/
if(!function_exists('excellent_get_theme_options')):
	function excellent_get_theme_options() {
	    return wp_parse_args(  get_option( 'excellent_theme_options', array() ), excellent_get_option_defaults_values() );
	}
endif;

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/excellent-default-values.php';
require get_template_directory() . '/inc/settings/excellent-functions.php';
require get_template_directory() . '/inc/settings/excellent-common-functions.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/footer-details.php';

/************************ Excellent Sidebar  *****************************/
require get_template_directory() . '/inc/widgets/widgets-functions/register-widgets.php';

/************************ Excellent Customizer  *****************************/
require get_template_directory() . '/inc/customizer/functions/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/functions/register-panel.php';
function excellent_customize_register( $wp_customize ) {
if(!class_exists('Excellent_Plus_Features')){
	class Excellent_Customize_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
			<a title="<?php esc_html_e( 'Review Us', 'excellent' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/excellent/' ); ?>" target="_blank" id="about_excellent">
			<?php esc_html_e( 'Review Us', 'excellent' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://themefreesia.com/theme-instruction/excellent/' ); ?>" title="<?php esc_html_e( 'Theme Instructions', 'excellent' ); ?>" target="_blank" id="about_excellent">
			<?php esc_html_e( 'Theme Instructions', 'excellent' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://tickets.themefreesia.com/' ); ?>" title="<?php esc_html_e( 'Support Tickets', 'excellent' ); ?>" target="_blank" id="about_excellent">
			<?php esc_html_e( 'Forum', 'excellent' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://www.facebook.com/themefreesia/' ); ?>" title="<?php esc_html_e( 'Facebook', 'excellent' ); ?>" target="_blank" id="about_excellent">
			<?php esc_html_e( 'Facebook', 'excellent' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://twitter.com/themefreesia' ); ?>" title="<?php esc_html_e( 'Twitter', 'excellent' ); ?>" target="_blank" id="about_excellent">
			<?php esc_html_e( 'Twitter', 'excellent' ); ?>
			</a><br/>
		<?php
		}
	}
	$wp_customize->add_section('excellent_upgrade_links', array(
		'title'					=> __('Important Links', 'excellent'),
		'priority'				=> 1000,
	));
	$wp_customize->add_setting( 'excellent_upgrade_links', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Excellent_Customize_upgrade(
		$wp_customize,
		'excellent_upgrade_links',
			array(
				'section'				=> 'excellent_upgrade_links',
				'settings'				=> 'excellent_upgrade_links',
			)
		)
	);
}	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'excellent_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'excellent_customize_partial_blogdescription',
		) );
	}
	require get_template_directory() . '/inc/customizer/functions/frontpage-features.php' ;
	require get_template_directory() . '/inc/customizer/functions/design-options.php';
	require get_template_directory() . '/inc/customizer/functions/theme-options.php';
	require get_template_directory() . '/inc/customizer/functions/featured-content-customizer.php' ;
	require get_template_directory() . '/inc/customizer/functions/color-options.php' ;
}
if(!class_exists('Excellent_Plus_Features')){
	// Add Upgrade to Plus Button.
	require_once( trailingslashit( get_template_directory() ) . 'inc/upgrade-plus/class-customize.php' );
}

	/* Color Styles */
	require get_template_directory() . '/inc/settings/color-option-functions.php' ;
/** 
* Render the site title for the selective refresh partial. 
* @see excellent_customize_register() 
* @return void 
*/ 
function excellent_customize_partial_blogname() { 
bloginfo( 'name' ); 
} 

/** 
* Render the site tagline for the selective refresh partial. 
* @see excellent_customize_register() 
* @return void 
*/ 
function excellent_customize_partial_blogdescription() { 
bloginfo( 'description' ); 
}
add_action( 'customize_register', 'excellent_customize_register' );
/******************* Excellent Header Display *************************/
function excellent_header_display(){
	$excellent_settings = excellent_get_theme_options();
	$header_display = $excellent_settings['excellent_header_display'];
	if ($header_display == 'header_text') { ?>
		<div id="site-branding">
		<?php if(is_home() || is_front_page()){ ?>
		<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
			<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_html(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
		<?php if(is_home() || is_front_page() || is_search()){ ?>
		</h1>  <!-- end .site-title -->
		<?php } else { ?> </h2> <!-- end .site-title --> <?php } 
		$site_description = get_bloginfo( 'description', 'display' );
		if($site_description){?>
		<p id ="site-description"> <?php bloginfo('description');?> </p> <!-- end #site-description -->
		<?php } ?>
		</div> <!-- end #site-branding -->
		<?php
	} elseif ($header_display == 'header_logo') { ?>
		<div id="site-branding"> <?php excellent_the_custom_logo(); ?></div> <!-- end #site-branding -->
		<?php } elseif ($header_display == 'show_both'){ ?>
		<div id="site-branding"> <?php excellent_the_custom_logo(); ?></a>
		<?php if(is_home() || is_front_page()){ ?>
		<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
			<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_html(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
			<?php if(is_home() || is_front_page()){ ?> </h1> <!-- end .site-title -->
		<?php }else{ ?> </h2> <!-- end .site-title -->
		<?php }
		$site_description = get_bloginfo( 'description', 'display' );
			if($site_description){?>
			<p id ="site-description"> <?php bloginfo('description');?> </p><!-- end #site-description -->
		<?php } ?>
		</div> <!-- end #site-branding -->
		<?php }
}
add_action('excellent_site_branding','excellent_header_display');

if ( ! function_exists( 'excellent_the_custom_logo' ) ) : 
 	/** 
 	 * Displays the optional custom logo. 
 	 * Does nothing if the custom logo is not available. 
 	 */ 
 	function excellent_the_custom_logo() { 
 	    if ( function_exists( 'the_custom_logo' ) ) { 
 	        the_custom_logo(); 
 	    }
 	} 
 	endif;

/* Excellent Template */
require get_template_directory() . '/inc/front-page/about-us.php';
require get_template_directory() . '/inc/front-page/front-page-features.php';
require get_template_directory() . '/inc/front-page/latest-from-blog.php';
require get_template_directory() . '/inc/front-page/portfolio-box.php';
require get_template_directory() . '/inc/front-page/our-testimonial.php';
/************** Footer Menu *************************************/
function excellent_footer_menu_section(){
	if(has_nav_menu('footermenu')):
		$args = array(
			'theme_location' => 'footermenu',
			'container'      => '',
			'items_wrap'     => '<ul>%3$s</ul>',
		);
		echo '<nav id="footer-navigation">';
		wp_nav_menu($args);
		echo '</nav><!-- end #footer-navigation -->';
	endif;
}
add_action( 'excellent_footer_menu', 'excellent_footer_menu_section' );