<?php 
/**
 * Library of Theme options functions.
 * @package StairWay
 * @since StairWay 1.0.0
*/

// Display Breadcrumb navigation
function stairway_get_breadcrumb() {
global $stairway_options_db; 
		if ($stairway_options_db['stairway_display_breadcrumb'] != 'Hide') { ?>
		<?php if(function_exists( 'bcn_display' ) && !is_front_page()){ _e('<p class="breadcrumb-navigation">', 'stairway'); ?><?php bcn_display(); ?><?php _e('</p>', 'stairway');} ?>
<?php } 
} 

// Display featured images on single posts
function stairway_get_display_image_post() { 
global $stairway_options_db;
		if ($stairway_options_db['stairway_display_image_post'] == '' || $stairway_options_db['stairway_display_image_post'] == 'Display') { ?>
		<?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail(); ?>
    <?php endif; ?>
<?php } 
}

// Display featured images on pages
function stairway_get_display_image_page() { 
global $stairway_options_db;
		if ($stairway_options_db['stairway_display_image_page'] == '' || $stairway_options_db['stairway_display_image_page'] == 'Display') { ?>
		<?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail(); ?>
    <?php endif; ?>
<?php } 
} ?>