<?php
/**
 * Juliet theme defaults
 *
 * @package juliet
 */
?>
<?php 
$juliet_defaults['juliet_custom_header']                    = esc_url( get_template_directory_uri() ) . '/sample/images/header.jpg';

$juliet_defaults['juliet_skin']								= 'Classic';
$juliet_defaults['juliet_footer_copyright']                 = esc_html__('Copyright &copy; ', 'juliet'). date('Y') .' <a href="https://www.lyrathemes.com/juliet/">Juliet</a>';
$juliet_defaults['juliet_enable_fancy_scrollbar']           = 0;
$juliet_defaults['juliet_sticky_post_signature']            = esc_url( get_template_directory_uri() ) . '/sample/images/signature.png';
$juliet_defaults['juliet_example_content']					= 1;

$juliet_defaults['juliet_enable_off_canvas_menu']           = 1;
$juliet_defaults['juliet_dropdown_node_enable']             = 0;

$juliet_defaults['juliet_image_logo_show']                  = 0;
$juliet_defaults['juliet_text_logo']                        = get_bloginfo('name');

$juliet_defaults['juliet_banner_heading']                   = get_bloginfo('name');
$juliet_defaults['juliet_banner_description']               = get_bloginfo('description');
$juliet_defaults['juliet_banner_url']                       = home_url();

$juliet_defaults['juliet_frontpage_banner']                 = 'Banner';

$juliet_defaults['juliet_frontpage_banner_overlay_show']	= 1;
$juliet_defaults['juliet_frontpage_banner_overlay_color']	= "#000000";

$juliet_defaults['juliet_frontpage_featured_posts_show']    = 1;
$juliet_defaults['juliet_frontpage_featured_posts_heading'] = esc_html__('Featured Posts', 'juliet');
$juliet_defaults['juliet_frontpage_featured_posts_post_1']  = 1;
$juliet_defaults['juliet_frontpage_featured_posts_post_2']  = 1;
$juliet_defaults['juliet_frontpage_featured_posts_post_3']  = 1;
$juliet_defaults['juliet_frontpage_featured_posts_post_4']  = 1;

$juliet_defaults['juliet_frontpage_blog_feed_sidebar']      = '1';

$juliet_defaults['juliet_blog_feed_meta_show']              = 1;
$juliet_defaults['juliet_blog_feed_date_show']              = 1;
$juliet_defaults['juliet_blog_feed_category_show']          = 1;
$juliet_defaults['juliet_blog_feed_author_show']            = 1;
$juliet_defaults['juliet_blog_feed_comments_show']          = 1;
$juliet_defaults['juliet_blog_feed_sidebar']                = '1';
$juliet_defaults['juliet_blog_feed_post_format']            = 'Excerpt';
$juliet_defaults['juliet_blog_feed_label']					= esc_html__('Recent Posts', 'juliet');

$juliet_defaults['juliet_posts_meta_show']                  = 1;
$juliet_defaults['juliet_posts_date_show']                  = 1;    
$juliet_defaults['juliet_posts_category_show']              = 1;
$juliet_defaults['juliet_posts_author_show']                = 1;
$juliet_defaults['juliet_posts_tags_show']                  = 1;
$juliet_defaults['juliet_posts_sidebar']                    = '1';
$juliet_defaults['juliet_posts_featured_image_show']        = 1;

$juliet_defaults['juliet_pages_sidebar']                    = '1';
$juliet_defaults['juliet_pages_featured_image_show']        = 1;

$juliet_defaults['juliet_custom_colors']					= 0;
$juliet_defaults['juliet_custom_colors_accent']             = '#000000'; //for fancy scrollbar (nicescroll)
$juliet_defaults['juliet_custom_colors_scrollbar']          = '#000000'; //for fancy scrollbar (nicescroll)

/* sample images */

$juliet_defaults['juliet_featured_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/featured1.jpg';
$juliet_defaults['juliet_featured_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/featured2.jpg';
$juliet_defaults['juliet_featured_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/featured3.jpg';
$juliet_defaults['juliet_featured_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/featured4.jpg';

$juliet_defaults['juliet_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb1.jpg';
$juliet_defaults['juliet_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb2.jpg';
$juliet_defaults['juliet_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb3.jpg';
$juliet_defaults['juliet_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb4.jpg';

$juliet_defaults['juliet_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full1.jpg';
$juliet_defaults['juliet_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full2.jpg';
$juliet_defaults['juliet_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full3.jpg';

?>