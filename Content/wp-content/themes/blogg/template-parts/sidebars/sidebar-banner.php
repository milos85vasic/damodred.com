<?php
/**
 * Template part for the banner sidebar
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (   ! is_active_sidebar( 'banner'  )	)
		return;
	// If we get this far, we have widgets. Let do this.
?>


<aside id="banner-sidebar" class="widget-area">		             
	<?php dynamic_sidebar( 'banner' ); ?> 	
</aside> 