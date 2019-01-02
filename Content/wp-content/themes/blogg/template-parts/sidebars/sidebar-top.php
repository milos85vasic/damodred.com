<?php
/**
 * Template part for the top  sidebar
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (   ! is_active_sidebar( 'top'  )	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<div class="row">
	<aside id="top-sidebar" class="widget-area col-12">		             
		<?php dynamic_sidebar( 'top' ); ?> 	
	</aside> 
</div>