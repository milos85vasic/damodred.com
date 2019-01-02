<?php
/**
 * The template for displaying all pages
 * This is the template that displays all pages by default in full width - no sidebars
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<div class="row">
	<div id="primary" class="content-page content-area col-12">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/pages/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php 
get_footer(); 