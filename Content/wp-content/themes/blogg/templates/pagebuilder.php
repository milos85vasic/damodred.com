<?php
/**
 * Template Name: For Page Builders
 * Description: A template for several page builders.
 * @package Blogg
 */

get_header(); ?>

	<div id="primary" class="content-area content-pagebuilder">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/pages/content', 'page' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
