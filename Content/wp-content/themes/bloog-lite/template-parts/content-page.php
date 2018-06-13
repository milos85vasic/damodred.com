<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Bloog Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
   <?php
   if(has_post_thumbnail()){ ?>
   <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('bloog-post-image-size')?></a>
   <?php } ?>
   <div class="page-content">
   <?php echo the_content(); ?>
  </div>
</div><!-- .entry-content -->



<?php        
if(!is_page('contact-us')){ ?>
<footer class="entry-footer">
 <?php 
 if( is_plugin_active( 'accesspress-social-share/accesspress-social-share.php' ) ) {
  echo do_shortcode('[apss-share networks="facebook, twitter, pinterest"]');
}
?>
<footer class="entry-footer">
  <?php } ?>
</article><!-- #post-## -->

