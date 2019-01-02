<?php
/**
 * Template part for the breadcrumb sidebar
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (   ! is_active_sidebar( 'breadcrumbs'  )	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

	<aside id="breadcrumb-sidebar" class="widget-area">		             
		<?php dynamic_sidebar( 'breadcrumbs' ); ?> 	
	</aside> 
