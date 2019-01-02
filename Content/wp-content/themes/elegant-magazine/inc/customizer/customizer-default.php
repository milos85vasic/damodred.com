<?php
/**
 * Default theme options.
 *
 * @package Elegant_Magazine
 */

if (!function_exists('elegant_magazine_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function elegant_magazine_get_default_theme_options() {

    $defaults = array();
    // Preloader options section
    $defaults['enable_site_preloader'] = 1;

    // Header options section
    $defaults['show_top_header_section'] = 0;
    $defaults['top_header_background_color'] = "#353535";
    $defaults['top_header_text_color'] = "#ffffff";
    $defaults['top_header_transparency'] = 0;
    $defaults['show_top_menu'] = 0;
    $defaults['show_social_menu_section'] = 0;
    $defaults['show_date_section'] = 0;
    $defaults['show_offpanel_menu_section'] = 1;
    $defaults['disable_header_image_tint_overlay'] = 0;


    $defaults['banner_advertisement_section'] = '';
    $defaults['banner_advertisement_section_url'] = '';

    // breadcrumb options section
    $defaults['enable_breadcrumb'] = 1;
    $defaults['select_breadcrumb_mode'] = 'simple';

    // Frontpage Section.
    $defaults['show_ticker_news_section'] = 1;
    $defaults['ticker_section_title'] = esc_html__('Exclusive', 'elegant-magazine');
    $defaults['select_ticker_news_category'] = 0;
    $defaults['ticker_news_count'] = 5;

    $defaults['show_main_news_section'] = 0;
    $defaults['select_slider_news_category'] = 0;
    $defaults['select_featured_news_category'] = 0;

    $defaults['frontpage_content_alignment'] = 'align-content-left';

    //layout options
    $defaults['global_content_alignment'] = 'align-content-left';
    $defaults['global_image_alignment'] = 'full-width-image';
    $defaults['global_excerpt_length'] = 20;


    $defaults['archive_layout'] = 'archive-layout-full';
    $defaults['archive_image_alignment'] = 'archive-image-left';
    $defaults['archive_content_view'] = 'archive-content-excerpt';

    $defaults['single_show_related_posts'] = 1;
    $defaults['single_related_posts_title']     = __( 'You may also like', 'elegant-magazine' );


    // Home Page.
    $defaults['frontpage_content_status'] = 0;

    //Pagination.
    $defaults['site_pagination_type'] = 'default';


    // Footer.
    $defaults['footer_show_latest_blog_carousel'] = 0;
    $defaults['footer_copyright_text'] = esc_html__('Copyright &copy; All rights reserved.', 'elegant-magazine');

    // Pass through filter.
    $defaults = apply_filters('elegant_magazine_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
