<?php
/**
 * Kale theme defaults
 *
 * @package kale
 */
?>
<?php 
global $kale_defaults;

$kale_defaults['kale_custom_header']                    = esc_url( get_template_directory_uri() ) . '/sample/images/header.jpg';

$kale_defaults['kale_footer_copyright']                 = esc_html__('Copyright &copy; ', 'kale'). date('Y') .' <a href="https://www.lyrathemes.com/kale/">Kale</a>';
$kale_defaults['kale_nav_search_icon']                  = 1;
$kale_defaults['kale_example_content']					= 1;
$kale_defaults['kale_dropdown_node_enable']             = 0;

$kale_defaults['kale_image_logo_show']                  = false;
$kale_defaults['kale_text_logo']                        = get_bloginfo('name');

$kale_defaults['kale_banner_heading']                   = get_bloginfo('name');
$kale_defaults['kale_banner_description']               = get_bloginfo('description');
$kale_defaults['kale_banner_url']                       = '#';

$kale_defaults['kale_frontpage_banner']                 = 'Banner';
$kale_defaults['kale_frontpage_banner_overlay_show']	= 1;
$kale_defaults['kale_frontpage_banner_overlay_color']   = '#555555';
$kale_defaults['kale_frontpage_banner_link_images']	    = 0;

$kale_defaults['kale_frontpage_posts_slider_category']  = 1; //Uncategorized
$kale_defaults['kale_frontpage_posts_slider_number']    = '3';

$kale_defaults['kale_frontpage_featured_posts_show']    = false;
$kale_defaults['kale_frontpage_featured_posts_heading'] = esc_html__('Featured Posts', 'kale');
$kale_defaults['kale_frontpage_featured_posts_post_1']  = 1;
$kale_defaults['kale_frontpage_featured_posts_post_2']  = 1;
$kale_defaults['kale_frontpage_featured_posts_post_3']  = 1;

$kale_defaults['kale_frontpage_large_post_show']        = false;
$kale_defaults['kale_frontpage_large_post_heading']     = esc_html__('My Diary', 'kale');
$kale_defaults['kale_frontpage_large_post']             = 1;

$kale_defaults['kale_blog_feed_meta_show']              = true;
$kale_defaults['kale_blog_feed_date_show']              = 1;
$kale_defaults['kale_blog_feed_category_show']          = 1;
$kale_defaults['kale_blog_feed_author_show']            = 1;
$kale_defaults['kale_blog_feed_comments_show']          = 1;
$kale_defaults['kale_blog_feed_post_format']            = 'Mixed';
$kale_defaults['kale_blog_feed_label']                  = __('Recent Posts', 'kale');

$kale_defaults['kale_posts_meta_show']                  = true;
$kale_defaults['kale_posts_date_show']                  = 1;    
$kale_defaults['kale_posts_category_show']              = 1;
$kale_defaults['kale_posts_author_show']                = 1;
$kale_defaults['kale_posts_tags_show']                  = 1;
$kale_defaults['kale_posts_sidebar']                    = '1';
$kale_defaults['kale_posts_featured_image_show']        = 1;
$kale_defaults['kale_posts_posts_nav_show']             = 1;

$kale_defaults['kale_pages_sidebar']                    = '1';

$kale_defaults['kale_sidebar_size']						= false;

/* sample images */

$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide1.jpg';
$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide2.jpg';
$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide3.jpg';

$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb1.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb2.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb3.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb4.jpg';

$kale_defaults['kale_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full1.jpg';
$kale_defaults['kale_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full2.jpg';
$kale_defaults['kale_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full3.jpg';
?>