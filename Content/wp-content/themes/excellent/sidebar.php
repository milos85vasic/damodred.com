<?php
/**
 * The sidebar containing the main Sidebar area.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
	$excellent_settings = excellent_get_theme_options();
	global $excellent_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'excellent_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}

if( 'default' == $layout ) { //Settings from customizer
	if(($excellent_settings['excellent_sidebar_layout_options'] != 'nosidebar') && ($excellent_settings['excellent_sidebar_layout_options'] != 'fullwidth')){ ?>

<aside id="secondary" class="widget-area">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<aside id="secondary" class="widget-area">
  <?php }
	}?>
  <?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($excellent_settings['excellent_sidebar_layout_options'] != 'nosidebar') && ($excellent_settings['excellent_sidebar_layout_options'] != 'fullwidth')): ?>
  <?php dynamic_sidebar( 'excellent_main_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			dynamic_sidebar( 'excellent_main_sidebar' );
			echo '</aside><!-- end #secondary -->';
		}
	}