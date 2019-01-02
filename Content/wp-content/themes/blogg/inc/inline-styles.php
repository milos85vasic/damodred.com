<?php
/**
 * Add inline styles to the head area
 * @package Blogg
*/
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 // Dynamic styles
function blogg_inline_styles($blogg_customizer_css) {
	

// BEGIN CUSTOM CSS	
	
//Content Sizes			
$blogg_page_width   = esc_attr(get_theme_mod( 'blogg_page_width', '2560' ).'px' );	
$blogg_header_width   = esc_attr(get_theme_mod( 'blogg_header_width', '1120' ).'px' );	
$blogg_featured_boxes_width   = esc_attr(get_theme_mod( 'blogg_featured_boxes_width', '1120' ).'px' );
$blogg_customizer_css .="
	#page {max-width: $blogg_page_width;}
	@media (min-width: 992px) {
	.site-header .container {max-width: $blogg_header_width;}
	.featured-boxes {max-width: $blogg_featured_boxes_width;}
	} ";
	
// Colours
$blogg_first_colour = esc_attr(get_theme_mod( 'blogg_first_colour', '#ab7946' ) );
$blogg_second_colour = esc_attr(get_theme_mod( 'blogg_second_colour', '#161616' ) );
$blogg_third_colour = esc_attr(get_theme_mod( 'blogg_third_colour', '#e6e6e6' ) );
$blogg_customizer_css .="
	::-moz-selection {background-color: $blogg_first_colour;}
	::selection {background-color: $blogg_first_colour;}
	.featured-boxes .box-item .img-holder .text-holder span {background-color: $blogg_first_colour;}
	.more-link:focus,
	.more-link:hover,.slide-readmore a:hover,
	.pagination .current,
	.pagination .page-numbers:hover,
	.pagination .page-numbers:active	{background-color: $blogg_first_colour; border-color: $blogg_first_colour;}
	a, 
	#grid .post-meta-category,
	#grid .block-day {color: $blogg_first_colour;}
	.site-title a,
	.site-title a:visited,
	.entry-title a,
	.entry-title a:visited,
	#error-title,
	figcaption,
	.main-navigation-toggle,
	.main-navigation-menu a:link,
	.main-navigation-menu a:visited  {color: $blogg_second_colour;}
	.main-navigation-toggle .icon,
	.blogg-social-menu .social-icons-menu li a .icon	{fill: $blogg_second_colour;}	
	table thead,
	span.featured-label,
	.featured-caption,
	.button,
	button,
	input[type=\"submit\"],
	input[type=\"reset\"],
	#infinite-handle span,
	blockquote.alignleft,
	blockquote,
	blockquote.alignright,
	#footer-content,
	.archive-header,
	#breadcrumb-sidebar,
	.post-navigation {border-color: $blogg_third_colour;}
	hr {background-color: $blogg_third_colour;}
	
	@media (min-width: 992px) {
		.main-navigation-menu ul li	{background-color: $blogg_second_colour;}
	} ";
	
// Miscellaneous
if ( false === esc_attr(get_theme_mod( 'blogg_display_author_avatar' ) ) ) {
	$blogg_customizer_css .=".entry-meta .avatar { display: none; } ";
}

		
// END CUSTOM CSS - Output all the styles
wp_add_inline_style( 'blogg-stylesheet', $blogg_customizer_css );
	
}
add_action( 'wp_enqueue_scripts', 'blogg_inline_styles' );
