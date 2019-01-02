<?php
/**
 * Kale functions and definitions
 *
 * @package kale
 */
?>
<?php

/*------------------------------
 Customizer
 ------------------------------*/

if ( ! class_exists( 'Kirki' ) ) {
	include_once( dirname( __FILE__ ) . '/inc/kale-kirki.php' ); // fallback
	include_once( dirname( __FILE__ ) . '/inc/kale-kirki-installer.php' ); // installer
}
require get_template_directory() . '/customize/theme-defaults.php' ;
require get_template_directory() . '/customize/customizer.php' ;

function kale_customize_register( $wp_customize ) {
    $wp_customize->remove_control('header_textcolor');
    $wp_customize->get_section('colors')->title = esc_html__( 'Custom Colors', 'kale' );
    $wp_customize->get_section('colors')->priority = 75;
}
add_action( 'customize_register', 'kale_customize_register' );

if(is_admin())  add_action( 'customize_controls_enqueue_scripts', 'kale_custom_customize_enqueue' );
function kale_custom_customize_enqueue() {
    wp_enqueue_style( 'kale-customizer', get_template_directory_uri() . '/customize/style.css' );
}

/*------------------------------
 Setup
 ------------------------------*/

function kale_setup() {

    global $kale_defaults;

    load_theme_textdomain( 'kale', get_template_directory() . '/languages' );

    register_nav_menus( array('header' => esc_html__( 'Main Menu', 'kale' )) );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array('height' => 150, 'width' => 300,'flex-height' => true,'flex-width'  => true ) );
    add_theme_support( 'custom-background');
	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    $args = array(
        'flex-width'    => true,
        'width'         => 1200,
        'flex-height'    => true,
        'height'        => 550,
        'default-image' => $kale_defaults['kale_custom_header'],
    );
    add_theme_support( 'custom-header', $args );

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 760, 400, true );
    add_image_size( 'kale-slider', 1200, 550, true );
    add_image_size( 'kale-thumbnail', 760, 400, true );

    add_post_type_support('page', 'excerpt');

    #https://make.wordpress.org/core/2016/11/26/extending-the-custom-css-editor/
    if ( function_exists( 'wp_update_custom_css_post' ) ) {
        $css = kale_get_option('kale_advanced_css');
        if ( $css ) {
            $core_css = wp_get_custom_css();
            $return = wp_update_custom_css_post( $core_css . $css );
            if ( ! is_wp_error( $return ) ) {
                remove_theme_mod( 'kale_advanced_css' );
            }
        }
    }

	#WooCommerce
	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'woocommerce' );
	}

    kale_kirki_update_3015();
}
add_action( 'after_setup_theme', 'kale_setup' );


/**
 * Register Google fonts.
 *
 * @return string Returns url for Google fonts
 */
function kale_fonts_url() {
    $fonts_url = '';

    $font_families = array();

    $font_families[] = 'Montserrat:400,700';
    $font_families[] = 'Lato:400,700,300,300italic,400italic,700italic';
    $font_families[] = 'Raleway:200';
    $font_families[] = 'Caveat';

    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
        'subset' => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}
/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function kale_resource_hints( $urls, $relation_type ) {
    /**
     * Preconnect Google fonts
     */
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter( 'wp_resource_hints', 'kale_resource_hints', 10, 2 );

/*------------------------------
 Styles and Scripts
 ------------------------------*/

function kale_scripts() {

    /* Styles */
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'kale-fonts', kale_fonts_url(), array(), null );

    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_register_style('bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select.min.css' );
    wp_register_style('smartmenus-bootstrap', get_template_directory_uri() . '/assets/css/jquery.smartmenus.bootstrap.css' );
    wp_register_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
    wp_register_style('owl-carousel', get_template_directory_uri().'/assets/css/owl.carousel.css' );

    //default stylesheet
    $deps = array('bootstrap', 'bootstrap-select', 'smartmenus-bootstrap', 'font-awesome', 'owl-carousel');
    wp_enqueue_style('kale-style', get_stylesheet_uri(), $deps );
    wp_style_add_data( 'kale-style', 'rtl', 'replace' );

    /* Scripts */

    // Load html5shiv.min.js
	wp_enqueue_script( 'kale-html5', get_template_directory_uri() . '/assets/js/html5shiv.min.js', array(), '3.7.0' );
	wp_script_add_data( 'kale-html5', 'conditional', 'lt IE 9' );
    // Load respond.min.js
	wp_enqueue_script( 'kale-respond', get_template_directory_uri() . '/assets/js/respond.min.js', array(), '1.3.0' );
	wp_script_add_data( 'kale-respond', 'conditional', 'lt IE 9' );

    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script('bootstrap-select', get_template_directory_uri() . '/assets/js/bootstrap-select.min.js', array('jquery','bootstrap'), '', true );
    wp_enqueue_script('smartmenus', get_template_directory_uri() . '/assets/js/jquery.smartmenus.js', array('jquery','bootstrap'), '', true );
    wp_enqueue_script('smartmenus-bootstrap', get_template_directory_uri() . '/assets/js/jquery.smartmenus.bootstrap.js', array('jquery','bootstrap'), '', true );
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '', true );
    wp_enqueue_script('kale-js', get_template_directory_uri() . '/assets/js/kale.js', array('jquery'), '', true );

    //comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'kale_scripts' );

/*------------------------------
 Custom CSS
 ------------------------------*/

if ( ! function_exists( 'kale_custom_css_banner_overlay' ) ) :
function kale_custom_css_banner_overlay(){
	global $kale_defaults;
    $kale_frontpage_banner_overlay_color = kale_get_option('kale_frontpage_banner_overlay_color');
	$kale_frontpage_banner_overlay_show = kale_get_option('kale_frontpage_banner_overlay_show');
	$kale_frontpage_banner_link_images = kale_get_option('kale_frontpage_banner_link_images');
    if($kale_frontpage_banner_overlay_show == 0 || $kale_frontpage_banner_link_images == 1){
		echo "<style>";
		echo ".frontpage-banner:before, .frontpage-slider .owl-carousel-item:before{content:none;}";
		echo "</style>";
	} else if($kale_frontpage_banner_overlay_color != $kale_defaults['kale_frontpage_banner_overlay_color']) {
		echo "<style>";
		echo ".frontpage-banner:before, .frontpage-slider .owl-carousel-item:before{background-color:".esc_attr($kale_frontpage_banner_overlay_color).";}";
		echo "</style>";
	}
}
endif;
add_action('wp_head','kale_custom_css_banner_overlay', 98);

if ( ! function_exists( 'kale_custom_css' ) ) :
function kale_custom_css() {
    $kale_advanced_css = kale_get_option('kale_advanced_css');
    if($kale_advanced_css != '') {
        echo '<!-- Custom CSS -->';
        $output = "<style>" . wp_strip_all_tags($kale_advanced_css) . "</style>";
        echo $output;
        echo '<!-- /Custom CSS -->';
    }
}
endif;
add_action('wp_head','kale_custom_css', 99);


/*------------------------------
 Widgets
 ------------------------------*/
require_once get_template_directory() . '/widgets/widgets.php';

/*------------------------------
 Meta Boxes
 ------------------------------*/
require_once get_template_directory() . '/meta_boxes/meta_boxes.php';

/*------------------------------
 Content Width
 ------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}

/*------------------------------
 wp_bootstrap_navwalker
 ------------------------------*/
require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Welcome page
 */
require get_parent_theme_file_path( '/welcome-page/welcome-page.php' );

/*------------------------------
 TGM_Plugin_Activation
 ------------------------------*/

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'kale_register_required_plugins' );
function kale_register_required_plugins() {
	$plugins = array(
        array(
			'name'      => 'Kirki',
			'slug'      => 'kirki',
			'required'  => false,
		),
        array(
			'name'      => 'WPForms',
			'slug'      => 'wpforms-lite',
			'required'  => false,
		),
        array(
			'name'      => 'Recent Posts Widget With Thumbnails',
			'slug'      => 'recent-posts-widget-with-thumbnails',
			'required'  => false,
		),
	);
	$config = array(
		'id'           => 'kale',                  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}

/*------------------------------
 Filters
 ------------------------------*/

#move comment field to the bottom of the comments form
function kale_move_comment_field_to_bottom( $fields ) {
    if ( get_post_type() == 'post' ) :
        $comment_field = $fields['comment'];
        $cookies       = $fields['cookies'];
        unset( $fields['comment'] );
        unset( $fields['cookies'] );
        $fields['comment'] = $comment_field;
        $fields['cookies'] = $cookies;
    endif;
    return $fields;
}
add_filter( 'comment_form_fields', 'kale_move_comment_field_to_bottom' );

#excerpt length
function kale_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'kale_excerpt_length', 999 );

#add class to page nav
function kale_wp_page_menu_class( $class ) {
  return preg_replace( '/<ul>/', '<ul class="nav navbar-nav">', $class, 1 );
}
add_filter( 'wp_page_menu', 'kale_wp_page_menu_class' );

#get_the_archive_title
function kale_archive_title( $title ) {
    if( is_home() && get_option('page_for_posts') ) {
        $title = get_page( get_option('page_for_posts') )->post_title;
    }
    else if( is_home() ) {
        $title = kale_get_option('kale_blog_feed_label');
        $title = esc_html($title);
    }
    else if ( is_search() ) {
        $title = esc_html__('Search Results: ', 'kale') . get_search_query();
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'kale_archive_title' );

//https://productforums.google.com/forum/#!topic/webmasters/WUszeNYGNdg
# Remove the "hentry" class from pages and archives (prevents structured data errors)
function remove_hentry( $classes ) {
    if (is_page() || is_archive()){$classes = array_diff( $classes, array('hentry'));}return $classes;
}
add_filter( 'post_class','remove_hentry' );

/*------------------------------
 Top Navigation
 ------------------------------*/

#add search form to nav
function kale_nav_items_wrap() {
    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';
    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';
    // the static link
    $wrap .= kale_get_nav_search_item();
    // close the <ul>
    $wrap .= '</ul>';
    // return the result
    return $wrap;
}

function kale_get_nav_search_item(){
    return '<li class="search">
        <a href="javascript:;" id="toggle-main_search" data-toggle="dropdown"><i class="fa fa-search"></i></a>
        <div class="dropdown-menu main_search">
            <form name="main_search" method="get" action="'.esc_url(home_url( '/' )).'">
                <input type="text" name="s" class="form-control" placeholder="'. esc_attr(__('Type here','kale')).'" />
            </form>
        </div>
    </li>';
}

#default nav top level pages
function kale_default_nav(){
    echo '<div class="navbar-collapse collapse">';
    echo '<ul class="nav navbar-nav">';
    $pages = get_pages();
    $n = count($pages);
    $i=0;
    foreach ( $pages as $page ) {
        $menu_name = esc_html($page->post_title);
        $menu_link = get_page_link( $page->ID );
        if(get_the_ID() == $page->ID) $current_class = "current_page_item current-menu-item";
        else { $current_class = ''; }
        $menu_class = "page-item-" . $page->ID;
        echo "<li class='page_item ".esc_attr($menu_class)." $current_class'><a href='".esc_url($menu_link)."'>".esc_html($menu_name)."</a></li>";
        $i++;
        if($n == $i){
            echo kale_get_nav_search_item();
        }
    }
    echo '</ul>';
    echo '</div>';
}

/*------------------------------
 Helper
 ------------------------------*/

if ( ! function_exists( 'kale_get_option' ) ) :
function kale_get_option($key){
    global $kale_defaults;
    if (is_array($kale_defaults) && array_key_exists($key, $kale_defaults))
        $value = get_theme_mod($key, $kale_defaults[$key]);
    else
        $value = get_theme_mod($key);
    return $value;
}
endif;

if ( ! function_exists( 'kale_get_bootstrap_class' ) ) :
function kale_get_bootstrap_class($columns){
    switch($columns){
        case 1: return 'col-md-12'; break;
        case 2: return 'col-lg-6 col-md-6 col-sm-6 col-xs-6'; break;
        case 3: return 'col-lg-4 col-md-4 col-sm-4 col-xs-12'; break;
        case 4: return 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; break;
        case 5: return 'col-md-20'; break;
        case 6: return 'col-lg-2 col-md-2 col-sm-2 col-xs-6'; break;
    }
}
endif;

if ( ! function_exists( 'kale_get_sample' ) ) :
function kale_get_sample($what){
    global $kale_defaults;
    switch($what){
        case 'slide':           $images = $kale_defaults['kale_slide_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'kale-thumbnail':  $images = $kale_defaults['kale_thumbnail_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'full':            $images = $kale_defaults['kale_full_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'kale-vertical':   $images = $kale_defaults['kale_vertical_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'kale-index':      $images = $kale_defaults['kale_index_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
    }
}
endif;

if ( ! function_exists( 'kale_show_custom_css_field' ) ) :
function kale_show_custom_css_field(){
    if(get_bloginfo('version') >= 4.7){
        $kale_advanced_css = kale_get_option('kale_advanced_css');
        if($kale_advanced_css == '') return false;
        else return true;
    }
    return true;
}
endif;

#kale_example_sidebar
function kale_example_sidebar(){
    echo '<div class="sidebar-default sidebar-block sidebar-no-borders" >';
    the_widget('WP_Widget_Search', 'title=' . esc_html__('Search', 'kale'), 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>&before_widget=<div class="default-widget widget widget_search">&after_widget=</div>');
    the_widget('WP_Widget_Pages', 'title=' . esc_html__('Pages', 'kale') , 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    the_widget('WP_Widget_Recent_Posts', 'title=' . esc_html__('Recent Posts', 'kale') , 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    the_widget( 'WP_Widget_Archives', 'title=' . esc_html__('Archives', 'kale'), 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    the_widget( 'WP_Widget_Categories', 'title=' . esc_html__('Categories', 'kale'), 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    echo '</div>';
}

if ( ! function_exists( 'kale_get_attachment' ) ) :
function kale_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}
endif;

function kale_kirki_update_3015(){
    # version 3.0.15 is no longer using strings "0" or "1" for this control
    $switches = array(  'kale_image_logo_show', 'kale_frontpage_featured_posts_show', 'kale_frontpage_large_post_show',
                        'kale_blog_feed_meta_show', 'kale_posts_meta_show', 'kale_sidebar_size');
    foreach($switches as $switch) {
        $val = get_theme_mod( $switch, true ) ;
        if($val == "0")    set_theme_mod( $switch, false );
    }
}
