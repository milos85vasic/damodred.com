<?php
/**
* Posts navigation functions
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'gallerywp_wp_pagenavi' ) ) :
function gallerywp_wp_pagenavi() {
    ?>
    <nav class="navigation posts-navigation clearfix" role="navigation">
        <?php wp_pagenavi(); ?>
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'gallerywp_posts_navigation' ) ) :
function gallerywp_posts_navigation() {
    if ( function_exists( 'wp_pagenavi' ) ) {
        gallerywp_wp_pagenavi();
    } else {
        the_posts_navigation(array('prev_text' => esc_html__( '&larr; Older posts', 'gallerywp' ), 'next_text' => esc_html__( 'Newer posts &rarr;', 'gallerywp' )));
    }
}
endif;