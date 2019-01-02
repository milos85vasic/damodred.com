<?php
/**
 * The template for displaying all single posts.
 * The left sidebar layout has source-ordered positioning.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


get_header(); ?>

	
<?php
	$blogg_single_layout = get_theme_mod( 'blogg_single_layout', 'single-right' );	
	
		switch ( esc_attr($blogg_single_layout ) ) {
		case "single-left":
			// single left sidebar
			echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-8 order-lg-2">';
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/posts/content', 'single' );			
					if( esc_attr(get_theme_mod( 'blogg_post_navigation', true ) ) ) {
						blogg_post_navigation();	
					}
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
					echo '</main><div class="col-lg-4 order-3 order-lg-1">';	
						get_sidebar(); 
					echo '</div></div>';
			break;		

		case "single-right":
			// single right sidebar
			echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-8">';
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/posts/content', 'single' );			
					if( esc_attr(get_theme_mod( 'blogg_post_navigation', true ) ) ) {
						blogg_post_navigation();	
					}	
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			echo '</main><div class="col-lg-4">';	
				get_sidebar(); 
			echo '</div></div>';
			break;	
			
		default:
			// default		
			echo '<div id="primary" class="content-area row justify-content-center"><main id="main" class="site-main col-lg-9 align-self-center">';
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/posts/content', 'single' );			
					if( esc_attr(get_theme_mod( 'blogg_post_navigation', true ) ) ) {
						blogg_post_navigation();	
					}	
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			echo '</main></div>';			
		}					
		
get_footer();