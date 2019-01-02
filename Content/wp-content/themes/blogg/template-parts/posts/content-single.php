<?php
/**
 * Single post partial template.
 *
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
		
		 <?php 
		 // Display the featured image above the title		 
		 if ( has_post_thumbnail() ) {	
				blogg_post_default_image();
		} 
		 
		 // Display just the title if no featured image		 		 
				if( esc_attr(get_theme_mod( 'blogg_meta_category', true ) ) ) {
					blogg_categories();
				}
			 the_title( '<h1 class="entry-title">', '</h1>' );
		?>
			
		<?php 
		if( esc_attr(get_theme_mod( 'blogg_meta_info', true ) ) ) {
			blogg_default_entry_meta(); 
		}
		?>

        </header> 

        <div class="post-content">
            <div class="entry-content clearfix">

                <?php the_content(); ?>
                <?php blogg_multipage_navigation(); ?>

            </div> <!-- .entry-content -->
        </div><!-- .post-content -->

        <footer class="entry-footer post-details">
		
            <?php blogg_entry_footer(); ?>

        </footer>

    </article>
