<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php $blogg_blog_layout = get_theme_mod( 'blogg_blog_layout', 'default' );	
		switch ( esc_attr($blogg_blog_layout ) ) {
			
		case "grid":
			// grid
			echo '<li class="col-lg-6"><article id="post-', the_ID(), '"', esc_attr(post_class()), '>';
			blogg_post_image_archives(); 
			echo '<header class="entry-header row">';		 
			blogg_date_block();
			echo '<div class="grid-entry-title-wrapper col-sm-10">';
			blogg_sticky_entry_post();
			blogg_get_first_cat_name();
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2></div>' );			
			echo '</header></article></li>';			
			break;	
			
		default:
			// default blog
			echo '<article id="post-', the_ID(), '"', esc_attr(post_class()), '>';
			blogg_post_image_archives(); 
			echo '<div class="post-content">';			
			echo '<div class="entry-content"><header class="entry-header">';
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2></header>' );
			blogg_default_entry_meta();			
				if ( esc_attr(get_theme_mod( 'blogg_blog_content', true )) ) {
					the_excerpt();
					blogg_more_link();
				} else {				
				
					the_content( 
					
					sprintf(
					/* translators: %s: Name of current post */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blogg' ),
						get_the_title()
					) );
			
				}						
			blogg_multipage_navigation();
			echo '</div></div></article>';
		}
	?>