<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Bloog Lite
 */

if ( ! is_active_sidebar( 'bloog_right_sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="sidebar sidebar-right widget-area" role="complementary">
	<?php dynamic_sidebar( 'bloog_right_sidebar' ); ?>
</div><!-- #secondary -->
