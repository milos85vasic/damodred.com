<?php
/**
* More Custom Functions
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

// Get custom-logo URL
function gallerywp_custom_logo() {
    if ( ! has_custom_logo() ) {return;}
    $gallerywp_custom_logo_id = get_theme_mod( 'custom_logo' );
    $gallerywp_logo = wp_get_attachment_image_src( $gallerywp_custom_logo_id , 'full' );
    return $gallerywp_logo[0];
}

// Category ids in post class
function gallerywp_category_id_class($classes) {
        global $post;
        foreach((get_the_category($post->ID)) as $category) {
            $classes [] = 'wpcat-' . $category->cat_ID . '-id';
        }
        return $classes;
}
add_filter('post_class', 'gallerywp_category_id_class');

// Change excerpt more word
function gallerywp_excerpt_more($more) {
       if ( is_admin() ) {
         return $more;
       }
       return '...';
}
add_filter('excerpt_more', 'gallerywp_excerpt_more');

// Adds custom classes to the array of body classes.
function gallerywp_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'gallerywp-group-blog';
    }

    if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
       $classes[] = 'gallerywp-layout-full-width';
    }

    if ( is_404() ) {
        $classes[] = 'gallerywp-layout-full-width';
    }

    if ( !is_active_sidebar( 'gallerywp-home-bottom-widgets' ) && !is_active_sidebar( 'gallerywp-single-bottom-widgets' ) && !is_active_sidebar( 'gallerywp-singular-bottom-widgets' ) && !is_active_sidebar( 'gallerywp-bottom-widgets' ) ) {
        $classes[] = 'gallerywp-no-bottom-widgets';
    }

    return $classes;
}
add_filter( 'body_class', 'gallerywp_body_classes' );

function gallerywp_post_style() {
       $post_style = 'grid';
       return $post_style;
}

function gallerywp_grid_thumb_style() {
       $thumb_style = 'gallerywp-square-image';
       return $thumb_style;
}

function gallerywp_post_grid_cols() {
       $post_column = 'gallerywp-3-col';
       return $post_column;
}