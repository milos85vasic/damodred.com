<?php
if(!function_exists('excellent_get_option_defaults_values')):
	/******************** EXCELLENT DEFAULT OPTION VALUES ******************************************/
	function excellent_get_option_defaults_values() {
		global $excellent_default_values;
		$excellent_default_values = array(
			'excellent_responsive'	=> 'on',
			'excellent_design_layout' => 'boxed-layout',
			'excellent_sidebar_layout_options' => 'right',
			'excellent_blog_layout' => 'large_image_display',
			'excellent_search_custom_header' => 0,
			'excellent-img-upload-footer-image' => '',
			'excellent_header_display'=> 'header_text',
			'excellent_categories'	=> array(),
			'excellent_scroll'	=> 0,
			'excellent_slider_button' => 0,
			'excellent_secondary_text' => '',
			'excellent_secondary_url' => '',
			'excellent_tag_text' => esc_html__('Continue Reading','excellent'),
			'excellent_excerpt_length'	=> '20',
			'excellent_single_post_image' => 'off',
			'excellent_reset_all' => 0,
			'excellent_stick_menu'	=>0,
			'excellent_scrollreveal_effect' => 0,
			'excellent_logo_high_resolution'	=> 0,
			'excellent_blog_post_image' => 'on',
			'excellent_search_text' => esc_html__('Search &hellip;','excellent'),
			'excellent_blog_content_layout'	=> 'fullcontent_display',
			'excellent_site_sticky_hide_social_icon' =>'off',
			/* Slider Settings */
			'excellent_slider_type'	=> 'default_slider',
			'excellent_slider_link' =>0,
			'excellent_enable_slider' => 'frontpage',
			'excellent_category_slider' =>array(),
			'excellent_category_slider_number'	=> '4',
			/* Layer Slider */
			'excellent_animation_effect' => 'slide',
			'excellent_slideshowSpeed' => '5',
			'excellent_animationSpeed' => '7',
			'excellent_direction' => 'horizontal',
			'excellent_slider_content_bg_color' => 'on',
			'excellent_display_page_single_featured_image'=>0,
			'excellent_small_feature_single_post'	=>0,
			/* Frontpage Excellent About Us */
			'excellent_disable_about_us'	=> 1,
			'excellent_about_us_remove_link' =>0,
			'excellent_about_us'	=> '',
			'excellent_about_title'	=> '',
			'excellent_about_description'	=> '',
			/* Front page feature */
			'excellent_disable_features'	=> 1,
			'excellent_disable_features_image'	=> 0,
			'excellent_disable_features_readmore'	=> 0,
			'excellent_total_features'	=> '3',
			'excellent_features_title'	=> '',
			'excellent_features_description'	=> '',
			'excellent_frontpage_position'=>'default',
			/* Latest from Blog*/
			'excellent_disable_latest_blog'	=> 1,
			'excellent_total_latest_from_blog'	=> '3',
			'excellent_latest_blog_title'	=> '',
			'excellent_latest_blog_description' =>'',
			'excellent_display_blog_category' =>'blog',
			'excellent_latest_from_blog_category_list' =>array(),
			/* Portfolio Box */
			'excellent_disable_portfolio_box'	=> 1,
			'excellent_total_portfolio_box'	=> '4',
			/* Our Testimonial */
			'excellent_disable_our_testimonial'	=> 1,
			'excellent_total_our_testimonial'	=> '3',
			'excellent_our_testimonial_title'	=> '',
			'excellent_entry_meta_single' => 'show',
			'excellent_entry_meta_blog' => 'show-meta',
			'excellent_footer_column_section'	=>'4',
			/*Social Icons */
			'excellent_top_social_icons' =>0,
			'excellent_buttom_social_icons'	=>0,
			);
		return apply_filters( 'excellent_get_option_defaults_values', $excellent_default_values );
	}
endif;