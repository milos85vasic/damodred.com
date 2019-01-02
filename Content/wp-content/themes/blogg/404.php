<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

		
		
		
		
		
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
	
			<div class="inside-article">
			
		<section id="error-404">
          <h1 id="error-title"><?php esc_html_e( '404', 'blogg' ); ?></h1>
          <h3 id="error-sub-title"><?php esc_html_e( 'Our Apologies. The page requested cannot be found.', 'blogg' ); ?></h3>
          <p><?php esc_html_e( 'It appears we messed up somewhere with a broken link or the page has been removed from our website.', 'blogg' ); ?></p>
          <div id="error-button">
		  <a class="more-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php esc_html_e( 'Return Home', 'blogg' ); ?>
			</a>
		</div>
		
		<?php	get_search_form(); ?>
		
	</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
