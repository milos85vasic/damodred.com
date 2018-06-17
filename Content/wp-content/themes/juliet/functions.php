<?php

remove_filter('template_redirect','redirect_canonical');

/**
 * Juliet functions and definitions
 *
 * @package juliet
 */
?>
<?php

/*------------------------------
 Customizer
 ------------------------------*/
 
if ( ! class_exists( 'Kirki' ) ) {
    include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );
}
require get_template_directory() . '/customize/theme-defaults.php';
require get_template_directory() . '/customize/kirki-config.php';
require get_template_directory() . '/customize/customizer.php';

function juliet_customize_register( $wp_customize ) {
    $wp_customize->get_section('colors')->title = esc_html__( 'Custom Colors', 'juliet' );
    $wp_customize->get_section('colors')->priority = 75;
}
add_action( 'customize_register', 'juliet_customize_register' );

if(is_admin())  add_action( 'customize_controls_enqueue_scripts', 'juliet_custom_customize_enqueue' );
function juliet_custom_customize_enqueue() {
    wp_enqueue_style( 'juliet-customizer', get_template_directory_uri() . '/customize/style.css' );
}

/*------------------------------
 Setup
 ------------------------------*/

function juliet_setup() {
    global $juliet_defaults;
    load_theme_textdomain( 'juliet', get_template_directory() . '/languages' ); 
    
    register_nav_menus( array(  'header'    => esc_html__( 'Main Menu', 'juliet' ), 
                                'offcanvas' => esc_html__( 'Off Canvas Menu', 'juliet') ) );
    
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array('height' => 80, 'width' => 250,'flex-height' => true,'flex-width'  => true ) );
    add_theme_support( 'custom-background');
	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    
    $args = array(
        'flex-width'    => true,
        'width'         => 1200,
        'flex-height'    => true,
        'height'        => 625,
        'default-image' => $juliet_defaults['juliet_custom_header'],
    );
    add_theme_support( 'custom-header', $args );

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size(            700, 600, true );
    add_image_size( 'juliet-slider',    1200, 625, true );
    add_image_size( 'juliet-thumbnail', 700, 600, true );
    add_image_size( 'juliet-featured',  540, 540, true );

    add_post_type_support('page', 'excerpt');
	
	#https://make.wordpress.org/core/2016/11/26/extending-the-custom-css-editor/
    if ( function_exists( 'wp_update_custom_css_post' ) ) {
        $css = juliet_get_option('juliet_advanced_css');
        if ( $css ) {
            $core_css = wp_get_custom_css(); 
            $return = wp_update_custom_css_post( $core_css . $css );
            if ( ! is_wp_error( $return ) ) {
                remove_theme_mod( 'juliet_advanced_css' );
            }
        }
    }
	
	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'woocommerce' );
	}
    juliet_kirki_update_3015();
}
add_action( 'after_setup_theme', 'juliet_setup' );

/*------------------------------
 Styles and Scripts
 ------------------------------*/

function juliet_scripts() {
    
    /* Styles */
    
    //fonts
	$juliet_skin = juliet_get_option('juliet_skin');
	wp_enqueue_style('juliet-googlefont-logo-tagline', '//fonts.googleapis.com/css?family=Crimson+Text:400,400i,600,600i,700,700i'); #logo tagline
	if( $juliet_skin == 'Classic') { 
		wp_enqueue_style('juliet-googlefont-body', '//fonts.googleapis.com/css?family=Lato:400,400i,700,700i'); #body
    } else {
		wp_enqueue_style('juliet-googlefont-body', '//fonts.googleapis.com/css?family=Lato:400,400i,700,700i'); #body
		wp_enqueue_style('juliet-googlefont-headings', '//fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,700,700i'); #headings
	}
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_register_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
    wp_register_style('smartmenus-bootstrap', get_template_directory_uri() . '/assets/css/jquery.smartmenus.bootstrap.css' );

    //default stylesheet
    $deps = array('bootstrap', 'font-awesome', 'smartmenus-bootstrap');
    wp_enqueue_style('juliet-style', get_stylesheet_uri(), $deps );

    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_style('slick-style', get_template_directory_uri().'/assets/css/slick.min.css' );
        wp_enqueue_style('juliet-woocommerce-style', get_template_directory_uri().'/woocommerce/woocommerce.css', array( 'juliet-style' ) );
    }
    
    // Load html5shiv.js
	wp_enqueue_script( 'juliet-html5', get_template_directory_uri() . '/assets/js/html5shiv.js', array('juliet-style'), '3.7.0' );
	wp_script_add_data( 'juliet-html5', 'conditional', 'lt IE 9' );
    // Load respond.min.js
	wp_enqueue_script( 'juliet-respond', get_template_directory_uri() . '/assets/js/respond.min.js', array('juliet-style'), '1.3.0' );
	wp_script_add_data( 'juliet-html5', 'conditional', 'lt IE 9' );
    
    /* Scripts */
    
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true );
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script('slick', get_template_directory_uri().'/assets/js/slick.min.js', array('jquery'), '', true);
    }
    if(juliet_get_option('juliet_enable_fancy_scrollbar') == 1){
        wp_enqueue_script('nice-scroll', get_template_directory_uri() . '/assets/js/nicescroll.min.js', array('jquery'), '', true );
        wp_enqueue_script('juliet-js', get_template_directory_uri() . '/assets/js/juliet.js', array('jquery', 'bootstrap', 'nice-scroll'), '', true );
    } else {
        wp_enqueue_script('juliet-js', get_template_directory_uri() . '/assets/js/juliet.js', array('jquery', 'bootstrap'), '', true );
    }
    
    wp_enqueue_script('smartmenus', get_template_directory_uri() . '/assets/js/jquery.smartmenus.js', array('jquery','bootstrap'), '', true );
    wp_enqueue_script('smartmenus-bootstrap', get_template_directory_uri() . '/assets/js/jquery.smartmenus.bootstrap.js', array('jquery','bootstrap'), '', true );
        
    //comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
}
add_action( 'wp_enqueue_scripts', 'juliet_scripts' );

/*------------------------------
 Custom CSS
 ------------------------------*/

if ( ! function_exists( 'juliet_custom_css_banner_overlay' ) ) :
function juliet_custom_css_banner_overlay(){ 
	global $juliet_defaults;
    $juliet_frontpage_banner_overlay_color = juliet_get_option('juliet_frontpage_banner_overlay_color');
	$juliet_frontpage_banner_overlay_show = juliet_get_option('juliet_frontpage_banner_overlay_show');
    if($juliet_frontpage_banner_overlay_show == 0){
		echo "<style>";
		echo ".frontpage-banner:before, .frontpage-slider .item:before{content:none;}";
		echo "</style>";
	} else if($juliet_frontpage_banner_overlay_color != $juliet_defaults['juliet_frontpage_banner_overlay_color']) {
		echo "<style>";
		echo ".frontpage-banner:before{background-color:".esc_attr($juliet_frontpage_banner_overlay_color).";}"; 
		echo ".frontpage-slider .item:before{background-color:".esc_attr($juliet_frontpage_banner_overlay_color).";}"; 
		echo "</style>";
	}
} 
endif;
add_action('wp_head','juliet_custom_css_banner_overlay', 98);

if ( ! function_exists( 'juliet_custom_css' ) ) :
function juliet_custom_css() {
    $juliet_advanced_css = juliet_get_option('juliet_advanced_css');
    if($juliet_advanced_css != '') {    
        echo '<!-- Custom CSS -->';
        $output="<style>" . wp_strip_all_tags($juliet_advanced_css) . "</style>";
        echo $output;
        echo '<!-- /Custom CSS -->';
    }
}
endif;
add_action('wp_head','juliet_custom_css', 99);

/*------------------------------
 Widgets
 ------------------------------*/
require_once get_template_directory() . '/widgets/widgets.php';

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

/*------------------------------
 TGM_Plugin_Activation
 ------------------------------*/

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'juliet_register_required_plugins' );
function juliet_register_required_plugins() {
	$plugins = array(
        array(
			'name'      => esc_html__('Recent Posts Widget With Thumbnails', 'juliet'),
			'slug'      => 'recent-posts-widget-with-thumbnails',
			'required'  => false,
		)
	);
	$config = array(
		'id'           => 'juliet',                // Unique ID for hashing notices for multiple instances of TGMPA.
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
 Helper
 ------------------------------*/

if ( ! function_exists( 'juliet_get_option' ) ) :
function juliet_get_option($key){
    global $juliet_defaults;
    if (array_key_exists($key, $juliet_defaults)) 
        $value = get_theme_mod($key, $juliet_defaults[$key]); 
    else
        $value = get_theme_mod($key);
    return $value;
}
endif;

if ( ! function_exists( 'juliet_get_bootstrap_class' ) ) :
function juliet_get_bootstrap_class($columns){
    switch($columns){
        case 1: return 'col-md-12'; break;
        case 2: return 'col-lg-6 col-md-6 col-sm-6'; break;
        case 3: return 'col-lg-4 col-md-4 col-sm-4 col-xs-12'; break;
        case 4: return 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; break;
        case 5: return 'col-md-20'; break;
        case 6: return 'col-lg-2 col-md-2 col-sm-2 col-xs-6'; break;
    }
}
endif;

if ( ! function_exists( 'juliet_get_sample' ) ) :
function juliet_get_sample($what){
    global $juliet_defaults;
    switch($what){
        case 'juliet-thumbnail':    $images = $juliet_defaults['juliet_thumbnail_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'juliet-full':         $images = $juliet_defaults['juliet_full_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'juliet-featured':     $images = $juliet_defaults['juliet_featured_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);    
    }
}
endif;

if ( ! function_exists( 'juliet_get_body_class' ) ) :
function juliet_get_body_class(){
    $class = 'boxed';
    return $class;
}
endif;

if ( ! function_exists( 'juliet_show_custom_css_field' ) ) :
function juliet_show_custom_css_field(){
    if(get_bloginfo('version') >= 4.7){
        $juliet_advanced_css = juliet_get_option('juliet_advanced_css');
        if($juliet_advanced_css == '') return false;
        else return true;
    } 
    return true;
}
endif;

function juliet_kirki_update_3015(){
    # version 3.0.15 is no longer using strings "0" or "1" for this control
    $switches = array(  'juliet_image_logo_show', 'juliet_frontpage_featured_posts_show', 'juliet_blog_feed_meta_show', 'juliet_posts_meta_show');
    foreach($switches as $switch) {
        $val = get_theme_mod( $switch, true ) ; 
        if($val == "0")    set_theme_mod( $switch, false ); 
    }
}

/*------------------------------
 Filters
 ------------------------------*/

//https://gist.github.com/hatsumatsu/e5df3b0bf9ac3389c0b0
function juliet_embed_oembed_html( $html, $url, $attributes, $id ) {
    $class = '';
    if( strpos( $url, 'youtu' ) || strpos( $url, 'vimeo' ) ) {
        $class .= ' iframe-video';
    }
    return '<div class="' . esc_attr( $class ) . '">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'juliet_embed_oembed_html', 99, 4 );

#disable comments on media attachments
function juliet_filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'juliet_filter_media_comment_status', 10 , 2 );

#move comment field to the bottom of the comments form
function juliet_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'juliet_move_comment_field_to_bottom' );

#excerpt length
function juliet_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'juliet_excerpt_length', 999 );

#nicescroll
function juliet_nice_scroll(){
    if(juliet_get_option('juliet_enable_fancy_scrollbar') != 1) return;
    global $juliet_defaults;
    $juliet_custom_colors = juliet_get_option('juliet_custom_colors');
    if($juliet_custom_colors == 0) $color = $juliet_defaults['juliet_custom_colors_scrollbar'];
    else $color = juliet_get_option('juliet_custom_colors_scrollbar');
    $script = 'jQuery(document).ready(function($){jQuery("html").niceScroll({ cursorcolor:"' . esc_attr($color) . '",
                                cursorborder:"' . esc_attr($color) . '",
                                cursoropacitymin:0.2,
                                cursorwidth:10,
                                zindex:10,
                                scrollspeed:60,
                                mousescrollstep:40}); });';
    wp_add_inline_script( 'juliet-js', $script );
}
add_action( 'wp_enqueue_scripts', 'juliet_nice_scroll', 998 );

#get_the_archive_title
function juliet_archive_title( $title ) {
    if( is_home() && get_option('page_for_posts') ) {
        $title = get_page( get_option('page_for_posts') )->post_title;
    }
    else if( is_home() ) {
        $title = juliet_get_option('juliet_blog_feed_label');
        $title = esc_html($title);
    }  
    return $title;
}
add_filter( 'get_the_archive_title', 'juliet_archive_title' );

//https://productforums.google.com/forum/#!topic/webmasters/WUszeNYGNdg
# Remove the "hentry" class from pages and archives (prevents structured data errors)
function remove_hentry( $classes ) {
    if (is_page() || is_archive()){$classes = array_diff( $classes, array('hentry'));}return $classes;
}
add_filter( 'post_class','remove_hentry' );

/*------------------------------
 Example / Default
 ------------------------------*/
 
#default nav top level pages
function juliet_default_nav(){
	echo '<div class="navbar-collapse collapse">';
    echo '<ul class="nav navbar-nav">';
    $pages = get_pages();  
    $n = count($pages); 
    $i=0;
    foreach ( $pages as $page ) {
        $menu_name = $page->post_title;
        $menu_link = get_page_link( $page->ID );
        if(get_the_ID() == $page->ID) $current_class = "current_page_item";
        else { $current_class = ''; $home_current_class = ''; }
        $menu_class = "page-item-" . $page->ID;
        echo "<li class='page_item ".esc_attr($menu_class)." $current_class'><a href='".esc_url($menu_link)."'>".esc_html($menu_name)."</a></li>";
        $i++;
    } 
    echo '</ul>';
	echo '</div>';
}


function juliet_example_footer_widgets(){
    
    echo '<div class="sidebar-footer footer-row-1">';
    echo '<div class="row">';
    
    echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
    the_widget('WP_Widget_Pages', 'title=Pages', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="footer-row-1-widget widget">&after_widget=</div>');
    echo '</div>';
    
    echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
    the_widget( 'WP_Widget_Archives', 'title=Archives', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="footer-row-1-widget widget">&after_widget=</div>');
    echo '</div>';
    
    echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
    the_widget('WP_Widget_Recent_Posts', 'title=Recent Posts', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="footer-row-1-widget widget">&after_widget=</div>');
    echo '</div>';
    
    echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
    the_widget( 'WP_Widget_Categories', 'title=Categories', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="footer-row-1-widget widget ">&after_widget=</div>');
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
}

#juliet_example_sidebar
function juliet_example_sidebar(){
    echo '<div class="sidebar-default" >';
    the_widget('WP_Widget_Search', 'title=' . esc_html__('Search', 'juliet'), 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="default-widget widget widget_search">&after_widget=</div>');
    the_widget('WP_Widget_Pages', 'title=' . esc_html__('Pages', 'juliet') , 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    the_widget('WP_Widget_Recent_Posts', 'title=' . esc_html__('Recent Posts', 'juliet') , 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    the_widget( 'WP_Widget_Archives', 'title=' . esc_html__('Archives', 'juliet'), 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    the_widget( 'WP_Widget_Categories', 'title=' . esc_html__('Categories', 'juliet'), 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="default-widget widget">&after_widget=</div>');
    echo '</div>';
}

/*------------------------------
 Woocommerce
 ------------------------------*/

 require_once get_template_directory() . '/woocommerce/functions_woocommerce.php';
?>