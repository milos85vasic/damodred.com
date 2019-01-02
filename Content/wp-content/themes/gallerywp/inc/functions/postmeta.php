<?php
/**
* Post meta functions
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'gallerywp_post_tags' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function gallerywp_post_tags() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'gallerywp' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<span class="gallerywp-tags-links"><i class="fa fa-tags" aria-hidden="true"></i> ' . esc_html__( 'Tagged %1$s', 'gallerywp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'gallerywp_grid_cats' ) ) :
function gallerywp_grid_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'gallerywp' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="gallerywp-grid-post-categories">' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'gallerywp' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'gallerywp_grid_postmeta' ) ) :
function gallerywp_grid_postmeta() { ?>
    <?php if ( !(gallerywp_get_option('hide_post_author_home')) || !(gallerywp_get_option('hide_posted_date_home')) || !(gallerywp_get_option('hide_comments_link_home')) ) { ?>
    <div class="gallerywp-grid-post-footer">
    <?php if ( !(gallerywp_get_option('hide_post_author_home')) ) { ?><span class="gallerywp-grid-post-author gallerywp-grid-post-meta"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(gallerywp_get_option('hide_posted_date_home')) ) { ?><span class="gallerywp-grid-post-date gallerywp-grid-post-meta"><?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(gallerywp_get_option('hide_comments_link_home')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="gallerywp-grid-post-comment gallerywp-grid-post-meta"><?php comments_popup_link( esc_attr__( 'Leave a comment', 'gallerywp' ), esc_attr__( '1 Comment', 'gallerywp' ), esc_attr__( '% Comments', 'gallerywp' ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


if ( ! function_exists( 'gallerywp_single_cats' ) ) :
function gallerywp_single_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( ', ', 'gallerywp' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="gallerywp-entry-meta-single gallerywp-entry-meta-single-top"><span class="gallerywp-entry-meta-single-cats"><i class="fa fa-folder-open-o"></i>&nbsp;' . __( '<span class="screen-reader-text">Posted in </span>%1$s', 'gallerywp' ) . '</span></div>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
endif;


if ( ! function_exists( 'gallerywp_single_postmeta' ) ) :
function gallerywp_single_postmeta() { ?>
    <?php if ( !(gallerywp_get_option('hide_post_author')) || !(gallerywp_get_option('hide_posted_date')) || !(gallerywp_get_option('hide_comments_link')) || !(gallerywp_get_option('hide_post_edit')) ) { ?>
    <div class="gallerywp-entry-meta-single">
    <?php if ( !(gallerywp_get_option('hide_post_author')) ) { ?><span class="gallerywp-entry-meta-single-author"><i class="fa fa-user-circle-o"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(gallerywp_get_option('hide_posted_date')) ) { ?><span class="gallerywp-entry-meta-single-date"><i class="fa fa-clock-o"></i>&nbsp;<?php echo get_the_date(); ?></span><?php } ?>
    <?php if ( !(gallerywp_get_option('hide_comments_link')) ) { ?><?php if ( comments_open() ) { ?>
    <span class="gallerywp-entry-meta-single-comments"><i class="fa fa-comments-o"></i>&nbsp;<?php comments_popup_link( esc_attr__( 'Leave a comment', 'gallerywp' ), esc_attr__( '1 Comment', 'gallerywp' ), esc_attr__( '% Comments', 'gallerywp' ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(gallerywp_get_option('hide_post_edit')) ) { ?><?php edit_post_link( esc_html__( 'Edit', 'gallerywp' ), '<span class="edit-link">&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i> ', '</span>' ); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;