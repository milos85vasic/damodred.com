<?php
/**
 * Template part for the bottom sidebar
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (   ! is_active_sidebar( 'bottom'  )	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<div class="row">
	<aside id="bottom-sidebar" class="widget-area col-12">		             
		<?php dynamic_sidebar( 'bottom' ); ?> 	
	</aside> 
</div>