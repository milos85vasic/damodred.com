<?php
/**
 * This template to displays woocommerce page
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */

get_header();
	$excellent_settings = excellent_get_theme_options();
	global $excellent_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'excellent_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	} ?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php woocommerce_content(); ?>
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($excellent_settings['excellent_sidebar_layout_options'] != 'nosidebar') && ($excellent_settings['excellent_sidebar_layout_options'] != 'fullwidth')){ ?>
<aside id="secondary" class="widget-area">
	<?php }
} 
	if( 'default' == $layout ) { //Settings from customizer
		if(($excellent_settings['excellent_sidebar_layout_options'] != 'nosidebar') && ($excellent_settings['excellent_sidebar_layout_options'] != 'fullwidth')): ?>
		<?php dynamic_sidebar( 'excellent_woocommerce_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}
?>
</div><!-- end .wrap -->
<?php
get_footer();