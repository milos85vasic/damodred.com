<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogg
 */
 
	
get_header(); ?>


        <?php		
		if ( is_archive() ) {
			echo '<header class="archive-header">';
			// customize the archive titles if set to true
				if ( esc_attr(get_theme_mod( 'blogg_show_archive_labels', true ) ) ) :
					blogg_archive_title( '<h1 class="archive-title">', '</h1>' );
				else: 
					the_archive_title( '<h1 class="archive-title">', '</h1>' );
				endif;		
					the_archive_description( '<div class="archive-description">', '</div>' );
			echo '</header>';
		}
		
		if ( have_posts() ) :
			
			echo '<div class="post-wrapper">';			

			$blogg_blog_layout = get_theme_mod( 'blogg_blog_layout', 'default' );	
				switch ( esc_attr($blogg_blog_layout ) ) {					
				case "grid":
					// grid full width
					echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-12"><ul id="grid" class="row row-eq-height">';
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/posts/content', get_post_format() );
						endwhile;
					echo '</main></div></ul>';
				break;

				case "default-left":
					// default left sidebar
					echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-8 order-lg-2">';
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/posts/content', get_post_format() );
						endwhile;
					echo '</main><div class="col-lg-4 order-3 order-lg-1">';		
						get_sidebar(); 
					echo '</div></div>';
				break;	
				
				default:
					// default blog
					echo '<div id="primary" class="content-area row"><main id="main" class="site-main col-lg-8">';
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/posts/content', get_post_format() );
						endwhile;
					echo '</main><div class="col-lg-4">';	
						get_sidebar(); 
					echo '</div></div>';
				}
		
			echo '</div><!-- .post-wrapper -->';
			blogg_blog_navigation();
		else :
			get_template_part( 'template-parts/posts/content', 'none' );
		endif; 
		?>
	

    <?php
get_footer();