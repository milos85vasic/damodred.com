<?php
/**
 * The template used for displaying About page content
 *
 * @package Bloog Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php $bloog_about_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloog-about-us-page-img', false ); ?>
		<a href="<?php the_permalink(); ?>"><img class="about_img" src="<?php echo $bloog_about_img_src[0]; ?>" /></a>
		<div class="page-content about_page_cont"><?php echo get_the_content(); ?></div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php 
		if( is_plugin_active( 'accesspress-social-share/accesspress-social-share.php' ) ) {
			echo do_shortcode('[apss-share networks="facebook, twitter, pinterest"]');
		}
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->