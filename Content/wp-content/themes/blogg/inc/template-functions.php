<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blogg
 */

if ( ! function_exists( 'blogg_fallback_menu' ) ) :
	/**
	 * Display default page as navigation if no custom menu was set
	 */
	function blogg_fallback_menu() {
		$pages = wp_list_pages( 'title_li=&echo=0' );
		echo '<ul id="menu-main-navigation" class="main-navigation-menu menu">' .  $pages  . '</ul>';  // WPCS: XSS OK.
	}
endif;

//	Move the read more link outside of the post summary paragraph	
add_filter( 'the_content_more_link', 'blogg_move_more_link' );
	function blogg_move_more_link() {

	return '<p class="more-link-wrapper"><a class="more-link" href="'. esc_url(get_permalink()) . '">' . esc_html__( 'Read More', 'blogg' ) . '</a></p>';
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogg_body_classes( $classes ) {

	// Add header style class
	$classes[] = 'header1';
	
	// Set blog layout.		
	$blogg_blog_layout = esc_attr(get_theme_mod( 'blogg_blog_layout', 'default' ) );

if (is_home() || is_archive() ) {	
			
		if ( 'grid' === $blogg_blog_layout ) {	
			$classes[] = 'blog-grid';

		} elseif ( 'default-left' === $blogg_blog_layout ) {	
			$classes[] = 'blog-default-left';	
					
		} else {
			$classes[] = 'blog-default-right';
		}
	}

	// Set Single layout.		
	$blogg_single_layout = esc_attr(get_theme_mod( 'blogg_single_layout', 'default' ) );
	if (is_single() ) {
		if ( 'single-left' === $blogg_single_layout ) {	
			$classes[] = 'single-left';	

		} elseif ( 'single-right' === $blogg_single_layout ) {	
			$classes[] = 'single-right';	
					
		} else {
			$classes[] = 'single-full';
		}
	}	
/** 
 * Check if sidebar widget area is empty and what template is being used.
 * This is for the Page Templates sidebar position
 */
	if ( is_page_template( 'templates/left-sidebar.php' ) ) {
		$classes[] = 'sidebar-left';		
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$classes[] = 'sidebar-right';	
	} elseif ( is_page_template( 'templates/short-width.php' ) ) {
		$classes[] = 'sidebar-none';		
	} else {
		// fallback
		$classes[] = 'sidebar-blog';
	}	

// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'blogg_body_classes' );


/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function blogg_post_classes( $classes ) {

	// Add comments-off class.
	if ( ! ( comments_open() || get_comments_number() ) ) {
		$classes[] = 'comments-off';
	}

	return $classes;
}
add_filter( 'post_class', 'blogg_post_classes' );


/**
 * Change excerpt length for default posts
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function blogg_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}
	// Get excerpt length from database.
	$excerpt_length = esc_attr(get_theme_mod( 'blogg_excerpt_length', '35' ) );
	// Return excerpt text.
	if ( $excerpt_length >= 0 ) :
		return absint( $excerpt_length );
	else :
		return 35; // Number of words.
	endif;
}
add_filter( 'excerpt_length', 'blogg_excerpt_length' );


/**
 * Change excerpt more text for posts
 *
 * @param String $more_text Excerpt More Text.
 * @return string
 */
function blogg_excerpt_more( $more_text ) {

	if ( is_admin() ) {
		return $more_text;
	}

	return '&hellip;';
}
add_filter( 'excerpt_more', 'blogg_excerpt_more' );

/**
 * Featured Boxes
*/
if( ! function_exists( 'blogg_featured_boxes_section' ) ) :

function blogg_featured_boxes_section(){ 
    $ed_featured         = esc_attr(get_theme_mod( 'ed_featured_area', true ) );
    $featured_page_one   = esc_attr(get_theme_mod( 'featured_content_one' ) );
    $featured_page_two   = esc_attr(get_theme_mod( 'featured_content_two' ) );
    $featured_page_three = esc_attr(get_theme_mod( 'featured_content_three' ) );
    $featured_pages      = array( $featured_page_one, $featured_page_two, $featured_page_three );
    $featured_pages      = array_diff( array_unique( $featured_pages), array( '' ) );
        
    if( is_front_page() && $ed_featured && $featured_pages ){ 
        $args = array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'post__in'       => $featured_pages,
            'orderby'        => 'post__in'   
        );
        
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){ ?>
            <div class="featured-boxes" data-wow-delay="0.1s">
        		<div class="row">
        			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                    <div class="col-md-4 box-item">
        				<a href="<?php esc_url(the_permalink()); ?>" class="img-holder">
        					<?php 
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( 'blogg-featured-box' );
                                }else{ ?>
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-featured-box.png' ); ?>" alt="<?php esc_attr(the_title_attribute()); ?>" />
                                <?php
                                }
                                the_title( '<div class="text-holder"><span>', '</span></div>' );
                            ?> 
        				</a>
        			</div>
        			<?php } ?>
        		</div>
        	</div>
            <?php
            wp_reset_postdata();
        }
    }
}
endif;
add_action( 'blogg_featured_boxes', 'blogg_featured_boxes_section' );
