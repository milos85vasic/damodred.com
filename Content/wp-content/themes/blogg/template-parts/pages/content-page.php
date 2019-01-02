<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogg
 */

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
       
		 <?php 
		 // Display the featured image above the title		 
		 if ( has_post_thumbnail() ) {	
			blogg_default_page_image();
		} 
		?>
		
        <header class="entry-header">
			<?php the_title( '<h1 class="entry-title page-title">', '</h1>' ); ?>
        </header> 		
			           
		<div class="post-content">
            <div class="entry-content clearfix">

                <?php the_content(); ?>
               <?php blogg_multipage_navigation(); ?>

            </div> <!-- .entry-content -->
        </div><!-- .post-content -->

    </article>
