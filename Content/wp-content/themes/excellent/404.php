<?php
/**
 * The template for displaying 404 pages
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
get_header(); ?>
<div class="wrap">
	<div id="primary" class="content-area">
	<main id="main" class="site-main">
			<?php if ( is_active_sidebar( 'excellent_404_page' ) ) :
				dynamic_sidebar( 'excellent_404_page' );
			else:?>
			<section class="error-404 not-found">
				<header class="page-header">
					<h2 class="page-title"> <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'excellent' ); ?> </h2>
				</header> <!-- .page-header -->
				<div class="page-content">
					<p> <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'excellent' ); ?> </p>
						<?php get_search_form(); ?>
				</div> <!-- .page-content -->
			</section> <!-- .error-404 -->
		<?php endif; ?>
	</main><!-- end #main -->
	</div> <!-- #primary -->
<?php
get_sidebar();
?>
</div><!-- end .wrap -->
<?php
get_footer();