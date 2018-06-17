<?php

remove_filter('template_redirect','redirect_canonical');

/**
 * StairWay functions and definitions.
 * @package StairWay
 * @since StairWay 1.0.0
*/

/**
 * StairWay theme variables.
 *  
*/    
$stairway_themename = "StairWay";			//Theme Name
$stairway_themever = "1.2.3";									//Theme version
$stairway_shortname = "stairway";							//Shortname 
$stairway_manualurl = get_template_directory_uri() . '/docs/documentation.html';	//Manual Url
// Set path to StairWay Framework and theme specific functions
$stairway_be_path = get_template_directory() . '/functions/be/';									//BackEnd Path
$stairway_fe_path = get_template_directory() . '/functions/fe/';									//FrontEnd Path 
$stairway_be_pathimages = get_template_directory_uri() . '/functions/be/images';		//BackEnd Path Images
$stairway_fe_pathimages = get_template_directory_uri() . '';	//FrontEnd Path Images
//Include Framework [BE] 
require_once ($stairway_be_path . 'fw-options.php');	 	 // Framework Init  
// Include Theme specific functionality [FE] 
require_once ($stairway_fe_path . 'headerdata.php');		 // Include css and js
require_once ($stairway_fe_path . 'library.php');	       // Include library, functions
require_once ($stairway_fe_path . 'widget-posts-default.php');// Posts-Default Widget

/**
 * StairWay theme basic setup.
 *  
*/
function stairway_setup() {
	// Makes StairWay available for translation.
load_theme_textdomain( 'stairway', get_template_directory() . '/languages' );
  // This theme styles the visual editor to resemble the theme style.
$stairway_font_url = add_query_arg( 'family', 'Tauri', "//fonts.googleapis.com/css" );
add_editor_style( array( 'editor-style.css', $stairway_font_url ) );
	// Adds RSS feed links to <head> for posts and comments.  
add_theme_support( 'automatic-feed-links' );
	// This theme supports custom background color and image.
$defaults = array(
'default-color' => '', 
'default-image' => '',
'wp-head-callback'  => '_custom_background_cb',
'admin-head-callback' => '',
'admin-preview-callback' => '' );  
add_theme_support( 'custom-background', $defaults );
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1000, 9999 );
  // This theme uses a custom header background image.
$args = array(
'flex-width' => true,
'flex-height' => true,
'height' => 450,
'default-image' => get_template_directory_uri() . '/images/header.jpg',
'header-text' => false,
'random-default' => true,);
add_theme_support( 'custom-header', $args );
add_theme_support( 'woocommerce' );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 700; }
}
add_action( 'after_setup_theme', 'stairway_setup' );

/**
 * Enqueues scripts and styles for front-end.
 *
*/
function stairway_scripts_styles() {
	global $wp_styles;
	// Adds JavaScript
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script( 'stairway-placeholders', get_template_directory_uri() . '/js/placeholders.js', array(), '2.1.0', true );
    wp_enqueue_script( 'stairway-scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'stairway-selectnav', get_template_directory_uri() . '/js/selectnav.js', array(), '0.1', true );
    wp_enqueue_script( 'stairway-responzive', get_template_directory_uri() . '/js/responzive.js', array(), '1.0', true );
	// Loads the main stylesheet.
	  wp_enqueue_style( 'stairway-style', get_stylesheet_uri() );
    wp_enqueue_style( 'stairway-google-font-default', '//fonts.googleapis.com/css?family=Tauri&amp;subset=latin,latin-ext' );
    if ( class_exists( 'woocommerce' ) ) { wp_enqueue_style( 'stairway-woocommerce-custom', get_template_directory_uri() . '/css/woocommerce-custom.css' ); }
}
add_action( 'wp_enqueue_scripts', 'stairway_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text.
 *  
*/
function stairway_wp_title( $title, $sep ) {
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	return $title;
}
add_filter( 'wp_title', 'stairway_wp_title', 10, 2 );

/**
 * Register our menus.
 *
 */
function stairway_register_my_menus() {
  register_nav_menus(
    array(
      'main-navigation' => __( 'Main Header Menu', 'stairway' ),
      'top-navigation' => __( 'Top Header Menu', 'stairway' )
    )
  );
}
add_action( 'after_setup_theme', 'stairway_register_my_menus' );

/**
 * Register our sidebars and widgetized areas.
 *
*/
function stairway_widgets_init() {
  register_sidebar( array(
		'name' => __( 'Right Sidebar', 'stairway' ),
		'id' => 'sidebar-1',
		'description' => __( 'Right sidebar which appears on all posts and pages.', 'stairway' ),
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => ' <p class="sidebar-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer left widget area', 'stairway' ),
		'id' => 'sidebar-2',
		'description' => __( 'Left column with widgets in footer.', 'stairway' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer middle widget area', 'stairway' ),
		'id' => 'sidebar-3',
		'description' => __( 'Middle column with widgets in footer.', 'stairway' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer right widget area', 'stairway' ),
		'id' => 'sidebar-4',
		'description' => __( 'Right column with widgets in footer.', 'stairway' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline">',
		'after_title' => '</p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer notices', 'stairway' ),
		'id' => 'sidebar-5',
		'description' => __( 'The line for copyright and other notices below the footer widget areas. Insert here one Text widget. The "Title" field at this widget should stay empty.', 'stairway' ),
		'before_widget' => '<div class="footer-signature"><div class="footer-signature-content">',
		'after_widget' => '</div></div>',
		'before_title' => '',
		'after_title' => '',
	) );
  register_sidebar( array(
		'name' => __( 'Latest Posts Homepage widget area', 'stairway' ),
		'id' => 'sidebar-6',
		'description' => __( 'The area for any StairWay Posts Widgets, which display latest posts from a specific category below the default Latest Posts area.', 'stairway' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'stairway_widgets_init' );

/**
 * Post excerpt settings.
 *
*/
function stairway_custom_excerpt_length( $length ) {
return 40;
}
add_filter( 'excerpt_length', 'stairway_custom_excerpt_length', 20 );
function stairway_new_excerpt_more( $more ) {
global $post;
return '... <a class="read-more-button" href="'. esc_url( get_permalink($post->ID) ) . '">' . __( 'Read more &gt;', 'stairway' ) . '</a>';}
add_filter( 'excerpt_more', 'stairway_new_excerpt_more' );

if ( ! function_exists( 'stairway_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
*/
function stairway_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h2 class="navigation-headline section-heading"><?php _e( 'Post navigation', 'stairway' ); ?></h2>
      <div class="nav-wrapper">
        <p class="navigation-links">
<?php $big = 999999999;
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
  'prev_text' => __( '&larr; Previous', 'stairway' ),
	'next_text' => __( 'Next &rarr;', 'stairway' ),
	'total' => $wp_query->max_num_pages
) );
?>
        </p>
      </div>
		</div>
	<?php endif;
}
endif;

/**
 * Displays navigation to next/previous posts on single posts pages.
 *
*/
function stairway_prev_next($nav_id) { ?>
<?php $stairway_previous_post = get_adjacent_post( false, "", true );
$stairway_next_post = get_adjacent_post( false, "", false ); ?>
<div id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
	<div class="nav-wrapper">
<?php if ( !empty($stairway_previous_post) ) { ?>
  <p class="nav-previous"><a href="<?php echo esc_url(get_permalink($stairway_previous_post->ID)); ?>" title="<?php echo esc_attr($stairway_previous_post->post_title); ?>"><?php _e( '&larr; Previous post', 'stairway' ); ?></a></p>
<?php } if ( !empty($stairway_next_post) ) { ?>
	<p class="nav-next"><a href="<?php echo esc_url(get_permalink($stairway_next_post->ID)); ?>" title="<?php echo esc_attr($stairway_next_post->post_title); ?>"><?php _e( 'Next post &rarr;', 'stairway' ); ?></a></p>
<?php } ?>
   </div>
</div>
<?php }

if ( ! function_exists( 'stairway_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
*/
function stairway_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'stairway' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'stairway' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<span><b class="fn">%1$s</b> %2$s</span>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( '(Post author)', 'stairway' ) . '</span>' : ''
					);
					printf( '<time datetime="%2$s">%3$s</time>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						// translators: 1: date, 2: time
						sprintf( __( '%1$s at %2$s', 'stairway' ), get_comment_date(''), get_comment_time() )
					);
				?>
			</div><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'stairway' ); ?></p>
			<?php endif; ?>

			<div class="comment-content comment">
				<?php comment_text(); ?>
			 <div class="reply">
			   <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'stairway' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
			   <?php edit_comment_link( __( 'Edit', 'stairway' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-content -->
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch;
}
endif;

/**
 * Function for adding custom classes to the menu objects.
 *
*/
add_filter( 'wp_nav_menu_objects', 'stairway_filter_menu_class', 10, 2 );
function stairway_filter_menu_class( $objects, $args ) {

    $ids        = array();
    $parent_ids = array();
    $top_ids    = array();
    foreach ( $objects as $i => $object ) {

        if ( 0 == $object->menu_item_parent ) {
            $top_ids[$i] = $object;
            continue;
        }
 
        if ( ! in_array( $object->menu_item_parent, $ids ) ) {
            $objects[$i]->classes[] = 'first-menu-item';
            $ids[]          = $object->menu_item_parent;
        }
 
        if ( in_array( 'first-menu-item', $object->classes ) )
            continue;
 
        $parent_ids[$i] = $object->menu_item_parent;
    }
 
    $sanitized_parent_ids = array_unique( array_reverse( $parent_ids, true ) );
 
    foreach ( $sanitized_parent_ids as $i => $id )
        $objects[$i]->classes[] = 'last-menu-item';
 
    return $objects; 
}

/**
 * Include the TGM_Plugin_Activation class.
 *  
*/
if ( current_user_can ( 'install_plugins' ) ) {
require_once get_template_directory() . '/class-tgm-plugin-activation.php'; 
add_action( 'stairway_register', 'stairway_my_theme_register_required_plugins' );

function stairway_my_theme_register_required_plugins() {

$plugins = array(
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => false,
		),
	);
 
 
$config = array(
		'domain'       => 'stairway',
    'menu'         => 'install-my-theme-plugins',
		'strings'      	 => array(
		'page_title'             => __( 'Install Recommended Plugins', 'stairway' ),
		'menu_title'             => __( 'Install Plugins', 'stairway' ),
		'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', 'stairway' ),
		'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', 'stairway' ),
		'button'                 => __( 'Install %s Now', 'stairway' ),
		'installing'             => __( 'Installing Plugin: %s', 'stairway' ),
		'oops'                   => __( 'Something went wrong with the plugin API.', 'stairway' ), // */
		'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', 'stairway' ),
		'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'stairway' ),
		'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', 'stairway' ),
		'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'stairway' ),
		'return'                 => __( 'Return to Recommended Plugins Installer', 'stairway' ),
),
); 
stairway_tgmpa( $plugins, $config ); 
}}

/**
 * WooCommerce custom template modifications.
 *  
*/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
function stairway_woocommerce_modifications() {
  remove_action ( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); 
}  
add_action ( 'init', 'stairway_woocommerce_modifications' );
add_filter ( 'woocommerce_show_page_title', '__return_false' );
} ?>