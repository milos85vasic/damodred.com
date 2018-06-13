<?php
/**
 * Template Name: Excellent Corporate Template
 *
 * Displays Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0.1
 */
get_header();
$excellent_settings = excellent_get_theme_options(); ?>
<main id="main" class="site-main">
<?php
/********************************************************************/
if($excellent_settings['excellent_frontpage_position'] =='default'){
		do_action('excellent_display_about_us');
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_second_position_display'){
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_about_us');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_third_position_display'){
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_about_us');
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_fourth_position_display'){
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_about_us');
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_fifth_position_display'){
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_about_us');
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_sixth_position_display'){
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_about_us');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_seventh_position_display'){
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_our_testimonial');
		do_action('excellent_display_about_us');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_eigth_position_display'){
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_about_us');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_ninth_position_display'){
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_about_us');
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_our_testimonial');
	}elseif($excellent_settings['excellent_frontpage_position'] =='design_tenth_position_display'){
		do_action('excellent_display_latest_from_blog_box');
		do_action('excellent_display_portfolio_box');
		do_action('excellent_display_about_us');
		do_action('excellent_display_front_page_features');
		do_action('excellent_display_our_testimonial');
	} ?>
</main><!-- end #main -->
<?php
get_footer();